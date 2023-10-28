<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\PaykunController;
use App\Http\Controllers\Admin\AdminController;

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


/*<============ admin routes start ===============>*/

Route::get('admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'],function(){
    Route::get('admin/dashboard',[AdminController::class,'dashboard']);

    Route::get('admin/category',[AdminController::class,'category']);
    Route::get('admin/category/manage-category',[AdminController::class,'manage_category']);
    Route::post('admin/updateCategoryStatus',[AdminController::class,'updateCategoryStatus']);
    Route::post('admin/updateCatShowHomeStats',[AdminController::class,'updateCatShowHomeStats']);
    Route::get('admin/category/manage-category/{slug}',[AdminController::class,'manage_category']);
    Route::post('admin/category/manage_category_process',[AdminController::class,'manage_category_process'])->name('category.manage_category_process');
    Route::get('admin/category/delete/{id}',[AdminController::class,'delete']);
    Route::get('admin/category/status/{status}/{id}',[AdminController::class,'status']);

    Route::get('admin/sub-category',[AdminController::class,'sub_category']);
    Route::get('admin/sub-category/manage-sub-category',[AdminController::class,'manage_sub_category']);
    Route::post('admin/updateSubCatStats',[AdminController::class,'updateSubCatStats']);
    Route::get('admin/sub-category/manage-sub-category/{slug}',[AdminController::class,'manage_sub_category']);
    Route::post('admin/sub-category/manage_sub_category_process',[AdminController::class,'manage_sub_category_process'])->name('category.manage_sub_category_process');
    Route::get('admin/sub-category/delete/{id}',[AdminController::class,'subcategory_delete']);


    Route::get('admin/coupon',[AdminController::class,'index']);
    Route::get('admin/coupon/manage_coupon',[AdminController::class,'manage_coupon']);
    Route::get('admin/coupon/manage_coupon/{id}',[AdminController::class,'manage_coupon']);
    Route::post('admin/coupon/manage_coupon_process',[AdminController::class,'manage_coupon_process'])->name('coupon.manage_coupon_process');
    Route::get('admin/coupon/delete/{id}',[AdminController::class,'delete']);
    Route::get('admin/coupon/status/{status}/{id}',[AdminController::class,'status']);

    Route::get('admin/products',[AdminController::class,'allProducts']);
    Route::post('admin/updateProductStats',[AdminController::class,'updateProductStats']);
    Route::get('admin/products/manage-products',[AdminController::class,'manage_product']);
    Route::get('admin/products/manage-products/{id}',[AdminController::class,'manage_product']);

    Route::post('admin/products/manage-products/manage_product_process',[AdminController::class,'manage_product_process'])->name('product.manage_product_process');
    Route::get('admin/products/delete/{id}',[AdminController::class,'Productdelete']);

    Route::get('admin/orders',[AdminController::class,'orders']);
    Route::get('admin/order-details/{id}',[AdminController::class,'order_detail']);
    Route::get('admin/user/order-detail/{id}',[AdminController::class,'order_user_detail']);

    Route::post('admin/order-details/update_OrderStats',[AdminController::class,'update_OrderStats'])->name('OrderStats.update_OrderStats');

    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error','Logout sucessfully');
        return redirect('admin');
    });
});

/*<============ admin routes end ===============>*/

Route::get('/',[FrontController::class,'index']);
Route::get('products/{slug}',[FrontController::class,'products']);
Route::post('add_to_cart',[FrontController::class,'add_to_cart']);
Route::get('featured-products',[FrontController::class,'featured']);
Route::get('featured-products/{sort}',[FrontController::class,'featured']);
Route::get('discounted-products',[FrontController::class,'discounted']);
Route::get('discounted-products/{sort}',[FrontController::class,'discounted']);
Route::get('about',[FrontController::class,'about']);
Route::get('latest-products',[FrontController::class,'latest']);
Route::get('latest-products/{sort}',[FrontController::class,'latest']);
Route::get('best-seller-products',[FrontController::class,'bestSeller']);
Route::get('best-seller-products/{sort}',[FrontController::class,'bestSeller']);
Route::post('AddToCartCarousel',[FrontController::class,'AddToCartCarousel']);

Route::get('login',[FrontController::class,'signin']);
Route::get('register',[FrontController::class,'register']);
Route::post('registration_process',[FrontController::class,'registration_process'])->name('registration.registration_process');
Route::get('login/verification/{id}',[FrontController::class,'email_verification']);
Route::post('login_process',[FrontController::class,'login_process'])->name('registration.login_process');
Route::get('/user/logout', function () {
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_ID');
    session()->forget('FRONT_USER_NAME');
    // session()->forget('USER_TEMP_ID');
    return redirect('/');
});

