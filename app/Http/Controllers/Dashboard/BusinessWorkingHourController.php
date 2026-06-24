<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessWorkingHour;

class BusinessWorkingHourController extends Controller
{
    public function index()
    {
        $businessWorkingHours = BusinessWorkingHour::with('business')
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.business_working_hours.index', compact('businessWorkingHours'));
    }

    public function create()
    {
        $businessWorkingHours = new BusinessWorkingHour();

        $businesses = Business::orderBy('name')->get();

        return view('dashboard.business_working_hours.create', compact(
            'businessWorkingHours',
            'businesses'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'day_of_week' => 'required|integer|min:0|max:6',
            'opens_at' => 'nullable',
            'closes_at' => 'nullable',
            'is_closed' => 'nullable|boolean',
        ]);

        BusinessWorkingHour::create([
            'business_id' => $request->business_id,
            'day_of_week' => $request->day_of_week,
            'opens_at' => $request->opens_at,
            'closes_at' => $request->closes_at,
            'is_closed' => $request->is_closed ?? false,
        ]);

        return redirect()
            ->route('dashboard.business-working-hour.index')
            ->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        $businessWorkingHours = BusinessWorkingHour::findOrFail($id);

        $businesses = Business::orderBy('name')->get();

        return view('dashboard.business_working_hours.edit', compact(
            'businessWorkingHours',
            'businesses'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'day_of_week' => 'required|integer|min:0|max:6',
            'opens_at' => 'nullable',
            'closes_at' => 'nullable',
            'is_closed' => 'nullable|boolean',
        ]);

        $businessWorkingHours = BusinessWorkingHour::findOrFail($id);

        $businessWorkingHours->update([
            'business_id' => $request->business_id,
            'day_of_week' => $request->day_of_week,
            'opens_at' => $request->opens_at,
            'closes_at' => $request->closes_at,
            'is_closed' => $request->is_closed ?? false,
        ]);

        return redirect()
            ->route('dashboard.business-working-hour.index')
            ->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        $businessWorkingHours = BusinessWorkingHour::findOrFail($id);

        $businessWorkingHours->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.business-working-hour.index')
            ->with('success', __('Item deleted successfully.'));
    }
}