<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Home\Favorite;
use App\Models\order;
use App\Models\orderItem;
use App\Models\Panel\Products\product_variants;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class analysisController extends Controller
{
    public function index()
    {
        // پرفروش ترین محصولات
    $topProducts = OrderItem::with('variant.product.images')
    ->get()
    ->groupBy(function ($item) {
        return $item->variant->product->id;
    })
    ->map(function ($items) {
        return (object)[
            'product_id' => $items->first()->variant->product->id,
            'product_name' => $items->first()->variant->product->name,
            'product_slug' => $items->first()->variant->product->slug,
            'product_image' => $items->first()->variant->product->images->first()->image,
            'total_sales' => $items->sum('quantity'),
        ];
    })
    ->sortByDesc('total_sales')
    ->take(10)
    ->values();
// پرفروش ترین دسته بندی ها
    $topCategories = OrderItem::with('variant.product.category')
    ->get()
    ->groupBy(function ($item) {
        return $item->variant->product->category->id;
    })
    ->map(function ($items) {
        return (object)[
            'category_id' => $items->first()->variant->product->category->id,
            'category_name' => $items->first()->variant->product->category->name,
            'category_image' => $items->first()->variant->product->category->first()->image,
            'total_sales' => $items->sum('quantity'),
        ];
    })
    ->sortByDesc('total_sales')
    ->take(10)
    ->values();
    // محبوب ترین رنگ ها
    $topColors = OrderItem::with('variant.color')
    ->get()
    ->groupBy(function ($item) {
        return $item->variant->color->id;
    })
    ->map(function ($items) {
        return (object)[
            'id' => $items->first()->variant->color->id,
            'name' => $items->first()->variant->color->name,
            'code' => $items->first()->variant->color->code,
            'total_sales' => $items->sum('quantity'),
        ];
    })
    ->sortByDesc('total_sales')
    ->take(15)
    ->values();
        // محبوب ترین سایز ها
    $topSizes = OrderItem::with('variant.size')
    ->get()
    ->groupBy(function ($item) {
        return $item->variant->color->id;
    })
    ->map(function ($items) {
        return (object)[
            'id' => $items->first()->variant->size->id,
            'name' => $items->first()->variant->size->name,
            'total_sales' => $items->sum('quantity'),
        ];
    })
    ->sortByDesc('total_sales')
    ->take(15)
    ->values();
    //محبوب ها در علاقه مندی
    $topFavorites = Favorite::select('product_id', DB::raw('count(*) as total'))
    ->groupBy('product_id')
    ->orderByDesc('total')
    ->with('product.images')
    ->take(10)
    ->get();
    //محبوب ها در سبد خرید
    $topCart = CartItem::select('product_variant_id', DB::raw('count(*) as total'))
    ->groupBy('product_variant_id')
    ->orderByDesc('total')
    ->with('variant.product.images')
    ->take(10)
    ->get();
     // محصولات ناموجود
     $unavailable=product_variants::with('product.images','color','size')->where('stock',0)->get();
    // درامد امروز
    $todayRevenue = orderItem::whereDate('created_at', today())
    ->sum(DB::raw('price * quantity'));

    // سفارش های امروز
    $todayOrders = Order::whereDate('created_at', today())
    ->where('status','paid')->count();
    // سفارش های این هفته
    $weekOrders = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
    ->where('status','paid')->count();
    // آیتم‌های های فروخته شده
    $soldItems = OrderItem::sum('quantity');
    // تعداد کاربران
    $users = User::where('role', 'user')->count();
    $stats = (object) [
        'users'       => $users,
        'todayOrders' => $todayOrders,
        'weekOrders'  => $weekOrders,
        'soldItems'   => $soldItems,
        'todayRevenue' => $todayRevenue,
        'topColors' => $topColors,
        'topSizes' => $topSizes,
        'topFavorites' => $topFavorites,
        'topCart' => $topCart,
        'unavailable' => $unavailable,

    ];
        return view('Panel.analysis.analysis',compact('topProducts','topCategories','stats'));
    }


public function getSalesChart(Request $request)
{
    $range = $request->query('range', 'daily');
    $labels = [];
    $data = [];
    $totalPrice=0;

    if ($range === 'daily') {
        $days = 7;
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $orders = orderItem::whereDate('updated_at', $date)->get();

            $sum = 0;
            foreach ($orders as $order) {
                $sum += $order->price * $order->quantity;
            }

            $labels[] = Jalalian::fromDateTime($date)->format('Y/m/d');
            $data[] = $sum;
            $totalPrice+=$sum;
        }
    } elseif ($range === 'weekly') {
        for ($i = 4; $i >= 0; $i--) {
            $start = now()->subWeeks($i)->startOfWeek();
            $end = now()->subWeeks($i)->endOfWeek();
            $orders = orderItem::whereBetween('updated_at', [$start, $end])->get();

            $sum = 0;
            foreach ($orders as $order) {
                $sum += $order->price * $order->quantity;
            }

            $labels[] = Jalalian::fromDateTime($start)->format('Y/m/d') . ' - ' . Jalalian::fromDateTime($end)->format('Y/m/d');
            $data[] = $sum;
            $totalPrice+=$sum;
        }
    } elseif ($range === 'monthly') {
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $orders = orderItem::whereYear('updated_at', $month->year)
                ->whereMonth('updated_at', $month->month)->get();

            $sum = 0;
            foreach ($orders as $order) {
                $sum += $order->price * $order->quantity;
            }

            $labels[] = Jalalian::fromDateTime($month)->format('Y/m');
            $data[] = $sum;
            $totalPrice+=$sum;
        }
    }

    return response()->json([
        'labels' => $labels,
        'data' => $data,
        'totalPrice' => $totalPrice
    ]);
}



}
