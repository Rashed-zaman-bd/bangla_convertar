<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
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

        $advertisements = Advertisement::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('position');

        return view('newspapers.index', [
            'categories' => $categories,
            'advertisements' => $advertisements,
            'adEvery' => 2,
        ]);
    }
}
