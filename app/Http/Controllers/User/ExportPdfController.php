<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserController;
use App\Models\Word;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;

class ExportPdfController extends UserController
{
    protected $navName = "word";

    public function __construct()
    {
        parent::__construct($this->navName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::pluck('content');
        $pdf = app('dompdf.wrapper');
        $pdfData = trans('client/name.word_list.header_pdf_file');
        if (count($words)) {
            foreach ($words as $word) {
                $pdfData .= trans('client/name.word_list.content_pdf_file', ['words' => $word]);
            }
        }

        $pdf->loadHTML($pdfData);
        $filename = date('Y-m-d H:i:s') . ".pdf";
        return $pdf->download($filename);
    }
}
