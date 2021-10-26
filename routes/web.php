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
Route::get('/fetch-postages', 'OrdersController@postage')->name('postages');

// Route::get('/cart', 'ProductsController@addToCart')->name('add.cart');

// Route::post('/purchase', 'UsersController@purchaseTest')->name('purchase-test');
Route::post('/guest/purchase', 'GuestsController@purchase')->name('guest.purchase');
Route::post('/guest/add', 'GuestsController@create')->name('guest.addaddress');
// Route::post('/guest/add-otheraddress', 'GuestsController@otherAddress')->name('guest.add.otheraddress');
Route::post('/guest/order-confirmation', 'GuestsController@orderConfirm')->name('order.confirm');
Route::get('/email/message', 'HomeController@email');
Route::get('/email/notification', 'HomeController@notification');
Route::get('/check-coupon', 'CouponsController@checkIfCoupon')->name('member.check.ifcoupon');

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
    Route::get('/orders-guestshipment', 'OrdersController@guestShipmentList')->name('admin.guestshipment.orders');
    Route::get('/fetch-order/{id}', 'OrdersController@eachOrder')->name('admin.each.order');
    Route::get('/fetch-guestorder/{id}', 'OrdersController@eachGuestOrder')->name('admin.each.guestorder');
    Route::get('/fetch-orders', 'OrdersController@index')->name('admin.orders');
    Route::get('/fetch-guestorders', 'OrdersController@guestOrders')->name('admin.guest.orders');
    Route::get('/fetch-shipment/{id}', 'OrdersController@shipmentDetails')->name('admin.orders');
    Route::post('/schedule-shipment', 'OrdersController@scheduleShipment')->name('admin.schedule.shipment');
    Route::post('/update-shipment', 'OrdersController@updateShipment')->name('admin.update.shipment');
    Route::get('/fetch-statuses', 'OrdersController@statuses')->name('admin.statuses');
    Route::post('/update-status', 'OrdersController@updateStatus')->name('admin.update.status');
    Route::post('/input-actualdate', 'OrdersController@actualDate')->name('admin.actual.shipment');
    Route::post('/update-actualdate', 'OrdersController@updateActualDate')->name('admin.update.actualdate');
    Route::post('/update-delivereddate', 'OrdersController@updateDeliveredDate')->name('admin.update.delivereddate');
    Route::post('/input-delivereddate', 'OrdersController@deliveredDate')->name('admin.delivered.date');
    Route::post('/admin/input-userordernote', 'OrdersController@inputUserOrderNote')->name('admin.input.userordernote');
    Route::post('/admin/update-userordernote', 'OrdersController@updateUserOrderNote')->name('admin.update.userordernote');
    Route::post('/admin/input-guestordernote', 'OrdersController@inputGuestOrderNote')->name('admin.input.guestordernote');
    Route::post('/admin/update-guestordernote', 'OrdersController@updateGuestOrderNote')->name('admin.update.guestordernote');
    Route::get('/admin/fetch-categories', 'CategoriesController@fetchCategories')->name('admin.fetch.categories');
    Route::get('/admin/fetch-category/{id}', 'CategoriesController@fetchEachCategory')->name('admin.fetch.category');
    Route::get('/admin/fetch-products', 'ProductsController@fetchProducts')->name('admin.fetch.products');
    Route::get('/admin/fetch-product/{id}', 'ProductsController@fetchProduct')->name('admin.fetch.product');
    Route::post('/admin/edit-subtitle', 'CategoriesController@editSubtitle')->name('admin.edit.subtitle');
    Route::post('/admin/edit-details', 'CategoriesController@editDetails')->name('admin.edit.details');
    Route::post('/admin/edit-description', 'CategoriesController@editDescription')->name('admin.edit.description');
    Route::post('/admin/edit-season', 'CategoriesController@editSeason')->name('admin.edit.season');
    Route::post('/admin/edit-ingredients', 'CategoriesController@editIngredients')->name('admin.edit.ingredients');
    Route::post('/admin/edit-image', 'CategoriesController@editImage')->name('admin.edit.image');
    Route::post('/admin/update-inventory', 'ProductsController@updateInventory')->name('admin.update.inventory');
    Route::post('/admin/create-inventory', 'CategoriesController@store')->name('admin.category.create');
    Route::get('/admin/fetch-statuses', 'CategoriesController@fetchCategoryStatuses')->name('admin.category.statuses');
    Route::post('/admin/update-status', 'CategoriesController@updateCategoryStatus')->name('admin.category.status');
    Route::post('/admin/create-category', 'CategoriesController@store')->name('admin.create.category');
    Route::post('/admin/create-product', 'ProductsController@store')->name('admin.create.product');
    Route::post('/admin/update-productstatus', 'ProductsController@updateStatus')->name('admin.update.product.status');
    Route::get('/admin/create-receipt/{id}', 'OrdersController@createUserReceipt')->name('admin.create.userreceipt');
    Route::get('/admin/create-guestreceipt/{id}', 'OrdersController@createGuestReceipt')->name('admin.create.guestreceipt');
    Route::get('/admin/fetch-users', 'UsersController@fetchUsers')->name('admin.fetch.users');
    Route::post('/admin/create-coupon', 'CouponsController@createCoupon')->name('admin.create.coupon');
    Route::get('/admin/fetch-coupons', 'CouponsController@fetchCoupons')->name('admin.fetch.coupons');
    Route::get('/admin/fetch-coupon/{id}', 'CouponsController@fetchCoupon')->name('admin.fetch.coupon');
    Route::post('/admin/edit-couponname', 'CouponsController@editName')->name('admin.coupon.edit.name');
    Route::post('/admin/edit-coupontype', 'CouponsController@editType')->name('admin.coupon.edit.type');
    Route::post('/admin/edit-couponvalue', 'CouponsController@editValue')->name('admin.coupon.edit.value');
    Route::post('/admin/edit-couponpercentoff', 'CouponsController@editPercentOff')->name('admin.coupon.edit.percentoff');
    Route::post('/admin/edit-couponminimum', 'CouponsController@editMinimum')->name('admin.coupon.edit.minimum');
    Route::post('/admin/edit-couponndeadline', 'CouponsController@editDeadline')->name('admin.coupon.edit.deadline');
    Route::post('/admin/edit-couponstatus', 'CouponsController@editStatus')->name('admin.coupon.edit.status');
    
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
    Route::get('/member/fetch-postage/{id}', 'UsersController@postage')->name('postage');
    Route::get('/member/fetch-otherpostage/{id}', 'UsersController@otherPostage')->name('other.postage');
    Route::post('/purchase', 'UsersController@purchase')->name('purchase');
    Route::post('/member/order-confirmation', 'UsersController@orderConfirm')->name('order.confirm');
    Route::get('/member/fetch-order/{id}', 'OrdersController@fetchOrder')->name('order.details');
    Route::get('/member/fetch-shipment/{id}', 'OrdersController@fetchShipment')->name('order.shipment');
    Route::post('/member/update-name', 'UsersController@updateName')->name('member.update.name');
    Route::post('/member/update-email', 'UsersController@updateEmail')->name('member.update.email');
    Route::post('/member/update-password', 'UsersController@updatePassword')->name('member.update.password');
    Route::post('/member/delete-user', 'UsersController@deleteUser')->name('member.delete.user');
    Route::get('/member/create-receipt/{id}', 'OrdersController@createUserReceipt')->name('member.create.receipt');
    Route::post('/update-userid', 'OrdersController@updateUserId')->name('member.update.order.userid');
    Route::post('/member/coupon', 'CouponsController@checkCoupon')->name('member.check.coupon');
    Route::post('/member/store-coupon', 'CouponsController@storeCouponData')->name('member.store.coupon');
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






