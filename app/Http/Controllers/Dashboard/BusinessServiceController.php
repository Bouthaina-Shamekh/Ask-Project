<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\BusinessService;
use App\Http\Controllers\Controller;

class BusinessServiceController extends Controller
{
    public function index()
    {
        $businessServices = BusinessService::with('business')
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.business_services.index', compact('businessServices'));
    }

    public function create()
    {
        $businessServices = new BusinessService();

        $businesses = Business::orderBy('name')->get();

        return view('dashboard.business_services.create', compact(
            'businessServices',
            'businesses'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        BusinessService::create([
            'business_id' => $request->business_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('dashboard.business-service.index')
            ->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        $businessServices = BusinessService::findOrFail($id);

        $businesses = Business::orderBy('name')->get();

        return view('dashboard.business_services.edit', compact(
            'businessServices',
            'businesses'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $businessServices = BusinessService::findOrFail($id);

        $businessServices->update([
            'business_id' => $request->business_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('dashboard.business-service.index')
            ->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        $businessServices = BusinessService::findOrFail($id);

        $businessServices->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.business-service.index')
            ->with('success', __('Item deleted successfully.'));
    }
}