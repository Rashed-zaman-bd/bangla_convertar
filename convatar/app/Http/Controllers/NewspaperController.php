<?php

namespace App\Http\Controllers;

use App\Models\NewspaperCategory;
use Illuminate\View\View;

class NewspaperController extends Controller
{
    public function index(): View
    {
        $categories = NewspaperCategory::query()
            ->where('is_active', true)
            ->with(['newspapers' => fn ($query) => $query
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')])
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('newspapers.index', [
            'categories' => $categories,
            'adEvery' => 2,
        ]);
    }
}
