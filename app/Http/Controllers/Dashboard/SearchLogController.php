<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\SearchLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchLogController extends Controller
{
    public function index()
    {
        $searchLogs = SearchLog::with('user')
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.search_logs.index', compact('searchLogs'));
    }

    public function destroy($id)
    {
        $searchLogs = SearchLog::findOrFail($id);

        $searchLogs->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.search-log.index')
            ->with('success', __('Item deleted successfully.'));
    }
}