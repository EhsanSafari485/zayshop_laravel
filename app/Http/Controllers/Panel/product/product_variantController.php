<?php

namespace App\Http\Controllers\Panel\product;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Panel\Products\color;
use App\Models\Panel\Products\product_variants;
use App\Models\Panel\Products\size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class product_variantController extends Controller
{
    public function index($id)
    {
        $product_variants = product_variants::where('product_id', $id)->get();
        $colors=color::all();
        $sizes=size::all();
        return view('Panel.product.product_variants.index',compact('product_variants','id','colors','sizes'));
    }
    public function store(Request $request,$id)
    {
               $productVariant=product_variants::create([
                    'product_id' => $id,
                    'color_id' => $request->color_id,
                    'size_id' => $request->size_id,
                    'stock' => $request->stock
                ]);
                return response()->json([
                    'success' => true,
                    'data' => [
                        'id' => $productVariant->id,
                        'color_name' => $productVariant->color->name,
                        'color_code' => $productVariant->color->code,
                        'size_name' => $productVariant->size->name,
                        'stock' => $productVariant->stock,
                    ]
                ]);

    }
    public function destroy($id)
    {
    $product_variant = product_variants::find($id);
    if ($product_variant) {
        $product_variant->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);

}
}
