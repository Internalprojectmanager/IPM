<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feature;
use PDF;

class PDFController extends Controller
{
    public function pdf()
    {
        $features = Feature::all();

        $pdf = PDF::loadView('pdf', ['features' => $features]);
        return $pdf->download('release.pdf');
    }
}