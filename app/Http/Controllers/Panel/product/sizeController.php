<?php

namespace App\Http\Controllers\Panel\product;

use App\Http\Controllers\Controller;
use App\Models\Panel\Products\size;
use Illuminate\Http\Request;

class sizeController extends Controller
{
    public function index()
    {
        $sizes = size::all();
        return view('Panel.product.size.index',compact('sizes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $sizeData=[];
        $size=size::create([
                    'name' => $request->name
                ]);
                $sizeData[]=[
                    'id'=>$size->id,
                    'name'=>$size->name
                ];
        return response()->json([
            'success' => true,
            'data' => $sizeData
        ]);
    }

    public function destroy($id)
    {
    $size = size::find($id);
    if ($size) {
        $size->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);

}
}
