<?php

namespace App\Http\Controllers;

use App\Models\Registry;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    //
    public function printRegistryPdf(Request $request){
        $registry = Registry::find($request->registry);
        //dd($registry->getOverheads());
        $overheads = $registry->getOverheads();
        $pdf = Pdf::loadView('pdf.registry', compact('overheads'));
        return $pdf->download('invoice.pdf');
    }
}
