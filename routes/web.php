<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', 'HomeController@index')->name('home');

//adminログイン
Route::get('/admin/login', 'HomeController@adminLogin')->name('admin.login.form');
Route::post('/admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');
Route::post('/admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

//ユーザーログイン
Route::post('/login', 'Auth\LoginController@login')->name('member.login');
Route::post('/register', 'Auth\RegisterController@register')->name('member.register');
Route::post('/logout', 'LoginController@logout')->name('member.logout');

//ユーザーパスワードリセット
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//admin登録ページ
// Route::get('/admin/register', 'HomeController@adminRegister')->name('admin.register.form');

Route::get('/test', 'UsersController@test')->name('home');

Route::get('/fetch-user', 'UsersController@fetchUser')->name('user.fetch.user');
Route::get('/fetch-products', 'ProductsController@index')->name('products');
Route::get('/fetch-product/{id}', 'ProductsController@show')->name('product');
Route::get('/fetch-categories', 'CategoriesController@index')->name('categories');
Route::get('/ajax/zipcode/{val}', 'OrdersController@zipcode')->name('zipcode');
Route::get('/fetch-inventory/{id}', 'ProductsController@inventory')->name('inventory.quantity');

// Route::get('/cart', 'ProductsController@addToCart')->name('add.cart');

// Route::post('/purchase', 'UsersController@purchaseTest')->name('purchase-test');
Route::post('/guest/purchase', 'GuestsController@purchase')->name('guest.purchase');
Route::post('/guest/add', 'GuestsController@create')->name('guest.addaddress');
Route::post('/guest/add-otheraddress', 'GuestsController@otherAddress')->name('guest.add.otheraddress');
Route::post('/guest/order-confirmation', 'GuestsController@orderConfirm')->name('order.confirm');
Route::get('/email/message', 'HomeController@email');
Route::get('/email/notification', 'HomeController@notification');

//register by guest
// Route::post('/register', 'RegisterController@register')->name('register');


Auth::routes();

//admin
Route::group(['middleware' => ['auth:admin', 'can:super-admin']], function(){
    Route::post('/admin/register', 'Admin\Auth\RegisterController@register')->name('admin.register');
});

Route::group(['middleware' => ['auth:admin', 'can:admin']], function(){
    Route::get('/admin/user', 'AdminsController@index')->name('admin.user');
    Route::get('/orders-shipment', 'OrdersController@shipmentList')->name('admin.shipment.orders');
    Route::get('/fetch-order/{id}', 'OrdersController@eachOrder')->name('admin.each.order');
    Route::get('/fetch-orders', 'OrdersController@index')->name('admin.orders');
    Route::get('/fetch-shipment/{id}', 'OrdersController@shipmentDetails')->name('admin.orders');
    Route::post('/schedule-shipment', 'OrdersController@scheduleShipment')->name('admin.schedule.shipment');
    Route::post('/update-shipment', 'OrdersController@updateShipment')->name('admin.update.shipment');
    Route::get('/fetch-statuses', 'OrdersController@statuses')->name('admin.statuses');
    Route::post('/update-status', 'OrdersController@updateStatus')->name('admin.update.status');
    Route::get('/admin/fetch-categories', 'CategoriesController@fetchCategories')->name('admin.fetch.categories');
    Route::get('/admin/fetch-category/{id}', 'CategoriesController@fetchEachCategory')->name('admin.fetch.category');
    Route::get('/admin/fetch-products', 'ProductsController@fetchProducts')->name('admin.fetch.products');
    Route::get('/admin/fetch-product/{id}', 'ProductsController@fetchProduct')->name('admin.fetch.product');
    Route::post('/admin/edit-subtitle', 'CategoriesController@editSubtitle')->name('admin.edit.subtitle');
    Route::post('/admin/edit-details', 'CategoriesController@editDetails')->name('admin.edit.details');
    Route::post('/admin/edit-description', 'CategoriesController@editDescription')->name('admin.edit.description');
    Route::post('/admin/edit-season', 'CategoriesController@editSeason')->name('admin.edit.season');
    Route::post('/admin/edit-ingredients', 'CategoriesController@editIngredients')->name('admin.edit.ingredients');
    Route::post('/admin/update-inventory', 'ProductsController@updateInventory')->name('admin.update.inventory');
    Route::post('/admin/create-inventory', 'CategoriesController@store')->name('admin.category.create');
    Route::get('/admin/fetch-statuses', 'CategoriesController@fetchCategoryStatuses')->name('admin.category.statuses');
    Route::post('/admin/update-status', 'CategoriesController@updateCategoryStatus')->name('admin.category.status');
    Route::post('/admin/create-category', 'CategoriesController@store')->name('admin.create.category');
    Route::post('/admin/create-product', 'ProductsController@store')->name('admin.create.product');
    Route::post('/admin/update-productstatus', 'ProductsController@updateStatus')->name('admin.update.product.status');
});

//test
// Route::post('/test', 'usersController@test');

//only user
Route::group(['middleware' => ['auth', 'can:normal-user']], function(){
    Route::post('/add-address', 'UsersController@addAddress')->name('add.address');
    Route::post('/update-address', 'UsersController@updateAddress')->name('update.address');
    Route::post('/other-address', 'UsersController@otherAddress')->name('update.address');
    Route::get('/collect-address', 'UsersController@collectAddress')->name('update.address');
    Route::get('/select-address/{id}', 'UsersController@selectAddress')->name('select.address');
    Route::get('/order-summary', 'OrdersController@summary')->name('order.summary');
    Route::post('/remove-address', 'UsersController@removeAddress')->name('remove.address');
    Route::get('/fetch-postage', 'UsersController@postage')->name('postage');
    Route::post('/purchase', 'UsersController@purchase')->name('purchase');
    Route::post('/member/order-confirmation', 'UsersController@orderConfirm')->name('order.confirm');
    Route::get('/member/fetch-order/{id}', 'OrdersController@fetchOrder')->name('order.details');
    Route::get('/member/fetch-shipment/{id}', 'OrdersController@fetchShipment')->name('order.shipment');
});

Route::group(['middleware' => ['auth:admin', 'can:admin']], function(){
    Route::get('/admin/{any}', function () {
        return view('admin.main');
    })->where('any','.*');    
});

Route::group(['middleware' => ['auth', 'can:normal-user']], function(){
    Route::get('/member/{any}', function () {
        return view('main');
    })->where('any','.*');    
});

Route::get('/{any}',function(){
    return view ('main');
})->where('any','.*');





