<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::with(['business', 'area'])
            ->where('status', 'active')
            ->where(fn($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>=', now()));

        if ($request->filled('q')) {
            $kw = $request->q;
            $query->where(fn($q) => $q
                ->where('title', 'like', "%$kw%")
                ->orWhere('description', 'like', "%$kw%")
            );
        }

        if ($request->filled('type')) {
            $query->where('employment_type', $request->type);
        }

        if ($request->types) {
            $query->whereIn('employment_type', (array) $request->types);
        }

        if ($request->experience) {
            $query->whereIn('experience_level', (array) $request->experience);
        }

        if ($request->filled('area')) {
            $query->where('area_id', $request->area);
        }

        if ($request->areas) {
            $query->whereIn('area_id', (array) $request->areas);
        }

        if ($request->date === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($request->date === 'week') {
            $query->where('created_at', '>=', now()->subDays(7));
        }

        match ($request->sort) {
            'salary'  => $query->orderByDesc('salary_max'),
            'expiry'  => $query->orderBy('expires_at'),
            default   => $query->orderByDesc('created_at'),
        };

        $jobs = $query->paginate(12)->withQueryString();
        $areas = Area::orderBy('name')->get();

        return view('pages.jobs.index', compact('jobs', 'areas'));
    }

    public function show(string $slug)
    {
        $job = JobListing::with(['business.category', 'area'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $job->increment('views_count');

        $similar = JobListing::with(['business', 'area'])
            ->where('status', 'active')
            ->where('id', '!=', $job->id)
            ->where(fn($q) => $q
                ->where('employment_type', $job->employment_type)
                ->orWhere('area_id', $job->area_id)
            )
            ->take(4)
            ->get();

        return view('pages.jobs.show', compact('job', 'similar'));
    }

    public function apply(Request $request, string $slug)
    {
        $job = JobListing::where('slug', $slug)->where('status', 'active')->firstOrFail();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'email'     => 'nullable|email|max:255',
            'cv'        => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'message'   => 'nullable|string|max:2000',
        ]);

        // Prevent duplicate
        if (JobApplication::where('job_id', $job->id)->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'لقد تقدمت على هذه الوظيفة مسبقاً.');
        }

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('job-cvs', 'public');
        }

        JobApplication::create([
            'job_id'    => $job->id,
            'user_id'   => auth()->id(),
            'full_name' => $validated['full_name'],
            'phone'     => $validated['phone'],
            'email'     => $validated['email'] ?? null,
            'cv'        => $cvPath,
            'message'   => $validated['message'] ?? null,
        ]);

        $job->increment('applications_count');

        return back()->with('success', 'تم إرسال طلبك بنجاح! سيتواصل معك صاحب العمل قريباً.');
    }
}
