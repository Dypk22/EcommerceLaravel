<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'AddToWishlist',
        'subscribeNewsletter',
        'blogLike',
        'blogComment',
        'set_coupon_add_money',
        'addMoneyFinalAmt',
        'admin/updateCategoryStatus',
        'admin/updateCatShowHomeStats',
        'admin/updateSubCatStats',
        'admin/updateProductStats',
        '/user/address/add/done',
        '/check-user-registered',
        '/user_login_process',
        '/registration_next',
        '/send_mobile_otp',
        '/verify_OTP',
        '/notifyme_submit',
        'send_otp',
        'setUserCookie',
        'send_reset_password_email',
        '/getPincode',
        '/updatePincode'
    ];
}
