<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Area;
use App\Models\User;
use App\Models\Category;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::with(['owner', 'category', 'area'])
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.businesses.index', compact('businesses'));
    }

    public function create()
    {
        $businesses = new Business();

        $owners = User::orderBy('id', 'desc')->get();
        $categories = Category::where('status', 'active')->orderBy('id', 'desc')->get();
        $areas = Area::where('status', 'active')->orderBy('id', 'desc')->get();

        return view('dashboard.businesses.create', compact(
            'businesses',
            'owners',
            'categories',
            'areas'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'area_id' => 'nullable|exists:areas,id',

            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:businesses,slug',
            'description' => 'nullable|string',

            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            'logo' => 'nullable|image',
            'cover' => 'nullable|image',

            'price_level' => 'nullable|in:low,medium,high',

            'is_open' => 'nullable|boolean',
            'has_delivery' => 'nullable|boolean',
            'family_friendly' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',

            'status' => 'required|in:pending,active,rejected,suspended',
            'rejection_reason' => 'nullable|string',
        ]);

        $logo = $request->hasFile('logo')
            ? $request->file('logo')->store('uploads/businesses/logos', 'public')
            : null;

        $cover = $request->hasFile('cover')
            ? $request->file('cover')->store('uploads/businesses/covers', 'public')
            : null;

        Business::create([
            'owner_id' => $request->owner_id,
            'category_id' => $request->category_id,
            'area_id' => $request->area_id,

            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,

            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'website' => $request->website,
            'address' => $request->address,

            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

            'logo' => $logo,
            'cover' => $cover,

            'price_level' => $request->price_level,

            'is_open' => $request->is_open ?? false,
            'has_delivery' => $request->has_delivery ?? false,
            'family_friendly' => $request->family_friendly ?? false,
            'is_featured' => $request->is_featured ?? false,

            'status' => $request->status,
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()
            ->route('dashboard.business.index')
            ->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        $businesses = Business::findOrFail($id);

        $owners = User::orderBy('id', 'desc')->get();
        $categories = Category::where('status', 'active')->orderBy('id', 'desc')->get();
        $areas = Area::where('status', 'active')->orderBy('id', 'desc')->get();

        return view('dashboard.businesses.edit', compact(
            'businesses',
            'owners',
            'categories',
            'areas'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'area_id' => 'nullable|exists:areas,id',

            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:businesses,slug,' . $id,
            'description' => 'nullable|string',

            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            'logo' => 'nullable|image',
            'cover' => 'nullable|image',

            'price_level' => 'nullable|in:low,medium,high',

            'is_open' => 'nullable|boolean',
            'has_delivery' => 'nullable|boolean',
            'family_friendly' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',

            'status' => 'required|in:pending,active,rejected,suspended',
            'rejection_reason' => 'nullable|string',
        ]);

        $businesses = Business::findOrFail($id);

        $logo = $businesses->logo;
        if ($request->hasFile('logo')) {
            if ($businesses->logo && Storage::disk('public')->exists($businesses->logo)) {
                Storage::disk('public')->delete($businesses->logo);
            }

            $logo = $request->file('logo')->store('uploads/businesses/logos', 'public');
        }

        $cover = $businesses->cover;
        if ($request->hasFile('cover')) {
            if ($businesses->cover && Storage::disk('public')->exists($businesses->cover)) {
                Storage::disk('public')->delete($businesses->cover);
            }

            $cover = $request->file('cover')->store('uploads/businesses/covers', 'public');
        }

        $businesses->update([
            'owner_id' => $request->owner_id,
            'category_id' => $request->category_id,
            'area_id' => $request->area_id,

            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,

            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'website' => $request->website,
            'address' => $request->address,

            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

            'logo' => $logo,
            'cover' => $cover,

            'price_level' => $request->price_level,

            'is_open' => $request->is_open ?? false,
            'has_delivery' => $request->has_delivery ?? false,
            'family_friendly' => $request->family_friendly ?? false,
            'is_featured' => $request->is_featured ?? false,

            'status' => $request->status,
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()
            ->route('dashboard.business.index')
            ->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        $businesses = Business::findOrFail($id);

        if ($businesses->logo && Storage::disk('public')->exists($businesses->logo)) {
            Storage::disk('public')->delete($businesses->logo);
        }

        if ($businesses->cover && Storage::disk('public')->exists($businesses->cover)) {
            Storage::disk('public')->delete($businesses->cover);
        }

        $businesses->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.business.index')
            ->with('success', __('Item deleted successfully.'));
    }
}