<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('businesses')
            ->where('status', 'active')
            ->orderByDesc('businesses_count')
            ->get();

        return view('pages.categories.index', compact('categories'));
    }

    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)->where('status', 'active')->firstOrFail();

        $query = $category->businesses()->with(['category', 'area'])->where('status', 'active');

        if (request('q')) {
            $q = request('q');
            $query->where(fn($qb) => $qb->where('name', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%"));
        }
        if (request('open_now')) {
            $query->where('is_open', true);
        }
        if (request('top_rated')) {
            $query->where('rating_avg', '>=', 4);
        }
        if (request()->filled('areas')) {
            $query->whereIn('area_id', request('areas'));
        }
        if (request('area')) {
            $query->where('area_id', request('area'));
        }

        match (request('sort', 'rating')) {
            'newest' => $query->orderByDesc('created_at'),
            'views'  => $query->orderByDesc('views_count'),
            default  => $query->orderByDesc('rating_avg'),
        };

        $businesses        = $query->paginate(12)->withQueryString();
        $areas             = Area::orderBy('name')->get();
        $relatedCategories = Category::where('status', 'active')->where('id', '!=', $category->id)->take(4)->get();

        return view('pages.categories.show', compact('category', 'businesses', 'areas', 'relatedCategories'));
    }
}
