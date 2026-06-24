<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Business;
use App\Models\BusinessImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BusinessImageController extends Controller
{
    public function index()
    {
        $businessImages = BusinessImage::with('business')
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.business_images.index', compact('businessImages'));
    }

    public function create()
    {
        $businessImages = new BusinessImage();

        $businesses = Business::orderBy('name')->get();

        return view('dashboard.business_images.create', compact(
            'businessImages',
            'businesses'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'image' => 'required|image',
            'alt' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $img = $request->file('image')
            ->store('uploads/business-images', 'public');

        BusinessImage::create([
            'business_id' => $request->business_id,
            'image' => $img,
            'alt' => $request->alt,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('dashboard.business-image.index')
            ->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        $businessImages = BusinessImage::findOrFail($id);

        $businesses = Business::orderBy('name')->get();

        return view('dashboard.business_images.edit', compact(
            'businessImages',
            'businesses'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'image' => 'nullable|image',
            'alt' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $businessImages = BusinessImage::findOrFail($id);

        $img = $businessImages->image;

        if ($request->hasFile('image')) {

            if (
                $businessImages->image &&
                Storage::disk('public')->exists($businessImages->image)
            ) {
                Storage::disk('public')->delete($businessImages->image);
            }

            $img = $request->file('image')
                ->store('uploads/business-images', 'public');
        }

        $businessImages->update([
            'business_id' => $request->business_id,
            'image' => $img,
            'alt' => $request->alt,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('dashboard.business-image.index')
            ->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        $businessImages = BusinessImage::findOrFail($id);

        if (
            $businessImages->image &&
            Storage::disk('public')->exists($businessImages->image)
        ) {
            Storage::disk('public')->delete($businessImages->image);
        }

        $businessImages->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.business-image.index')
            ->with('success', __('Item deleted successfully.'));
    }
}