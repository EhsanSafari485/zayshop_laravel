<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\blog\blogs;
use Illuminate\Http\Request;

class blogController extends Controller
{
        public function index()
    {
        $blogs = blogs::latest()->paginate(15);
        return view('blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = blogs::where('slug', $slug)->firstOrFail();

        $blog->increment('views');

        return view('blogs.show', compact('blog'));
    }
}
