<?php

namespace App\Http\Controllers;

use App\Models\Export;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ExportsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $exports = Export::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('exports.index', compact('exports'));
    }

    public function download(Export $export)
    {
        $userId = Auth::id();
        if ($export->user_id !== $userId) {
            abort(403);
        }
        if (!$export->filename || !Storage::disk('local')->exists($export->filename)) {
            abort(404, 'File not found');
        }
        return Storage::disk('local')->download($export->filename);
    }
}
