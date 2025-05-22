<?php

namespace App\Http\Controllers\favorite;

use App\Http\Controllers\Controller;
use App\Models\Home\Favorite;
use App\Models\Panel\Products\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class favoriteController extends Controller
{
    public function index()
    {
        $favorites=Favorite::where('user_id',Auth::id())->get();
        $products = product::with('images')->get();
        return view('Home.favorite.index', compact('products','favorites'));
    }
    public function toggle(Request $request)
    {
        $user = Auth::user();
        $productId = $request->product_id;

        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['favorited' => false]);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return response()->json(['favorited' => true]);
        }
    }
}
