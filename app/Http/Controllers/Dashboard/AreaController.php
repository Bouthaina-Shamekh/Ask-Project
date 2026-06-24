<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    public function index()
    {
        // $this->authorize('view', Area::class);

        $areas = Area::orderBy('id', 'desc')->get();

        return view('dashboard.areas.index', compact('areas'));
    }

    public function create()
    {
        // $this->authorize('create', Area::class);

        $areas = new Area();

        return view('dashboard.areas.create', compact('areas'));
    }

    public function store(Request $request)
    {
        // $this->authorize('create', Area::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:areas,slug',
            'status' => 'required|in:active,inactive',
        ]);

        Area::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard.area.index')->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        // $this->authorize('edit', Area::class);

        $areas = Area::findOrFail($id);

        return view('dashboard.areas.edit', compact('areas'));
    }

    public function update(Request $request, $id)
    {
        // $this->authorize('edit', Area::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:areas,slug,' . $id,
            'status' => 'required|in:active,inactive',
        ]);

        $areas = Area::findOrFail($id);

        $areas->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard.area.index')->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        // $this->authorize('delete', Area::class);

        $areas = Area::findOrFail($id);
        $areas->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json(['message' => 'Item deleted successfully.']);
        }

        return redirect()->route('dashboard.area.index')->with('success', __('Item deleted successfully.'));
    }
}