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

//Route::get('/', function () {
//    return view('welcome');
//});
//front route
Route::group(['namespace' => 'Front'], function () {
Route::get('/','FrontController@index')->name('index');
Route::get('/details/{slug}','FrontController@details');
Route::get('download/{eposide}','FrontController@download');
Route::get('/cats/{category}','FrontController@listByCat')->name('cats');
Route::get('/cart/add/{id}','CartController@addCart');
Route::get('/cart','CartController@cart');
Route::get('/cart/delete/{id}','CartController@remove');
Route::get('/payment','CartController@zarinpal');
Route::get('/callback','CartController@callback')->name('zarinpal.callback');
Route::get('/teach','FrontController@teach')->name('teach');
Route::post('/request/teach/','FrontController@requestTeach')->name('request.teach');
 Route::get('/search','FrontController@search')->name('search');
 Route::post('/rates', 'FrontController@rate')->name('rates');
 Route::get('/about','FrontController@about')->name('about');
 Route::get('/faq','FrontController@faq')->name('faq');
 Route::get('/contact','FrontController@contactForm')->name('contact');
 Route::post('/contact/store','FrontController@contactStore')->name('contactStore');
});


//order routes
Route::get('order','OrderController@index')->name('order.show')->middleware('auth:web');
// Route::get('download/{id}','OrderController@download')->middleware('auth:web');
Route::get('show/{id}','OrderController@show')->name('show')->middleware('auth:web');
Route::get('order/delete/{order}','OrderController@delete')->name('order.delete');
//avatar routes
Route::group(['prefix' => 'avatar','middleware' => ['auth:web'] ], function () {
Route::get('/','AvatarController@show')->name('avatar.show');
Route::get('complete','AvatarController@create')->name('avatar.complete');
Route::post('complete/store','AvatarController@store')->name('avatar.complete.store');
Route::get('edit','AvatarController@edit')->name('avatar.edit');
Route::post('update','AvatarController@update')->name('avatar.update');
    });



Route::group(['namespace' => 'Admin','prefix' => 'admin','middleware' => ['auth:web'] ], function () {
//dashboard route
    Route::get('Dashboard','AdminController@index')->name('dashboard');
    Route::get('/delete/teach/{teach}','AdminController@deleteTeach')->name('admin.delete.teach');
    Route::post('/update/role/{user}','AdminController@updateRole')->name('admin.update.role');

    //categories routes
    Route::get('categories','CategoryController@index')->name('admin.category.index');
    Route::get('category/create','categoryController@create')->name('admin.category.create');
    Route::post('category/store','categoryController@store')->name('admin.category.store');
    Route::get('category/edit/{category}','categoryController@edit')->name('admin.category.edit');
    Route::post('category/update/{category}','categoryController@update')->name('admin.category.update');
    Route::get('category/delete/{category}','categoryController@delete')->name('admin.category.delete');
   //courses routes
    Route::get('courses','CourseController@index')->name('admin.course.index');
    Route::get('course/create','CourseController@create')->name('admin.course.create');
    Route::post('course/store','CourseController@store')->name('admin.course.store');
    Route::get('course/edit/{course}','CourseController@edit')->name('admin.course.edit');
    Route::post('course/update/{course}','CourseController@update')->name('admin.course.update');
    Route::get('course/delete/{course}','CourseController@delete')->name('admin.course.delete');
    Route::get('course/active/{course}','CourseController@active')->name('active.course');
    Route::get('course/inactive/{course}','CourseController@inactive')->name('inactive.course');
    Route::get('course/listEposide/{course}','CourseController@listEposide')->name('admin.listEposide');
    //eposides routes
    Route::get('eposides','EposideController@index')->name('admin.eposide.index');
    Route::get('eposide/create/{course}','EposideController@create')->name('admin.eposide.create');
    Route::post('eposide/store/{course}','EposideController@store')->name('admin.eposide.store');
    Route::get('eposide/edit/{eposide}','EposideController@edit')->name('admin.eposide.edit');
    Route::post('eposide/update/{eposide}','EposideController@update')->name('admin.eposide.update');
    Route::get('eposide/active/{eposide}','EposideController@active')->name('active.eposide');
    Route::get('eposide/inactive/{eposide}','EposideController@inactive')->name('inactive.eposide');
    Route::get('eposide/delete/{eposide}','EposideController@delete')->name('admin.eposide.delete');

    //coupons route
    Route::get('coupons','CouponController@index')->name('admin.coupon.index');
    Route::get('coupon/create','CouponController@create')->name('admin.coupon.create');
    Route::post('coupon/store','CouponController@store')->name('admin.coupon.store');
    Route::get('coupon/edit/{coupon}','CouponController@edit')->name('admin.coupon.edit');
    Route::post('coupon/update/{coupon}','CouponController@update')->name('admin.coupon.update');
    Route::get('coupon/delete/{coupon}','CouponController@delete')->name('admin.coupon.delete');
    //about route
    Route::get('about','AboutController@index')->name('admin.about.index');
    Route::get('about/create','AboutController@create')->name('admin.about.create');
    Route::post('about/store','AboutController@store')->name('admin.about.store');
    Route::get('about/edit/{about}','AboutController@edit')->name('admin.about.edit');
    Route::post('about/update/{about}','AboutController@update')->name('admin.about.update');
    Route::get('about/delete/{about}','AboutController@delete')->name('admin.about.delete');
    //faq route
    Route::get('faq','FaqController@index')->name('admin.faq.index');
    Route::get('faq/create','FaqController@create')->name('admin.faq.create');
    Route::post('faq/store','FaqController@store')->name('admin.faq.store');
    Route::get('faq/edit/{faq}','FaqController@edit')->name('admin.faq.edit');
    Route::post('faq/update/{faq}','FaqController@update')->name('admin.faq.update');
    Route::get('faq/delete/{faq}','FaqController@delete')->name('admin.faq.delete');
    //contact route
    Route::get('contact','AdminController@showContact')->name('admin.showContact');
    Route::get('contact/delete/{contact}','AdminController@deleteContact')->name('admin.contact.delete');
    //slider route
    Route::get('sliders','SliderController@index')->name('admin.slider.index');
    Route::get('slider/create','SliderController@create')->name('admin.slider.create');
    Route::post('slider/store','SliderController@store')->name('admin.slider.store');
    Route::get('slider/edit/{slider}','SliderController@edit')->name('admin.slider.edit');
    Route::post('slider/update/{slider}','SliderController@update')->name('admin.slider.update');
    Route::get('slider/delete/{slider}','SliderController@delete')->name('admin.slider.delete');
});







Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/home', 'HomeController@index')->name('home');
