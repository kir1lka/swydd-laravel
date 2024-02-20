<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index($userId)
    {
        $wishlist = wishlist::where('user_id', $userId)->get();

        return response()->json(['data' => $wishlist]);
    }
    public function addToWishlist(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $wishlist = wishlist::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ]);

        return response()->json(['message' => 'Item added to wishlist', 'data' => $wishlist], 201);
    }

    public function removeFromWishlist(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        wishlist::where('user_id', $request->user_id)->where('post_id', $request->post_id)->delete();

        return response()->json(['message' => 'Item removed from wishlist']);
    }
}
