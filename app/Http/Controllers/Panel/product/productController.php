<?php

namespace App\Http\Controllers\Panel\product;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\product\productEditRequest;
use App\Http\Requests\product\productRequest;
use App\Models\Panel\Category;
use App\Models\Panel\Products\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class productController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::orderBy('id', 'DESC')->get();
        $Categories = Category::all();
        return view('Panel.product.index',compact('products','Categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('Panel.product.create',compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(productRequest $request)
    {
        if ($request->has('discount')) {
            $discount=$request->discount;
        }
        $request->discount;
        product::create([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $discount,
            'brand' => $request->brand,
            'slug' => Str::slug($request->slug, '-'),
            'category_id' => $request->category_id,
            'description' => $request->description
        ]);

        return redirect()->route('Panel.product.index')->with('success','عملیات ثپت با موفقیت انجام شد');

    }


    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=product::findOrFail($id);
        $Categories = Category::all();
        return view('Panel.product.edit',compact('product','Categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(productEditRequest $request,$id)
    {
        $product = product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->brand = $request->brand;
        $product->slug = Str::slug($request->slug, '-');
        $product->category_id = $request->category_id;
        $product->description = $request->description;

        $product->update();

        return redirect()->route('Panel.product.index')->with('success', 'عملیات ویرایش با موفقیت انجام شد');

    }


    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $product = product::find($id);
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
