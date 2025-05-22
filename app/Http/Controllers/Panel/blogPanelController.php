<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\blog\blogCategories;
use App\Models\blog\blogs;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class blogPanelController extends Controller
{
     public function index()
    {
        return view('Panel.blogs.index');
    }
    public function create()
{
    $categories = blogCategories::all();
    return view('Panel.blogs.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'category_id' => 'required|exists:blogCategories,id',
        'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('cover_image')) {
        $imagePath = $request->file('cover_image')->store('blog_covers', 'public');
    }

    blogs::create([
        'writer_id' => Auth::id(),
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'content' => $request->content,
        'category_id' => $request->category_id,
        'cover_image' => $imagePath,
        'published_at' => Carbon::now(),
    ]);

    return redirect()->route('Panel.blogs.index')->with('success', 'پست با موفقیت ایجاد شد.');
}

public function upload(Request $request)
{
    if ($request->hasFile('upload')) {
        $file = $request->file('upload');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/imageBlog'), $filename);

        $url = asset('images/imageBlog/' . $filename);

        return response()->json([
            'url' => $url
        ]);
    }

    return response()->json(['error' => 'No file uploaded.'], 400);
}

}
