<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $query = Business::with(['category', 'area'])
            ->where('status', 'active');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(fn($qb) => $qb
                ->where('title', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%")
            );
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('area')) {
            $query->where('area_id', $request->area);
        }

        if ($request->categories) {
            $query->whereIn('category_id', (array) $request->categories);
        }

        if ($request->areas) {
            $query->whereIn('area_id', (array) $request->areas);
        }

        if ($request->min_rating) {
            $query->where('avg_rating', '>=', $request->min_rating);
        }

        match ($request->sort) {
            'rating'  => $query->orderByDesc('avg_rating'),
            'newest'  => $query->orderByDesc('created_at'),
            default   => $query->orderByDesc('views_count'),
        };

        $businesses = $query->paginate(12)->withQueryString();

        $categories = Category::where('status', 'active')->orderBy('name')->get();
        $areas = Area::orderBy('name')->get();

        return view('pages.businesses.index', compact('businesses', 'categories', 'areas'));
    }

    public function show(string $slug)
    {
        $business = Business::with([
            'category', 'area', 'images', 'services',
            'workingHours', 'reviews.user',
        ])->where('slug', $slug)->where('status', 'active')->firstOrFail();

        $business->increment('views_count');

        $similar = Business::with(['category', 'area'])
            ->where('status', 'active')
            ->where('id', '!=', $business->id)
            ->where(fn($q) => $q
                ->where('category_id', $business->category_id)
                ->orWhere('area_id', $business->area_id)
            )
            ->take(4)
            ->get();

        return view('pages.businesses.show', compact('business', 'similar'));
    }
}
