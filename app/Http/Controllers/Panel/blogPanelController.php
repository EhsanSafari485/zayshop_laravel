<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\blog\blogEditRequest;
use App\Http\Requests\blog\blogRequest;
use App\Models\blog\blogCategories;
use App\Models\blog\blogComments;
use App\Models\blog\blogs;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class blogPanelController extends Controller
{
     public function index()
    {
        $blogs=blogs::with('users','category')->orderBy('id','desc')->get();
        return view('Panel.blogs.index',compact('blogs'));
    }
    public function create()
{
    $categories = blogCategories::all();
    return view('Panel.blogs.create', compact('categories'));
}

public function store(blogRequest $request)
{
    if ($request->hasFile('cover_image')) {
        $image=$request->cover_image;
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/coverBlog'), $imageName);
    }

    blogs::create([
        'writer_id' => Auth::id(),
        'title' => $request->title,
        'slug' => $request->slug,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'cover_image' => $imageName,
        'published_at' => Carbon::now(),
    ]);

    return redirect()->route('Panel.blogs.index')->with('success', 'پست با موفقیت ایجاد شد.');
}

public function upload(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/uploads', $filename);
        $url = asset('storage/uploads/' . $filename);

        return response()->json([
            'success' => true,
            'url' => $url,
        ]);
    }

    return response()->json(['success' => false], 400);
}

public function destroy($id){
    $blog=blogs::find($id);
    if ($blog) {
        if ($blog->image) {
            $oldImage = public_path('images/coverBlog/' . $blog->image);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
            $blog->delete();
    return response()->json([
        'success' => true,
    ]);
    return response()->json(['success' => false]);

    }
}

public function edit($id){
    $blog=blogs::findOrfail($id);
    $categories=blogCategories::all();
    return view('Panel.blogs.edit',compact('id','blog','categories'));
}

public function update(blogEditRequest $request,$id)
{
    $blogs = blogs::findOrFail($id);
    if ($request->hasFile('cover_image')) {
        $image=$request->cover_image;
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/coverBlog'), $imageName);
        $oldImage = public_path('images/coverBlog/' . $blogs->cover_image);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
                $blogs->cover_image = $imageName;
    }
    $blogs->title=$request->title;
    $blogs->category_id=$request->category_id;
    $blogs->slug=$request->slug;
    $blogs->content=$request->content;
    $blogs->update();

    return redirect()->route('Panel.blogs.index')->with('success', 'پست با موفقیت ویرایش شد.');
}

    public function category(){
        $categories=blogCategories::orderBy('id','desc')->get();
        return view('Panel.blogs.catrgory',compact('categories'));
    }

    public function categoryStore(Request $request){
       $category=blogCategories::create([
            'name' => $request->name,
        ]);
        return response()->json([
            'success' => true,
            'name' => $category->name,
            'id' => $category->id,
        ]);
    }

        public function categoryDestroy( $id){
       blogCategories::find($id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }


    public function comments(){
        $comments=blogComments::with('users','blog')->orderByDesc('id')->get();
        return view('Panel.blogs.comments',compact('comments'));
    }

    public function commentModal(Request $request){
        $comment=blogComments::findOrFail($request->id);
        return view('Panel.blogs.commentModal',compact('comment'))->render();
    }

public function updateStatus(Request $request, $id)
{
    $comment = blogComments::findOrFail($id);
    $comment->update([
        'approved' => $request->approved
    ]);

    return response()->json(['success' => true]);
}

}
