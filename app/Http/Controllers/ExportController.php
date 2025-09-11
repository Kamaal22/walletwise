<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Jobs\ExportTransactionsJob;
use App\Models\Export;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array',
            'format' => 'nullable|in:csv,json',
        ]);

        $format = $data['format'] ?? 'csv';
        $ids = $data['ids'];

        $rows = Transaction::whereIn('id', $ids)->with('account','category')->get()->map(function($t){
            return [
                'id' => $t->id,
                'date' => $t->date->toDateString(),
                'account' => $t->account?->name,
                'category' => $t->category?->name,
                'description' => $t->description,
                'amount' => $t->amount,
            ];
        })->toArray();

        // If large export, create export record and queue a job and return queued response
    $userId = Auth::id();
        if (count($ids) > 100) {
            $export = Export::create([
                'user_id' => $userId,
                'status' => 'queued',
                'format' => $format,
                'params' => ['ids' => $ids],
            ]);
            ExportTransactionsJob::dispatch($ids, $format, $userId, $export->id);
            return response()->json(['queued' => true, 'export_id' => $export->id, 'message' => 'Export queued. You will find the file in your account exports when ready.']);
        }

        if ($format === 'json') {
            return response()->json($rows);
        }

        $filename = 'transactions-export-'.date('Ymd-His').'.csv';
        // record a completed export for small exports
        $export = Export::create([
            'user_id' => $userId,
            'status' => 'done',
            'format' => $format,
            'filename' => $filename,
            'params' => ['ids' => $ids],
            'completed_at' => now(),
        ]);
        $response = new StreamedResponse(function() use ($rows) {
            $out = fopen('php://output', 'w');
            if (!empty($rows)) {
                fputcsv($out, array_keys($rows[0]));
                foreach ($rows as $r) fputcsv($out, $r);
            }
            fclose($out);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$filename.'"');
        return $response;
    }
}
