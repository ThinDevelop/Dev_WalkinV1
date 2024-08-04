<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function downloadPDF($filename)
    {
        $file = public_path('pdf/' . $filename);
        return response()->download($file);
    }
}
