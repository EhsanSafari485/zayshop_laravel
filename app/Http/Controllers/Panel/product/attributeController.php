<?php

namespace App\Http\Controllers\Panel\product;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Panel\products\attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class attributeController extends Controller
{
    public function index($id)
    {
        $attributes = attribute::where('product_id', $id)->get();
        return view('Panel.product.attribute.index',compact('attributes','id'));
    }
    public function store(Request $request, $id)
    {
        $attributes = explode("\n", $request->attribute);
        $attributes = array_map('trim', $attributes);
        $attributeData = [];

        foreach ($attributes as $attribute) {
            $created = attribute::create([
                'attribute' => $attribute,
                'product_id' => $id,
            ]);

            $attributeData[] = [
                'id' => $created->id,
                'attribute' => $created->attribute,
                'product_id' => $created->product_id,
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $attributeData // حالا این یه آرایه از آبجکت‌هاست
        ]);
    }



    public function destroy($id)
    {
    $attribute = attribute::find($id);
    if ($attribute) {
        $attribute->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);

}
}
