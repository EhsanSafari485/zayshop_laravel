<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Home\Favorite;
use App\Models\Panel\Category;
use App\Models\Panel\Products\color;
use App\Models\Panel\Products\product;
use App\Models\Panel\Products\product_image;
use App\Models\Panel\Products\product_variants;
use App\Models\Panel\Products\size;
use App\Models\Panel\sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    // صفحه اصلی
    public function index()
    {
        $sliders=sliders::where('role',0)->get();
        if ($sliders->isEmpty()) {
            $sliders=[
                (object)[
                'url' => 'http://google.com',
                'image' => 'default1.jpg',
                'role' => 0
                ],(object)[
                'url' => 'http://google.com',
                'image' => 'default2.jpg',
                'role' => 0
                ],(object)[
                'url' => 'http://google.com',
                'image' => 'default3.jpg',
                'role' => 0
                ]
            ];
        }
        $slider1 = Sliders::where('role', 1)
        ->orderBy('id', 'desc')
        ->take(1)
        ->get();

        if ($slider1->isEmpty()) {
            $slider1=[
                (object)[
                'url' => 'http://google.com',
                'image' => 'default1.jpg',
                'role' => 1
                ]
            ];
        }
        $slider2 = Sliders::where('role', 2)
        ->orderBy('id', 'desc')
        ->take(2)
        ->get();
        if ($slider2->isEmpty()) {
            $slider2=[
                (object)[
                'url' => 'http://google.com',
                'image' => 'default2.jpg',
                'role' => 2
                ],
                (object)[
                'url' => 'http://google.com',
                'image' => 'default3.jpg',
                'role' => 2
                ]
            ];
        }
        $categories=Category::orderBy('id','desc')->take(15)->get();
        $productsNew = Product::with(['images','variants'])
        ->orderBy('id','desc')
        ->take(8)
        ->get();
        $productsDiscount = Product::with(['images','variants'])
        ->orderBy('discount','desc')
        ->take(8)
        ->get();
        $favorites=Favorite::where('user_id',Auth::id())->get();
        // dd($productsNew);
       return view('Home.index',compact('sliders','categories','slider1','slider2','productsNew','productsDiscount','favorites'));
    }

    // درباره ما
    public function about()
    {
        return view('Home.about');
    }

    // فروشگاه
    public function shop(Request $request)
    {
        $categories=Category::all();
        $images = product_image::all();
        $variants = product_variants::all();
        $sizes = size::all();
        $colors = color::all();
        $favorites=Favorite::where('user_id',Auth::id())->get();
        $query = Product::query();

    // فیلتر دسته‌بندی
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

// فیلتر سایز
if ($request->filled('size')) {
    $query->whereHas('variants', function ($q) use ($request) {
        $q->whereIn('size_id', $request->size); // استفاده از whereIn برای فیلتر کردن چندین سایز
    });
}

// فیلتر رنگ
if ($request->filled('color')) {
    $query->whereHas('variants', function ($q) use ($request) {
        $q->whereIn('color_id', $request->color); // استفاده از whereIn برای فیلتر کردن چندین رنگ
    });
}
    // فیلتر بازه قیمت
    if ($request->filled('price_min')) {
        $query->where('price', '>=', $request->price_min);
    }
    if ($request->filled('price_max')) {
        $query->where('price', '<=', $request->price_max);
    }
    // فیلتر موجودی
    if ($request->filled('in_stock') && $request->in_stock == '1') {
        $query->whereHas('stock', function ($q) {
            $q->where('stock', '>', 0); // بررسی موجودی محصول
        });
    }

    // مرتب‌سازی
    if ($request->has('sort')) {
        switch ($request->sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'discounted':
                $query->orderBy('discount', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
        }
    }

        // اعمال فیلتر جستجو
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $products = $query->paginate(15);

        if ($request->ajax()) {
            return view('Home.partials.products', compact('products', 'images','variants','favorites'))->render();
        }

        return view('Home.shop', compact('products', 'images', 'variants', 'sizes','categories','colors','favorites'));
    }

    // نمایش محصول
    public function shop_single($slug)
    {
        $favorites=Favorite::where('user_id',Auth::id())->get();
        $product = Product::with(['category', 'images', 'variants.size', 'variants.color','attributes'])
                          ->where('slug', $slug)
                          ->firstOrFail();
        $products=product::with(['category', 'images', 'variants.size', 'variants.color','attributes'])
        ->where('category_id',$product->category_id)
        ->where('id','!=',$product->id)->latest()->take(10)->get();
        return view('Home.shop_single', compact('product','products','favorites'));
    }

    // برسی موجودی محصول
    public function checkVariant(Request $request)
    {
        $product=product::where('id',$request->product_id)->first();
        $price = $product->price;
        if ($product->discount > 0) {
        $price = $price * (1 - $product->discount / 100);
        }
        $variant = product_variants::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)
            ->where('stock', '>=', $request->quantity)
            ->first();
        if ($variant) {
            return response()->json([
                'available' =>true,
                'variant_id' => $variant->id,
                'price' => $price
            ]);
        }else{
            return response()->json([
                'available' =>false,

            ]);
        }

    }



    public function suggestions(Request $request){

    $query = $request->q;

    $results = Product::where('name', 'like', "%{$query}%")
        ->limit(5)
        ->get(['id', 'slug', 'name', 'price'])
        ->map(function ($product) {
            $image = DB::table('product_images')
                       ->where('product_id', $product->id)
                       ->orderBy('id')
                       ->value('image');
            return [
                'slug'  => $product->slug,
                'name'  => $product->name,
                'price' => $product->price,
                'image' => $image ?? 'default.jpg',
            ];
        });
    return response()->json($results);
    }
}


