<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = new Category();

        return view('dashboard.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
        ]);

        $img = $request->hasFile('image')
            ? $request->file('image')->store('uploads/categories', 'public')
            : null;

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $img,
            'description' => $request->description,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('dashboard.category.index')
            ->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);

        return view('dashboard.categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
            'image' => 'nullable|image',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
        ]);

        $categories = Category::findOrFail($id);

        $img = $categories->image;

        if ($request->hasFile('image')) {

            if (
                $categories->image &&
                Storage::disk('public')->exists($categories->image)
            ) {
                Storage::disk('public')->delete($categories->image);
            }

            $img = $request->file('image')->store('uploads/categories', 'public');
        }

        $categories->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $img,
            'description' => $request->description,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('dashboard.category.index')
            ->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);

        if (
            $categories->image &&
            Storage::disk('public')->exists($categories->image)
        ) {
            Storage::disk('public')->delete($categories->image);
        }

        $categories->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.category.index')
            ->with('success', __('Item deleted successfully.'));
    }
}