Route::get('/order-daily',[FrontController::class,'order_daily']);
Route::get('/checkout',[FrontController::class,'checkout']);
Route::get('/career',[FrontController::class,'career']);
Route::get('/offers',[FrontController::class,'offers']);
Route::get('/faq',[FrontController::class,'faq']);
Route::get('/press',[FrontController::class,'press']);
Route::get('/privacy-policy',[FrontController::class,'privacy_policy']);
Route::get('/term-conditions',[FrontController::class,'term_and_conditions']);
Route::get('/refund-return-policy',[FrontController::class,'refund_and_return_policy']);
Route::get('/categories/{category_name}',[FrontController::class,'categories']);
// Route::get('/nosubCat',[FrontController::class,'noCat']);
Route::post('apply_coupon_code',[FrontController::class,'apply_coupon_code']);
Route::post('/set_coupon_add_money',[FrontController::class,'set_coupon_add_money']);
// Route::post('/addMoneyFinalAmt',[FrontController::class,'addMoneyFinalAmt']);
Route::post('remove_coupon_code',[FrontController::class,'remove_coupon_code']);
Route::post('cartAmount',[FrontController::class,'cartAmount']);
Route::post('/AddToWishlist',[FrontController::class,'AddToWishlist']);
Route::post('checkoutForm2',[FrontController::class,'checkoutForm2']);
Route::post('submit/contact-form',[FrontController::class,'contact_form'])->name('submit.contact_form');
Route::post('setUserCookie',[FrontController::class,'setUserCookie']);
Route::post('send_reset_password_email',[FrontController::class,'send_reset_password_email']);
Route::get('forgot-password/{token}',[FrontController::class,'forgot_password']);
Route::post('updateUserPassword',[FrontController::class,'updateUserPassword']);

Route::post('getPincode',[FrontController::class,'getPincode']);
Route::post('updatePincode',[FrontController::class,'updatePincode']);

Route::get('/pay',[PaykunController::class,'pay']);
Route::get('/AddMoney/{amount}',[PaykunController::class,'AddMoney']);
Route::get('/add-money-success',[PaykunController::class,'add_money_success']);
Route::get('/add-money-fail',[PaykunController::class,'add_money_fail']);

Route::post('/check-user-registered',[FrontController::class,'check__user']);
Route::post('/user_login_process',[FrontController::class,'user_login_process']);
Route::post('/registration_next',[FrontController::class,'registration_next']);
Route::post('/send_mobile_otp',[FrontController::class,'send_mobile_otp']);
Route::post('/send_otp',[FrontController::class,'send_otp']);
Route::post('/verify_OTP',[FrontController::class,'verify_OTP']);

Route::get('/payment-success',[PaykunController::class,'success'])->name('paykun.payment.success');
Route::get('/payment-fail',[PaykunController::class,'fail'])->name('paykun.payment.fail');
Route::get('/order-confirmation',[FrontController::class,'order_confirmation']);

Route::get('blogs',[FrontController::class,'blog']);
Route::get('/blogs/{slug}',[FrontController::class,'blogDetail']);
Route::get('/offers/{slug}',[FrontController::class,'offerDetail']);
Route::post('blogLike',[FrontController::class,'blogLike']);
Route::post('blogComment',[FrontController::class,'blogComment']);

Route::get('search/{str}',[FrontController::class,'search']);
Route::get('contact',[FrontController::class,'contact']);
Route::post('subscribeNewsletter',[FrontController::class,'subscribeNewsletter']);
Route::post('notifyme_submit',[FrontController::class,'notifyme_submit']);
    Route::get('/all-categories',[FrontController::class,'all_categories']);

Route::group(['middleware'=>'user_auth'], function(){
	Route::get('/user/dashboard',[FrontController::class,'dashboard']);
	Route::get('/user/orders',[FrontController::class,'my_orders']);
	Route::get('/user/rewards',[FrontController::class,'my_rewards']);
	Route::get('/user/wallet',[FrontController::class,'my_wallet']);
	Route::get('/user/wishlist',[FrontController::class,'my_wishlist']);
	Route::get('/user/address',[FrontController::class,'my_address']);
	Route::get('/user/address/{add}',[FrontController::class,'my_address']);
	Route::post('/user/address/add/done',[FrontController::class,'set_address']);
	Route::post('/user/address/{id}',[FrontController::class,'my_address']);
	Route::get('/user/address/update/{id}',[FrontController::class,'my_address']);
	Route::get('/user/address/delete/{id}',[FrontController::class,'my_address_delete']);
    Route::get('/user/order-detail/{id}',[FrontController::class,'order_detail']);
    Route::get('/user/order-review/{id}',[FrontController::class,'order_review']);
	Route::post('/order-review-submit/{id}',[FrontController::class,'order_review_submit'])->name('review.submit');

	Route::get('/user/wishlist/delete/{id}',[FrontController::class,'deleteWishlist']);
});