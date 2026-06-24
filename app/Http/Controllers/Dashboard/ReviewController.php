<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Review;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['business', 'user'])
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $reviews = new Review();

        $businesses = Business::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('dashboard.reviews.create', compact(
            'reviews',
            'businesses',
            'users'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        Review::create([
            'business_id' => $request->business_id,
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('dashboard.review.index')
            ->with('success', __('Item created successfully.'));
    }

    public function edit($id)
    {
        $reviews = Review::findOrFail($id);

        $businesses = Business::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('dashboard.reviews.edit', compact(
            'reviews',
            'businesses',
            'users'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $reviews = Review::findOrFail($id);

        $reviews->update([
            'business_id' => $request->business_id,
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('dashboard.review.index')
            ->with('success', __('Item updated successfully.'));
    }

    public function destroy($id)
    {
        $reviews = Review::findOrFail($id);

        $reviews->delete();

        $request = request();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully.'
            ]);
        }

        return redirect()
            ->route('dashboard.review.index')
            ->with('success', __('Item deleted successfully.'));
    }
}