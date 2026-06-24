<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::orderBy('id', 'desc')->get();

        return view('dashboard.plans.index', compact('plans'));
    }

    public function create()
    {
        $plans = new Plan();

        return view('dashboard.plans.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:plans,slug',
            'price' => 'required|numeric',
            'duration_days' => 'required|integer|min:1',

            'businesses_limit' => 'nullable|integer|min:0',
            'jobs_limit' => 'nullable|integer|min:0',
            'images_limit' => 'nullable|integer|min:0',

            'can_feature_business' => 'nullable|boolean',

            'status' => 'required|in:active,inactive',
        ]);

        Plan::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'duration_days' => $request->duration_days,

            'businesses_limit' => $request->businesses_limit,
            'jobs_limit' => $request->jobs_limit,
            'images_limit' => $request->images_limit,

            'can_feature_business' => $request->can_feature_business ?? false,

            'status' => $request->status,
        ]);

        return redirect()
            ->route('dashboard.plan.index')
            ->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        $plans = Plan::findOrFail($id);

        return view('dashboard.plans.edit', compact('plans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:plans,slug,' . $id,
            'price' => 'required|numeric',
            'duration_days' => 'required|integer|min:1',

            'businesses_limit' => 'nullable|integer|min:0',
            'jobs_limit' => 'nullable|integer|min:0',
            'images_limit' => 'nullable|integer|min:0',

            'can_feature_business' => 'nullable|boolean',

            'status' => 'required|in:active,inactive',
        ]);

        $plans = Plan::findOrFail($id);

        $plans->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'duration_days' => $request->duration_days,

            'businesses_limit' => $request->businesses_limit,
            'jobs_limit' => $request->jobs_limit,
            'images_limit' => $request->images_limit,

            'can_feature_business' => $request->can_feature_business ?? false,

            'status' => $request->status,
        ]);

        return redirect()
            ->route('dashboard.plan.index')
            ->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        $plans = Plan::findOrFail($id);

        $plans->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.plan.index')
            ->with('success', __('Item deleted successfully.'));
    }
}