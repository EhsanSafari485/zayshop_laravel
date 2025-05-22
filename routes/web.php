<?php

use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\blog\blogController;
use App\Http\Controllers\cart\cartController;
use App\Http\Controllers\favorite\favoriteController;
use App\Http\Controllers\Home\homeController;
use App\Http\Controllers\Panel\accountController;
use App\Http\Controllers\Panel\analysisController;
use App\Http\Controllers\Panel\blogController as PanelBlogController;
use App\Http\Controllers\Panel\blogPanelController;
use App\Http\Controllers\Panel\categoryController;
use App\Http\Controllers\Panel\orderController;
use App\Http\Controllers\Panel\panelController;
use App\Http\Controllers\Panel\product\attributeController;
use App\Http\Controllers\Panel\product\colorController;
use App\Http\Controllers\Panel\product\product_imageController;
use App\Http\Controllers\Panel\product\product_variantController;
use App\Http\Controllers\Panel\product\productController;
use App\Http\Controllers\Panel\product\sizeController;
use App\Http\Controllers\Panel\sliderController;
use App\Http\Controllers\Panel\userController;
use App\Http\Controllers\payment\paymentController;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// blog
Route::prefix('blogs')->group(function(){
Route::get('/', [blogController::class, 'index'])->name('blogs.index');
Route::get('/{slug}', [blogController::class, 'show'])->name('blogs.show');
});


// Home
Route::namespace('Home')->group(function(){
    Route::get('/', [homeController::class, 'index'])->name('Home.index');
    Route::get('shop',[homeController::class,'shop'])->name('Home.shop');
    Route::get('shop_single/{slug}',[homeController::class,'shop_single'])->name('Home.shop_single');
    Route::post('checkVariant',[homeController::class,'checkVariant'])->name('Home.checkVariant');

    Route::get('suggestions', [homeController::class, 'suggestions'])->name('Home.suggestions');


    Route::get('about',[homeController::class,'about'])->name('Home.about');
    // Route::get('contact',[homeController::class,'contact'])->name('Home.contact');
    // cart
Route::prefix('cart')->middleware('auth')->group(function(){
    Route::get('cart',[cartController::class,'cart'])->name('Home.cart.cart');
    Route::delete('cart/{id}', [cartController::class, 'destroy'])->name('Home.cart.destroy');
    Route::post('add-to-cart', [cartController::class, 'addToCart'])->name('Home.cart.addToCart');
    Route::get('total', [CartController::class, 'getTotal'])->name('Home.cart.total');
    });

// Favorite
Route::prefix('favorite')->middleware('auth')->group(function(){
    Route::get('favorite',[favoriteController::class,'index'])->name('Home.favorite.index');
    Route::post('toggle', [favoriteController::class, 'toggle'])->name('Home.favorite.toggle');
});
});

// ==============================================>
// pay
Route::post('/purchase/direct', [paymentController::class, 'directPurchase'])->name('purchase.direct');
Route::post('/callback', [paymentController::class, 'callback'])->name('payment.callback');
Route::post('/get-variant-id', [paymentController::class, 'getVariantId'])->name('Home.getVariantId');
Route::post('/checkout', [paymentController::class, 'checkout'])->name('checkout');
Route::get('/mark-failed-orders', [PaymentController::class, 'markFailedOrders']);
// ==============================================>

// auth
Route::get('register', [authController::class, 'showRegisterForm'])->name('registerForm');
Route::post('register', [authController::class, 'register'])->name('register');

Route::get('login', [authController::class, 'showLoginForm'])->name('loginForm');
Route::post('login', [authController::class, 'login'])->name('login');

Route::post('logout', [authController::class, 'logout'])->name('logout');

