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

////아래는 비디오(www.youtube.com/watch?v=wLkA1g2s65U)를 보고 로그아웃 후 다시 백하면 전 화면이 나타는
////문제를 해결 했음. "Route::group(['middleware' => 'revalidate']"안에 모든 route를 설치. 26/03/2019
////php artisan make:middleware RevalidateBackHistory
////open App\Http\Middleware/RevalidateBackHistory.php
////handle function을 수정.26/03/2019

Route::group(['middleware' => 'revalidate'], function()
{
    ////All Auth
    //Auth::routes();

    Auth::routes(['verify' => true]);  //php artisan make:auth 한 후 자동으로 이곳에 생김
                                       //괄호안['verify' => true]은 email verification을 위하여 삽입.01/04/2019

    Route::get('profile', function () {    //이 route 역시 email verification test를 위하여 삽입.01/04/2019
        // Only verified users may enter...//현재는 register 후에 곧바로 이 url로 오도록 RegisterController에 코딩
        return "This is profile";          //되어 있다.차후에 바꿀 예정...
    })->middleware('verified');

    ////아래는 real server에서 artisan command를 run 하는 예제.
    ////working 하는지는 아직 check 못 했음. 14/04/2019
    //Clear configurations:
    Route::get('/config-clear', function() {
        $status = Artisan::call('config:clear');
        return '<h1>Configurations cleared</h1>';
    });

    //Clear cache:
    Route::get('/cache-clear', function() {
        $status = Artisan::call('cache:clear');
        return '<h1>Cache cleared</h1>';
    });

    //Clear configuration cache:
    Route::get('/config-cache', function() {
        $status = Artisan::call('config:Cache');
        return '<h1>Configurations cache cleared</h1>';
    });

    Route::get('/route-list', function() {
        $status = Artisan::call('route:list');
        return '<h1>Route list:</h1>' + $status;
    });

    Route::get('/queue-work', function() {
        $status = Artisan::call('queue:work --tries=4');
        return '<h1>Queue work</h1>' + $status;
    });


    ////Auth
    ////loginByAjax ==> "Auth" 우측 back slash("\")를 주의 할 것.......
    Route::post('/login/loginAjax', 'Auth\LoginController@loginAjax')->middleware('guest');
    //logoutLogin ==> logout 후에 돌아갈 페이지  ==> "Auth" 우측 back slash("\")를 주의 할 것.......
    Route::get('/Auth/logoutLogin/index', 'Auth\LogoutLoginController@index')->middleware('guest');
    ////Email Vreification위하여 추가.13/03/2019==>임시 test용으로 쓰기위해.현재는 사용 중지. 15/03/2019
    Route::get('/verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
    ////Email Vreification위하여 추가.13/03/2019
    Route::get('/verify/{eamil}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

    ////Admin
    Route::get('/admin','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/admin','Admin\LoginController@login');
    Route::post('/admin/logout','Admin\LoginController@logout');
    Route::get('/admin/home','AdminController@index');
    Route::get('/admin/editor','EditorController@index'); //사용 중지 23/03/2019
    Route::get('/admin/seller','SellerController@index'); //사용 중지 23/03/2019
    Route::get('/admin/test','EditorController@test'); //사용 중지 23/03/2019
    Route::post('/admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/admin-password/reset','Admin\ResetPasswordController@reset');
    Route::get('/admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::get('/admin/register','Admin\RegisterController@showRegistrationForm');
    Route::post('/admin/register','Admin\RegisterController@register');

    ////Editor
    Route::get('/editor','Admin\LoginController@showLoginFormForEditor');
    Route::get('/editor/register','Admin\RegisterController@showRegistrationFormForEditor');
    Route::get('/editor-password/reset','Admin\ForgotPasswordController@showLinkRequestFormForEditor')->name('editor.password.request');
    Route::get('/editor/index','EditorController@index');
    Route::post('/editor/logout','Admin\LoginController@logout');

    ////Seller
    Route::get('seller','Admin\LoginController@showLoginFormForSeller');
    Route::get('/seller/index','SellerController@index');
    Route::post('seller/logout','Admin\LoginController@logout');
    Route::get('/seller/register','Admin\RegisterController@showRegistrationFormForSeller');
    Route::get('/seller-password/reset','Admin\ForgotPasswordController@showLinkRequestFormForSeller')->name('seller.password.request');
    //Route::get('/seller/inputProduct', 'SellerController@inputProduct'); //사용 중지 07/04/2019
    Route::get('/seller/inputProductWithProgressBar', 'SellerController@inputProductWithProgressBar');
    Route::get('/seller/inputProductWithCdn', 'SellerController@inputProductWithCdn');
    Route::post('/seller/selectCategoryB', 'SellerController@selectCategoryB');
    Route::post('/seller/selectCategoryC', 'SellerController@selectCategoryC');
    Route::post('/seller/selectCategoryD', 'SellerController@selectCategoryD');
    Route::post('/seller/insertProduct', 'SellerController@insertProduct');
    Route::post('/seller/updateProduct', 'SellerController@updateProduct');
    Route::post('/seller/upload', 'SellerController@upload');
    Route::get('/seller/myProduct', 'SellerController@showMyProduct');
    Route::get('/seller/modifyProduct/{id}', 'SellerController@modifyProduct');
    Route::post('/seller/modifyProduct', 'SellerController@modifyProduct');
    Route::get('/seller/countPicture', 'SellerController@countPicture');
    Route::post('/seller/deletePicture', 'SellerController@deletePicture');
    Route::get('/seller/currentPicture', 'SellerController@currentPicture');
    ////Route::get('/seller/optionOneCreate/{productId}', 'SellerController@optionOneCreate');
    Route::get('/seller/optionOneCreate/', 'SellerController@optionOneCreate');
    Route::get('/seller/optionTwoCreate/', 'SellerController@optionTwoCreate');
    Route::get('/seller/optionOneCreateForOptionTwo/', 'SellerController@optionOneCreateForOptionTwo');
    Route::post('/seller/optionOneStore', 'SellerController@optionOneStore');
    Route::post('/seller/optionTwoStore', 'SellerController@optionTwoStore');
    Route::get('/seller/optionOneShow/{productId}/{modelName}/{optionCode}', 'SellerController@optionOneShow')
        ->where('modelName','(.*)'); //파라미터에 슬래쉬(/)가 포함되어 있을 때.
    //Route::get('/seller/optionOneShowForOptionTwo/{productId}/{modelName}', 'SellerController@optionOneShowForOptionTwo')
    //    ->where('modelName','(.*)'); //파라미터에 슬래쉬(/)가 포함되어 있을 때.//stopped 19/05/2019
    Route::get('/seller/optionOneShowForOptionTwo', 'SellerController@optionOneShowForOptionTwo');
    Route::post('/seller/deleteOptionOne', 'SellerController@deleteOptionOne');
    Route::post('/seller/deleteOptionTwo', 'SellerController@deleteOptionTwo');

    ////Manager
    Route::get('/manager/categoryCrud', 'ManagerController@categoryCrud');
    Route::get('/manager/selectCategoryBCD', 'ManagerController@selectCategoryBCD');
    Route::get('/manager/selectCategoryACD', 'ManagerController@selectCategoryACD');
    Route::get('/manager/selectCategoryABD', 'ManagerController@selectCategoryABD');
    Route::get('/manager/selectCategoryABC', 'ManagerController@selectCategoryABC');
    Route::post('/manager/updateCategoryA', 'ManagerController@updateCategoryA');
    Route::post('/manager/deleteCategoryA', 'ManagerController@deleteCategoryA');
    Route::post('/manager/insertCategoryA', 'ManagerController@insertCategoryA');
    Route::post('/manager/updateCategoryB', 'ManagerController@updateCategoryB');
    Route::post('/manager/deleteCategoryB', 'ManagerController@deleteCategoryB');
    Route::post('/manager/insertCategoryB', 'ManagerController@insertCategoryB');
    Route::post('/manager/updateCategoryC', 'ManagerController@updateCategoryC');
    Route::post('/manager/deleteCategoryC', 'ManagerController@deleteCategoryC');
    Route::post('/manager/insertCategoryC', 'ManagerController@insertCategoryC');
    Route::post('/manager/updateCategoryD', 'ManagerController@updateCategoryD');
    Route::post('/manager/deleteCategoryD', 'ManagerController@deleteCategoryD');
    Route::post('/manager/insertCategoryD', 'ManagerController@insertCategoryD');

    ////Home
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');  //php artisan make:auth 한 후 자동으로 이곳에 생김
    Route::get('/home/index', 'HomeController@index');
    Route::post('/home/countInCart', 'HomeController@countInCart');
    Route::get('/home/search', 'HomeController@search');
    Route::get('/home/selectedProducts', 'HomeController@selectedProducts');
    Route::get('/home/searchMulti', 'HomeController@searchMulti');
    Route::get('/home/searchOne', 'HomeController@searchOne');
    Route::get('/home/searchTwo', 'HomeController@searchTwo');
    Route::get('/home/searchThree', 'HomeController@searchThree');
    //Route::get('/home/searchByCategoryBId', 'HomeController@searchByCategoryBId');
    Route::get('/home/categoryAmenu', 'HomeController@categoryAmenu');
    Route::get('/home/searchByCategoryBId/{bId}/{bName}/{searchTerm}', 'HomeController@searchByCategoryBId');
    Route::post('/home/deletCookieProduct', 'HomeController@deletCookieProduct');

    ////Product
    Route::get('/product/details/{id}', 'ProductController@details');
    Route::get('/product/detailsWithCdn/{id}', 'ProductController@detailsWithCdn');
    Route::get('/product/categoryBmenu/{id}/{id2}/{nameB}', 'ProductController@categoryBmenu')
        ->where('nameB','(.*)'); //파라미터에 슬래쉬(/)가 포함되어 있을 때.
    Route::get('/product/categoryCmenu/{id}/{id2}/{id3}/{nameB}/{nameC}', 'ProductController@categoryCmenu')
        ->where('nameB','(.*)')  //파라미터에 슬래쉬(/)가 포함되어 있을 때.
        ->where('nameC','(.*)'); //파라미터에 슬래쉬(/)가 포함되어 있을 때.
    Route::get('/product/categoryCAll', 'ProductController@categoryCAll');
    Route::get('/product/categoryDmenu/{id}/{id2}/{id3}/{id4}/{nameB}/{nameC}/{nameD}', 'ProductController@categoryDmenu')
        ->where('nameB','(.*)')  //파라미터에 슬래쉬(/)가 포함되어 있을 때.
        ->where('nameC','(.*)') //파라미터에 슬래쉬(/)가 포함되어 있을 때.
        ->where('nameD','(.*)'); //파라미터에 슬래쉬(/)가 포함되어 있을 때.
        //->where('nameD', '[A-Za-z0-9_/-]+');
        //->where('nameB','(.*(?:%2F:)?.*)')  //파라미터에 슬래쉬(/)가 포함되어 있을 때.
        //->where('nameC','(.*(?:%2F:)?.*)') //파라미터에 슬래쉬(/)가 포함되어 있을 때.
        //->where('nameD','(.*(?:%2F:)?.*)'); //파라미터에 슬래쉬(/)가 포함되어 있을 때.
    Route::get('/product/categoryDAll', 'ProductController@categoryDAll');
    Route::get('/product/ownersPopularProducts', 'ProductController@ownersPopularProducts');

    ////Order
    Route::get('/order/showOrderTotal', 'OrderController@showOrderTotal')->middleware('auth');
    Route::get('/order/showOrderTotalByTerm', 'OrderController@showOrderTotalByTerm')->middleware('auth');
    Route::get('/order/showOrderDetailsByChild', 'OrderController@showOrderDetailsByChild')->middleware('auth');
    Route::get('/order/showCurrentOrder/{id}', 'OrderController@showCurrentOrder')->middleware('auth');
    Route::get('/order/orderPaymentForWebGrid', 'OrderController@orderPaymentForWebGrid')->middleware('auth');
    Route::get('/order/orderPaymentForWebGridWithCdn', 'OrderController@orderPaymentForWebGridWithCdn')->middleware('auth');
    Route::post('/order/checkOut', 'OrderController@checkOut')->middleware('auth'); //stopped.12/05/2019
    Route::post('/order/checkOutWithCdn', 'OrderController@checkOutWithCdn')->middleware('auth');
    Route::post('/order/buyNow', 'OrderController@buyNow')->middleware('auth');

    ////Shoppingcart
    Route::post('/shoppingcart/addToCartByMultiItems', 'ShoppingcartController@addToCartByMultiItems');
    Route::get('/shoppingcart/cartList', 'ShoppingcartController@cartList');
    Route::get('/shoppingcart/cartListWithCdn', 'ShoppingcartController@cartListWithCdn');
    Route::get('/shoppingcart/cartListWithCdnOld', 'ShoppingcartController@cartListWithCdn');//for test.04/05/2019
    Route::post('/shoppingcart/changeToCart', 'ShoppingcartController@changeToCart');
    Route::post('/shoppingcart/deleteSelected', 'ShoppingcartController@deleteSelected');
    Route::post('/shoppingcart/addToCart', 'ShoppingcartController@addToCart');
    //Route::get('/shoppingcart/cartMigrate', 'ShoppingcartController@cartMigrate');
    Route::post('/shoppingcart/buyNowWithoutLogin', 'ShoppingcartController@buyNowWithoutLogin');

    ////Qaboard
    Route::get('/qaboard/create', 'QaboardController@create')->middleware('auth');
    Route::post('/qaboard/store', 'QaboardController@store')->middleware('auth');
    Route::get('/qaboard/index', 'QaboardController@index');
    Route::get('/qaboard/show/{id}', 'QaboardController@show');
    Route::get('/qaboard/showSearch/{id}/{qaSearchTerm}', 'QaboardController@showSearch');
    Route::get('/qaboard/reply/{id}', 'QaboardController@reply')->middleware('auth');
    Route::post('/qaboard/addReply', 'QaboardController@addReply')->middleware('auth');
    Route::get('/qaboard/search/{qaSearchTerm}', 'QaboardController@search');

    ////CustomerCenter
    Route::get('/customercenter/index', 'CustomercenterController@index');
    Route::get('/customercenter/indexAjax', 'CustomercenterController@indexAjax');
    Route::get('/customercenter/detailsAjax', 'CustomercenterController@detailsAjax');
    Route::get('/customercenter/forgotpassword', 'CustomercenterController@forgotpassword');

});