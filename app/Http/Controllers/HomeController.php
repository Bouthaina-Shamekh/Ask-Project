<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Business;
use App\Models\Category;
use App\Models\JobListing;
use App\Models\Review;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $areas = Area::orderBy('name')->get();

        $categories = Category::withCount('businesses')
            ->where('status', 'active')
            ->orderByDesc('businesses_count')
            ->take(6)
            ->get();

        $featuredBusinesses = Business::with(['category', 'area'])
            ->where('status', 'active')
            ->orderByDesc('views_count')
            ->take(3)
            ->get();

        $latestJobs = JobListing::with(['business', 'area'])
            ->where('status', 'active')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $topRated = Business::with(['category', 'area'])
            ->where('status', 'active')
            ->orderByDesc('rating_avg')
            ->take(4)
            ->get();

        $stats = [
            'businesses' => number_format(Business::where('status', 'active')->count()) . '+',
            'jobs'       => JobListing::where('status', 'active')->count(),
            'reviews'    => number_format(Review::count()) . '+',
            'users'      => number_format(User::count()) . 'k',
        ];

        return view('pages.home', compact(
            'areas', 'categories', 'featuredBusinesses', 'latestJobs', 'topRated', 'stats'
        ));
    }
}