// ==============================================>
// Panel
Route::prefix('Panel')->middleware('auth')->group(function(){
    // Route::get('/',[categoryController::class,'index'])->name('Panel.index');
    Route::get('/',[analysisController::class,'index'])->name('Panel.index');
Route::prefix('analysis')->middleware('role:admin,master')->group(function(){
    Route::get('chart', [analysisController::class, 'getSalesChart'])->name('Panel.analysis.chart');
});

// blogs
    Route::prefix('blogs')->middleware('role:writer,master')->group(function(){
        Route::get('index', [blogPanelController::class,'index'])->name('Panel.blogs.index');
        Route::get('create', [blogPanelController::class,'create'])->name('Panel.blogs.create');
        Route::post('create', [blogPanelController::class,'store'])->name('Panel.blogs.store');
        Route::post('upload', [blogPanelController::class,'upload'])->name('Panel.blogs.upload');

});
// category
    Route::prefix('category')->middleware('role:admin,master')->group(function(){
        Route::get('index',[categoryController::class,'index'])->name('Panel.category.index');
        Route::delete('index',[categoryController::class,'destroy'])->name('Panel.category.destroy');

        Route::get('create',[categoryController::class,'create'])->name('Panel.category.create');
        Route::post('create',[categoryController::class,'store'])->name('Panel.category.store');

        Route::get('edit/{id}',[categoryController::class,'edit'])->name('Panel.category.edit');
        Route::post('edit/{id}',[categoryController::class,'update'])->name('Panel.category.update');
    });

// Sliders
    Route::prefix('Sliders')->middleware('role:admin,master')->group(function(){
        Route::get('index',[sliderController::class,'index'])->name('Panel.Sliders.index');
        Route::delete('index',[sliderController::class,'destroy'])->name('Panel.Sliders.destroy');

        Route::get('create',[sliderController::class,'create'])->name('Panel.Sliders.create');
        Route::post('create',[sliderController::class,'store'])->name('Panel.Sliders.store');

        Route::get('edit/{id}',[sliderController::class,'edit'])->name('Panel.Sliders.edit');
        Route::post('edit/{id}',[sliderController::class,'update'])->name('Panel.Sliders.update');
    });

    // users
    Route::prefix('users')->middleware('role:master')->group(function(){
        Route::get('index',[userController::class,'index'])->name('Panel.users.index');
        Route::delete('index/{id}',[userController::class,'destroy'])->name('Panel.users.destroy');

        Route::get('create',[userController::class,'create'])->name('Panel.users.create');
        Route::post('create',[userController::class,'store'])->name('Panel.users.store');

        Route::get('edit/{id}',[userController::class,'edit'])->name('Panel.users.edit');
        Route::post('edit/{id}',[userController::class,'update'])->name('Panel.users.update');
    });

    // account
    Route::prefix('account')->group(function(){
        Route::get('index',[accountController::class,'index'])->name('Panel.account.index');
        Route::get('edit/{id}',[accountController::class,'edit'])->name('Panel.account.edit');
        Route::post('edit/{id}',[accountController::class,'update'])->name('Panel.account.update');
    });

    // order
    Route::prefix('orders')->middleware('role:admin,master')->middleware('role:admin,master')->group(function(){
        Route::get('index',[orderController::class,'index'])->name('Panel.orders.index');
        Route::get('productOrder', [orderController::class, 'show'])->name('Panel.orders.productOrder');
        Route::post('{order}/update-status', [OrderController::class, 'updateStatus'])->name('Panel.orders.updateStatus');
    });


// product
    Route::prefix('product')->middleware('role:admin,master')->group(function(){
        Route::get('index',[productController::class,'index'])->name('Panel.product.index');
        Route::delete('index',[productController::class,'destroy'])->name('Panel.product.destroy');

        Route::get('create',[productController::class,'create'])->name('Panel.product.create');
        Route::post('create',[productController::class,'store'])->name('Panel.product.store');

        Route::get('edit/{id}',[productController::class,'edit'])->name('Panel.product.edit');
        Route::post('edit/{id}',[productController::class,'update'])->name('Panel.product.update');

        // product attribute
        Route::prefix('attribute')->group(function(){
            Route::get('index{id}',[attributeController::class,'index'])->name('Panel.product.attribute.index');
            Route::post('index{id}',[attributeController::class,'store'])->name('Panel.product.attribute.store');
            Route::delete('index/{id}',[attributeController::class,'destroy'])->name('Panel.product.attribute.destroy');
        });

        // product colors
        Route::prefix('colors')->group(function(){
            Route::get('index',[colorController::class,'index'])->name('Panel.product.colors.index');
            Route::post('index',[colorController::class,'store'])->name('Panel.product.colors.store');
            Route::delete('index/{id}',[colorController::class,'destroy'])->name('Panel.product.colors.destroy');
        });

        // product product_image
        Route::prefix('product_image')->group(function(){
            Route::get('index/{id}',[product_imageController::class,'index'])->name('Panel.product.product_image.index');
            Route::post('index/{id}',[product_imageController::class,'store'])->name('Panel.product.product_image.store');
            Route::delete('index/{id}',[product_imageController::class,'destroy'])->name('Panel.product.product_image.destroy');
        });

        // product product_variants
        Route::prefix('product_variants')->group(function(){
            Route::get('index/{id}',[product_variantController::class,'index'])->name('Panel.product.product_variants.index');
            Route::post('index/{id}',[product_variantController::class,'store'])->name('Panel.product.product_variants.store');
            Route::delete('index/{id}',[product_variantController::class,'destroy'])->name('Panel.product.product_variants.destroy');
        });

        // product sizes
        Route::prefix('sizes')->group(function(){
            Route::get('index',[sizeController::class,'index'])->name('Panel.product.sizes.index');
            Route::post('index',[sizeController::class,'store'])->name('Panel.product.sizes.store');
            Route::delete('index/{id}',[sizeController::class,'destroy'])->name('Panel.product.sizes.destroy');
        });
    });
});
