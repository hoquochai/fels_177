<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Word;
use App\Models\WordAnswer;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\App;

class ExportPdfController extends Controller
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
        $wordAnswers = WordAnswer::with('word')
            ->where('correct', config('common.word_answer.correct.result_true'))->get();
        $pdf = app('dompdf.wrapper');
        $pdfData = view('user.pdf-template', ['wordAnswers' => $wordAnswers])->render();
        $pdf->loadHTML($pdfData);
        $fileName = date('Y-m-d H:i:s') . ".pdf";
        return $pdf->download($fileName);
    }
}
