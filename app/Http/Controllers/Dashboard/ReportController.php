<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('user')
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.reports.index', compact('reports'));
    }

    public function create()
    {
        $reports = new Report();

        $users = User::orderBy('name')->get();

        return view('dashboard.reports.create', compact(
            'reports',
            'users'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'reportable_id' => 'required|integer',
            'reportable_type' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,reviewed,resolved,rejected',
        ]);

        Report::create([
            'user_id' => $request->user_id,
            'reportable_id' => $request->reportable_id,
            'reportable_type' => $request->reportable_type,
            'reason' => $request->reason,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('dashboard.report.index')
            ->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        $reports = Report::findOrFail($id);

        $users = User::orderBy('name')->get();

        return view('dashboard.reports.edit', compact(
            'reports',
            'users'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'reportable_id' => 'required|integer',
            'reportable_type' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,reviewed,resolved,rejected',
        ]);

        $reports = Report::findOrFail($id);

        $reports->update([
            'user_id' => $request->user_id,
            'reportable_id' => $request->reportable_id,
            'reportable_type' => $request->reportable_type,
            'reason' => $request->reason,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('dashboard.report.index')
            ->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        $reports = Report::findOrFail($id);

        $reports->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.report.index')
            ->with('success', __('Item deleted successfully.'));
    }
}