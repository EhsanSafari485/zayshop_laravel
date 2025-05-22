<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\sliders\requestSlider;
use App\Http\Requests\sliders\requestSliderEdit;
use App\Models\Panel\sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class sliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = sliders::orderBy('id', 'DESC')->get();
        return view('Panel.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Panel.sliders.create');
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(requestSlider $request)
    {
        $request->validate([
            'role'=>'required'
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/Sliders'), $imageName);
        Sliders::create([
            'url' => $request->url,
            'image' => $imageName,
            'role'=>$request->role
        ]);

        return redirect()->route('Panel.Sliders.index')->with('success','عملیات ثپت با موفقیت انجام شد');

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
        $slider=sliders::findOrFail($id);
        return view('Panel.sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(requestSliderEdit $request,$id)
    {
        $slider = sliders::findOrFail($id);
        $request->validate([
            'role' => 'required'
        ]);

        $slider->url = $request->url;
        $slider->role = $request->role;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/sliders'), $imageName);
            $oldImage = public_path('images/sliders/' . $slider->image);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
                  $slider->image = $imageName;
        }

        $slider->update();

        return redirect()->route('Panel.Sliders.index')->with('success', 'عملیات ویرایش با موفقیت انجام شد');

    }


    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $slider = Sliders::find($id);
    if ($slider) {
        if ($slider->image) {
            $oldImage = public_path('images/sliders/' . $slider->image);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
        $slider->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'اسلایدر پیدا نشد']);

}

}
