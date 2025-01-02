<?php

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthuserController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    if (Auth::check()) {
        if (auth()->user()->role_id == '1') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role_id == '2') {
            return redirect()->route('users.dashboard');
        }
    }

    $data['products'] = Product::with('category')->where('products_status', '=', 'active')->orderBy('created_at', 'desc')->get();
    return view('guests.welcome', $data);
})->name('/');

Route::get('/category/{encryptedId}', function ($encryptedId) {
    try {
        $categoryId = Crypt::decrypt($encryptedId);
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        abort(404); // If decryption fails, return 404.
    }

    $data['products'] = Product::with('category')->where('category_id', $categoryId)
        ->where('products_status', '=', 'active')
        ->get();

    return view('guests.category.filter', $data);
})->name('category.filter');

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthuserController::class, 'logins'])->name('login');
    Route::post('login', [AuthuserController::class, 'login'])->name('login.post');

    Route::get('register', [AuthuserController::class, 'registers'])->name('register');
    Route::post('register', [AuthuserController::class, 'register'])->name('register.post');

    Route::get('forgot-password', [AuthuserController::class, 'forgot'])->name('forgot-password');
    Route::post('forgot-password', [AuthuserController::class, 'forgotpassword'])->name('forgot-password.post');

    Route::get('password-reset/{token}', [AuthuserController::class, 'resetpassword'])->name('password-reset');
    Route::post('change-password', [AuthuserController::class, 'passwordreset'])->name('change-password');

    Route::get('logout', function () {
        Auth::logout();
        return redirect()->route('/');
    })->name('logout');
});

// User routes
Route::group(['prefix' => 'users', 'middleware' => ['auth', 'role:2']], function () { // '2' is the role ID for users
    Route::get('dashboard', [AuthuserController::class, 'dashboard'])->name('users.dashboard');
    Route::get('profile/{id}', [AuthuserController::class, 'profile'])->name('profile');
    Route::get('edit/{id}', [AuthuserController::class, 'editprofile'])->name('edit.profile');
    Route::post('update/profile/{id}', [AuthuserController::class, 'updatepro'])->name('update.profile');
    Route::put('update/address/{id}', [AuthuserController::class, 'updateadd'])->name('update.address');
});

// Contact and About Us routes
Route::get('showall', [ContactController::class, 'showcontact'])->name('showall');
Route::get('contact', [ContactController::class, 'user'])->name('contact');
Route::get('aboutus', [AboutController::class, 'index1'])->name('aboutus');
Route::post('uscontact', [ContactController::class, 'usercontact'])->name('ucontact.store');
Route::get('blog',[BlogController::class,'users'])->name('blog');
Route::get('blog/{id}',[BlogController::class,'readblog'])->name('blog.read');
Route::post('blog/{id}/comment',[BlogController::class,'comment'])->name('blog.comment');
Route::post('blog/subscribe',[BlogController::class,'subscribe'])->name('blog.subscribe');
// Route::match(['get', 'post'],'blog/unsubscribe',[BlogController::class,'unsubscribe'])->name('blog.unsubscribe');
// ('blog/subscribe',[BlogController::class,'subscribe'])->name('blog.subscribe');
Route::get('blog/unsubscribe', function(){
    return "function works";
})->name('blog/unsubscribe');


// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:1']], function () { // '1' is the role ID for admins
    Route::get('dashboard', [AuthuserController::class, 'admindashboard'])->name('admin.dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('contacts', ContactController::class);
    Route::get('contact/request',[ContactController::class,'showcontact'])->name('contact/request');
    Route::resource('aboutus', AboutController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('get-subcategories/{id}', [CategoryController::class, 'get_subcategories'])->name('get-subcategories');
    Route::get('sub/category/index', [CategoryController::class, 'subindex'])->name('sub.category.index');
    Route::get('sub/category', [CategoryController::class, 'subcreate'])->name('sub.category.create');
    Route::post('sub/category', [CategoryController::class, 'substore'])->name('sub.category.store');
    Route::resource('products', ProductController::class);
    Route::resource('blogs',BlogController::class);
    Route::resource('alerts',AlertController::class);
});


// Route::match(['get', 'post'], 'botman/chat', 'App\Http\Controllers\BotManController@handle')->name('botman.chat');
Route::match(['get', 'post'], '/botman/chat', [BotManController::class, 'handle'])->name('botman.chat');

