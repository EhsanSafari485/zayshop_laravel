<?php

namespace App\Http\Controllers\Panel\product;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Panel\Products\product_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class product_imageController extends Controller
{
    public function index($id)
    {
        $product_images = product_image::where('product_id', $id)->get();
        return view('Panel.product.product_image.index',compact('product_images','id'));
    }
    public function store(Request $request, $id)
    {
        $imagesData = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/product'), $imageName);

                $productImage = product_image::create([
                    'image' => $imageName,
                    'product_id' => $id,
                ]);

                $imagesData[] = [
                    'id' => $productImage->id,
                    'image' => $imageName,
                    'product_id' => $productImage->product_id,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'data' => $imagesData
        ]);
    }

    public function destroy($id)
    {
    $product = product_image::find($id);
    if ($product) {
        if ($product->image) {
            $oldImage = public_path('images/product/' . $product->image);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
        $product->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);

}
}
