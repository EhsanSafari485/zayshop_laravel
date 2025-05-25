<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\blog\blogCategories;
use App\Models\blog\blogComments;
use App\Models\blog\blogs;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class blogController extends Controller
{
public function index(Request $request)
{
    $categories = blogCategories::all();

    // فقط یک بار کوئری بساز و با with ترکیب کن
    $query = blogs::with('category','comments','users');

    // فیلتر دسته‌بندی
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // فیلتر جستجو
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('title', 'LIKE', "%{$search}%");
    }

    // گرفتن نتایج
    $blogs = $query->latest()->paginate(9);

    // پاسخ برای AJAX
    if ($request->ajax()) {
        return view('blogs.partial.blog', compact('blogs', 'categories'))->render();
    }

    // پاسخ برای بارگذاری کامل صفحه
    return view('blogs.index', compact('blogs', 'categories'));
}



public function show($slug)
{
    $blog = blogs::with([
    'category',
    'users',
])->where('slug', $slug)->firstOrFail();

    $sessionKey = 'blog_viewed_' . $blog->id;
    if (!session()->has($sessionKey)) {
        $blog->increment('views');
        session()->put($sessionKey, true);
    }

    $relatedBlogs = blogs::where('category_id', $blog->category_id)
        ->where('id', '!=', $blog->id)
        ->latest()
        ->take(3)
        ->get();

    return view('blogs.show', compact('blog','relatedBlogs'));
}

public function postComment(Request $request){

    blogComments::create([
        'blog_id' => $request->blog_id,
        'user_id' => Auth::id(),
        'comment' => $request->comment,
    ]);
        return response()->json([
            'success' => true,
        ]);
}

public function loadComments(Request $request)
{
    $blogId = $request->input('blog_id');
    $page = $request->input('page', 1);
    $perPage = 5;

    $comments = blogComments::where('blog_id', $blogId)
        ->where('approved', true)
        ->orderByDesc('created_at')
        ->skip(($page - 1) * $perPage)
        ->take($perPage)
        ->get();

    $view = view('blogs.partial.comment_items', compact('comments'))->render();

    return response()->json([
        'html' => $view,
        'has_more' => blogComments::where('blog_id', $blogId)
                          ->where('approved', true)
                          ->count() > $page * $perPage
    ]);
}

}
