<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Plan;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['business', 'plan'])
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $subscriptions = new Subscription();

        $businesses = Business::orderBy('name')->get();
        $plans = Plan::orderBy('name')->get();

        return view('dashboard.subscriptions.create', compact(
            'subscriptions',
            'businesses',
            'plans'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'plan_id' => 'required|exists:plans,id',

            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',

            'status' => 'required|in:active,expired,cancelled,pending',

            'amount_paid' => 'nullable|numeric',
            'payment_method' => 'nullable|string|max:255',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        Subscription::create([
            'business_id' => $request->business_id,
            'plan_id' => $request->plan_id,

            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,

            'status' => $request->status,

            'amount_paid' => $request->amount_paid,
            'payment_method' => $request->payment_method,
            'payment_reference' => $request->payment_reference,
        ]);

        return redirect()
            ->route('dashboard.subscription.index')
            ->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        $subscriptions = Subscription::findOrFail($id);

        $businesses = Business::orderBy('name')->get();
        $plans = Plan::orderBy('name')->get();

        return view('dashboard.subscriptions.edit', compact(
            'subscriptions',
            'businesses',
            'plans'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'plan_id' => 'required|exists:plans,id',

            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',

            'status' => 'required|in:active,expired,cancelled,pending',

            'amount_paid' => 'nullable|numeric',
            'payment_method' => 'nullable|string|max:255',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        $subscriptions = Subscription::findOrFail($id);

        $subscriptions->update([
            'business_id' => $request->business_id,
            'plan_id' => $request->plan_id,

            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,

            'status' => $request->status,

            'amount_paid' => $request->amount_paid,
            'payment_method' => $request->payment_method,
            'payment_reference' => $request->payment_reference,
        ]);

        return redirect()
            ->route('dashboard.subscription.index')
            ->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        $subscriptions = Subscription::findOrFail($id);

        $subscriptions->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.subscription.index')
            ->with('success', __('Item deleted successfully.'));
    }
}