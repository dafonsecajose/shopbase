<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');


Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('thanks', 'CheckoutController@thanks')->name('thanks');
    Route::post('notification', 'CheckoutController@notification')->name('notification');
});

Auth::routes();

Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('my-orders', 'UserOrderController@index')->name('orders');
    Route::resource('address', 'AddressUserController');
});


Route::group(['middleware' => ['auth', 'access.control.store.admin']], function () {


    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {

        Route::get('notifications', "NotificationController@notifications")->name('notifications.index');
        Route::get('notifications/read-all', "NotificationController@readAll")->name('notifications.read.all');
        Route::get('notifications/read/{notification}', "NotificationController@read")->name('notifications.read');

        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::get('orders/my', 'OrdersController@index')->name('orders.my');

        Route::post('photos/remove/{image}', "ProductPhotoController@removePhoto")->name('photo.remove');
    });
});

Route::get('mail', function () {

    $user = \App\User::find(1);
    $order = \App\OrderUser::where('user_id', 1)->first();


    $option = [
        'subject' => 'Pedido Registrado Com Sucesso!',
        'option' => 3,
        'order' => $order
    ];

    return new \App\Mail\OrderEmail($user, $option);
});

Route::post('shipping', 'ShippingController@shipping')->name('shipping');


