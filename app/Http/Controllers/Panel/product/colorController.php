<?php

namespace App\Http\Controllers\Panel\product;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Panel\Products\color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class colorController extends Controller
{
    public function index()
    {
        $colors = color::all();
        return view('Panel.product.color.index',compact('colors'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'code'=>'required'
        ]);
        $colorData=[];
        $color=color::create([
                    'name' => $request->name,
                    'code' => $request->code
                ]);
                $colorData[]=[
                    'id'=>$color->id,
                    'name'=>$color->name,
                    'code'=>$color->code
                ];
        return response()->json([
            'success' => true,
            'data' => $colorData
        ]);
    }

    public function destroy($id)
    {
    $color = color::find($id);
    if ($color) {
        $color->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);

}
}
