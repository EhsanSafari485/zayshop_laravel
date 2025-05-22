<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\category\categoryEditRequest;
use App\Http\Requests\category\categoryRequest;
use App\Models\Panel\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class categoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Category::orderBy('id', 'DESC')->get();
        return view('Panel.Category.index',compact('Categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Panel.Category.create');
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(categoryRequest $request)
    {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/Category'), $imageName);
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug, '-'),
            'image' => $imageName
        ]);

        return redirect()->route('Panel.category.index')->with('success','عملیات ثپت با موفقیت انجام شد');

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
        $Category=Category::findOrFail($id);
        return view('Panel.Category.edit',compact('Category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(categoryEditRequest $request,$id)
    {
        $Category = Category::findOrFail($id);
        $Category->name = $request->name;
        $Category->slug = Str::slug($request->slug, '-');
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/Category'), $imageName);
            $oldImage = public_path('images/Category/' . $Category->image);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
                  $Category->image = $imageName;
        }

        $Category->update();

        return redirect()->route('Panel.category.index')->with('success', 'عملیات ویرایش با موفقیت انجام شد');

    }


    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $Category = Category::find($id);
    if ($Category) {
        if ($Category->image) {
            $oldImage = public_path('images/Category/' . $Category->image);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
        $Category->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);

}
}
