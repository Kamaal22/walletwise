<?php

namespace App\Jobs;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

use App\Models\Export;

class ExportTransactionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ids;
    public $format;
    public $userId;
    public $exportId;

    public function __construct(array $ids, string $format, int $userId, ?int $exportId = null)
    {
        $this->ids = $ids;
        $this->format = $format;
        $this->userId = $userId;
        $this->exportId = $exportId;
    }

    public function handle()
    {
        if ($this->exportId) {
            Export::where('id', $this->exportId)->update(['status' => 'processing']);
        }

        $rows = Transaction::whereIn('id', $this->ids)->with('account','category')->get()->map(function($t){
            return [
                'id' => $t->id,
                'date' => $t->date->toDateString(),
                'account' => $t->account?->name,
                'category' => $t->category?->name,
                'description' => $t->description,
                'amount' => $t->amount,
            ];
        })->toArray();

        $filename = 'exports/transactions-export-'.now()->format('Ymd-His').'-user'.$this->userId.($this->format==='csv'?'.csv':'.json');

        // record filename on Export if present
        if ($this->exportId) {
            Export::where('id', $this->exportId)->update([
                'filename' => $filename,
            ]);
        }

        if ($this->format === 'json') {
            Storage::disk('local')->put($filename, json_encode($rows));
            if ($this->exportId) {
                Export::where('id', $this->exportId)->update(['status'=>'done','completed_at'=>now()]);
            }
            return;
        }

        // CSV
        $handle = fopen('php://temp', 'r+');
        if (!empty($rows)) {
            fputcsv($handle, array_keys($rows[0]));
            foreach ($rows as $r) fputcsv($handle, $r);
        }
        rewind($handle);
        $contents = stream_get_contents($handle);
        fclose($handle);
        Storage::disk('local')->put($filename, $contents);
        if ($this->exportId) {
            Export::where('id', $this->exportId)->update(['status'=>'done','completed_at'=>now()]);
        }
    }
}
