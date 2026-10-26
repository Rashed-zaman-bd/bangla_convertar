<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\{TextRun, Text};

class ConverterController extends Controller
{
    public function index() { return view('converter'); }

    public function extractDocx(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:docx|max:2048']);

        $phpWord = IOFactory::load($request->file('file')->getRealPath());
        $lines = [];

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $el) {
                if ($el instanceof TextRun) {
                    $line = '';
                    foreach ($el->getElements() as $child) {
                        if ($child instanceof Text) $line .= $child->getText();
                    }
                    $lines[] = $line;
                } elseif ($el instanceof Text) {
                    $lines[] = $el->getText();
                }
            }
        }

        return response()->json(['text' => implode("\n", $lines)]);
    }
}
