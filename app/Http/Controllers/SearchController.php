<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Business;
use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $areas      = Area::orderBy('name')->get();
        $categories = Category::where('status', 'active')->orderBy('name')->get();

        $businesses = collect();
        $jobs       = collect();

        if ($request->filled('q') || $request->filled('area')) {
            $q = $request->q;

            $businessQuery = Business::with(['category', 'area'])
                ->where('status', 'active');

            if ($q) {
                $businessQuery->where(fn($qb) => $qb
                    ->where('name', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                );
            }

            if ($request->filled('area')) {
                $businessQuery->where('area_id', $request->area);
            }

            $businesses = $businessQuery->take(12)->get();

            $jobQuery = JobListing::with(['business', 'area'])
                ->where('status', 'active');

            if ($q) {
                $jobQuery->where(fn($qb) => $qb
                    ->where('title', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                );
            }

            $jobs = $jobQuery->take(6)->get();
        }

        return view('pages.search', compact('areas', 'categories', 'businesses', 'jobs'));
    }
}
