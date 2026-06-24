<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\Job;
use App\Models\Report;
use App\Models\Review;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $pendingBusinesses = Business::with(['category', 'area', 'owner'])
            ->where('status', 'pending')
            ->latest()
            ->limit(3)
            ->get();

        $pendingJobs = Job::with(['business', 'area'])
            ->where('status', 'pending')
            ->latest()
            ->limit(3)
            ->get();

        $pendingReports = Report::with('reportable')
            ->where('status', 'pending')
            ->latest()
            ->limit(2)
            ->get();

        $stats = [
            'businesses' => Business::count(),
            'pending_businesses' => Business::where('status', 'pending')->count(),
            'active_jobs' => Job::where('status', 'active')->count(),
            'pending_jobs' => Job::where('status', 'pending')->count(),
            'users' => User::where('type', 'user')->count(),
            'active_subscriptions' => Subscription::where('status', 'active')->count(),
            'weekly_reviews' => Review::where('created_at', '>=', now()->startOfWeek())->count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
            'expiring_subscriptions' => Subscription::where('status', 'active')
                ->whereBetween('ends_at', [now(), now()->addDays(7)])
                ->count(),
        ];

        $dataQuality = [
            'without_images' => Business::doesntHave('images')->count(),
            'without_hours' => Business::doesntHave('workingHours')->count(),
            'without_location' => Business::whereNull('latitude')->orWhereNull('longitude')->count(),
            'jobs_without_expiry' => Job::whereNull('expires_at')->count(),
        ];

        $categories = Category::withCount('businesses')
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        return view('dashboard.admin.index', compact(
            'categories',
            'dataQuality',
            'pendingBusinesses',
            'pendingJobs',
            'pendingReports',
            'stats',
        ));
    }
}
