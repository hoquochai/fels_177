<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Word;
use App\Models\WordAnswer;
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
        $wordAnswers = WordAnswer::with('word')->where('correct', config('common.word_answer.correct.result_true'))->get();
        $pdf = app('dompdf.wrapper');
        $pdfData = trans('client/word_list/names.word_list.header_pdf_file');
        if (count($wordAnswers)) {
            foreach ($wordAnswers as $wordAnswer) {
                $pdfData .= trans('client/word_list/names.word_list.content_pdf_file', ['words' => $wordAnswer->word->content, 'wordAnswers' => $wordAnswer->content ]);
            }
        }

        $pdf->loadHTML($pdfData);
        $fileName = date('Y-m-d H:i:s') . ".pdf";
        return $pdf->download($fileName);
    }
}
