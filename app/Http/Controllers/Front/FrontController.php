<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Models\Admin\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use Crypt;
use Illuminate\Support\Facades\Cookie;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['banner']=DB::table('banner')
        ->where(['status'=>1])
        ->inRandomOrder()
        ->limit(10)
        ->get();            
        // prx($result['banner']);
        $result['my_details']=DB::table('my_details')
        ->get();

        //show best_seller product on home page with products
        $result['best_seller']=DB::table('products')
        ->join('product_attributes','products.id','=','product_attributes.product_id')
        ->where(['product_attributes.best_seller'=>1])
        ->inRandomOrder()
        ->limit(15)
        ->get();

        //show featuered product on home page with products
        $result['featured']=DB::table('products')
        ->join('product_attributes','products.id','=','product_attributes.product_id')
        ->where(['product_attributes.featured'=>1])
        ->inRandomOrder()
        ->limit(15)
        ->get();        
        // prx($result['featured']);
        //show new product on home page with products
        $result['latest_products']=DB::table('products')
        ->join('product_attributes','products.id','=','product_attributes.product_id')
        ->orderBy('products.id','desc')
        ->limit(15)
        ->get();                

        //show discounted product on home page with products
        $result['discounted']=DB::table('products')
        ->join('product_attributes','products.id','=','product_attributes.product_id')
        ->where(['product_attributes.discounted'=>1])
        ->inRandomOrder()
        ->limit(15)
        ->get();     

        return view('front.index', $result);
    }

    public function products(Request $request, $slug)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();

        $result['product']=DB::table('products')
        ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
        ->where(['status'=>1])
        ->where(['slug'=>$slug])
        ->get();

        if(isset($result['product'][0])){
            $tmp_short_desc = explode('. ', $result['product'][0]->short_desc);
            $final_tmp_short_desc =[];
            foreach ($tmp_short_desc as $value) {
               $final_short_desc = ' '.strtoupper(substr($value, 0, 1)).substr($value, 1);
               $final_tmp_short_desc[] = str_replace('..', '.', $final_short_desc);
            }
            $result['final_shortdesc']=implode('.', $final_tmp_short_desc);

            $tmp_desc = explode('. ', $result['product'][0]->desc);
            $final_tmp_desc =[];
            foreach ($tmp_desc as $value) {
               $final_desc = ' '.strtoupper(substr($value, 0, 1)).substr($value, 1);
               $final_tmp_desc[] = str_replace('..', '.', $final_desc);
            }
            $result['final_desc']=implode('.', $final_tmp_desc);

            // die();
            $result['currentCategories']=DB::table('categories')
            ->where('id','=',$result['product'][0]->cat_id)
            ->select('categories.category_name','categories.category_slug')
            ->get();
            // prx($result['final_shortdesc']);        
            $totalQty=AvaliableQty($result['product'][0]->product_id);
            $SoldQty=SoldQty($result['product'][0]->product_id);
            $result['availableQty']=$totalQty-$SoldQty;
            // prx($result['availableQty']);
             $result['weight']=DB::table('products')
            ->join('product_attributes','products.id','=','product_attributes.product_id')
            ->where(['products.status'=>1])
            ->where('products.name', '=', $result['product'][0]->name)
            ->select('products.id', 'products.slug', 'product_attributes.weight')
            ->get();     
        }else{
            return redirect('errors/404');
        }
        // echo "<pre>";
        // print_r($result['weight']);
        // die();   

        //show featuered product on home page with products
        $result['featured']=DB::table('products')
        ->join('product_attributes','products.id','=','product_attributes.product_id')
        ->where(['product_attributes.featured'=>1])
        ->where('products.slug', '!=', $slug)
        ->inRandomOrder()
        ->limit(5)
        // ->select('products.*','product_attributes.*')
        ->get();

        //show best_seller product on home page with products
        $result['best_seller']=DB::table('products')
        ->join('product_attributes','products.id','=','product_attributes.product_id')
        ->where(['product_attributes.best_seller'=>1])
        ->where('products.slug', '!=', $slug)
        ->inRandomOrder()
        ->limit(15)
        ->get();

        $result['discounted']=DB::table('products')
        ->join('product_attributes','products.id','=','product_attributes.product_id')
        ->where(['product_attributes.discounted'=>1])
        ->where('products.slug', '!=', $slug)
        ->inRandomOrder()
        ->limit(10)
        ->get();

        return view('front.product', $result);

    }

    public function add_to_cart(Request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $user_type="registered";
        }else{
            // $uid=rand(11111,99999);
            $uid=getUserTempId();
            $user_type="unregistered";
            // die();
        }
        // echo session()->has('USER_TEMP_ID');
        $product_id=$request->post('product_id');
        $product_qty=$request->post('product_qty');
        $totalQty=AvaliableQty($product_id);
        $SoldQty=SoldQty($product_id);
        $availableQty=$totalQty-$SoldQty; 



        // prx($product_qty);
        // prx($totalQty);
        // prx($SoldQty);
        // prx($availableQty);
        if($availableQty>=$product_qty){
            $check=DB::table('carts')
            ->where(['user_id'=>$uid])
            ->where(['user_type'=>$user_type])
            ->where(['product_id'=>$product_id])
            ->get();

            if (isset($check[0])) {
                $update_id=$check[0]->id;
                if ($product_qty==0) {
                    DB::table('carts')
                    ->where(['id'=>$update_id])
                    // ->update(['qty'=>$product_qty]);
                    ->delete();
                    $msg='removed';
                }else{
                    DB::table('carts')
                    ->where(['id'=>$update_id])
                    ->update(['qty'=>$product_qty]);
                    $msg='updated';
                }

            }else{
                date_default_timezone_set("Asia/Kolkata");
                $added_on=date('Y-m-d H:i:s');
                $id=DB::table('carts')
                ->insertGetId([
                'user_id'=>$uid,
                'user_type'=>$user_type,
                'product_id'=>$product_id,
                'qty'=>$product_qty,
                'added_on'=>$added_on
                ]);
                $msg='added';
            }

            $result['cart_items']=DB::table('carts')
            ->leftJoin('products','products.id','=','carts.product_id')
            ->leftJoin('product_attributes','product_attributes.product_id','=','carts.product_id')
            ->where(['user_id'=>$uid])
            ->where(['user_type'=>$user_type])
            ->select('products.discount','carts.qty','products.name','product_attributes.image1','product_attributes.weight', 'product_attributes.mrp', 'product_attributes.price','products.slug','products.id as pid','product_attributes.id as attribute_id')
            ->get();

            return response()->json(['msg'=>$msg, 'cartdata'=>$result['cart_items'],'carttotalItem'=>count($result['cart_items'])]);
        }else{
            $result['cart_items']=DB::table('carts')
            ->leftJoin('products','products.id','=','carts.product_id')
            ->leftJoin('product_attributes','product_attributes.product_id','=','carts.product_id')
            ->where(['user_id'=>$uid])
            ->where(['user_type'=>$user_type])
            ->select('carts.qty','products.name','product_attributes.image1','product_attributes.weight', 'product_attributes.mrp', 'product_attributes.price','products.slug','products.id as pid','product_attributes.id as attribute_id')
            ->get();

            return response()->json(['msg'=>'qty_not_available', 'availableQty'=>$availableQty, 'cartdata'=>$result['cart_items'],'carttotalItem'=>count($result['cart_items'])]);

            // return response()->json(['msg'=>'qty_not_available', 'availableQty'=>$availableQty]);

        }
    }

    public function register()
    {
        return view('front.sign-up');
    }

   public function signin()
    {
        return view('front.signin');
    }

   public function checkout(Request $request)
    {
        $getAddToCartTotalItem=getAddToCartTotalItem();
        $totalPrice=0;
        foreach ($getAddToCartTotalItem as $totalprice) {
            $totalPrice=$totalPrice+($totalprice->qty*$totalprice->price);
        }
        $result['totalPrice']=$totalPrice;
        if (isset($getAddToCartTotalItem[0])) {         
            $result['categories']=DB::table('categories')
            ->where(['status'=>1])
            ->where(['show_home'=>1])
            ->inRandomOrder()
            ->limit(8)
            ->get();

            $result['my_details']=DB::table('my_details')
            ->get();     

            // $result['customer_info']=[];
            if ($request->session()->has('FRONT_USER_LOGIN')) {
                $uid=$request->session()->get('FRONT_USER_ID');
                $result['wallet_balance']=DB::table('users')
                ->where(['users.id'=>$uid])
                ->get();   
                    // prx($result['wallet_balance'][0]->wallet);
                $result['prevOrder']=DB::table('orders')
                ->where(['user_id'=>$uid])
                ->get();
                if(isset($result['prevOrder'][0])){
                $result['customer_info']=DB::table('users')
                ->join('user_addresses','user_addresses.user_id','=','users.id')
                ->where(['user_addresses.status'=>1])
                ->get();
                }   
                else{
                // $result['prevOrder']=[];
                $result['customer_short_info']=DB::table('users')
                ->where(['id'=>$uid])
                ->get();                    
                }
                // prx($result['customer_info']);

                // if (isset($result['customer_info'][0])) {
                    $result['reg_customer_email']=$request->session()->get('FRONT_USER_EMAIL');
                    $result['reg_customer_mobile']=$request->session()->get('FRONT_USER_NUMBER');
                // }
            }else{
                $result['prevOrder']=[];
                $result['reg_customer_email']='';
                $result['reg_customer_mobile']='';
            }
            // prx($result['prevOrder']);
            return view('front.checkout', $result);
        }else{
            return redirect('/');
        }
    } 

    public function order_daily(Request $request)
    {
        $getAddToCartTotalItem=getAddToCartTotalItem();
        $totalPrice=0;
        foreach ($getAddToCartTotalItem as $totalprice) {
            $totalPrice=$totalPrice+($totalprice->qty*$totalprice->price);
        }
        $result['totalPrice']=$totalPrice;
        if (isset($getAddToCartTotalItem[0])) {         
            $result['categories']=DB::table('categories')
            ->where(['status'=>1])
            ->where(['show_home'=>1])
            ->inRandomOrder()
            ->limit(8)
            ->get();

            $result['my_details']=DB::table('my_details')
            ->get();     

            if ($request->session()->has('FRONT_USER_LOGIN')) {
                $uid=$request->session()->get('FRONT_USER_ID');
                $result['wallet_balance']=DB::table('users')
                ->where(['users.id'=>$uid])
                ->get();   
                    // prx($result['wallet_balance'][0]->wallet);
                $result['prevOrder']=DB::table('orders')
                ->where(['user_id'=>$uid])
                ->get();
                if(isset($result['prevOrder'][0])){
                $result['customer_info']=DB::table('users')
                ->join('user_addresses','user_addresses.user_id','=','users.id')
                ->where(['user_addresses.status'=>1])
                ->get();
                }   
                else{
                // $result['prevOrder']=[];
                $result['customer_short_info']=DB::table('users')
                ->where(['id'=>$uid])
                ->get();                    
                }
                // prx($result['customer_info']);

                // if (isset($result['customer_info'][0])) {
                    $result['reg_customer_email']=$request->session()->get('FRONT_USER_EMAIL');
                    $result['reg_customer_mobile']=$request->session()->get('FRONT_USER_NUMBER');
                // }
            }else{
                $result['prevOrder']=[];
                $result['reg_customer_email']='';
                $result['reg_customer_mobile']='';
            }
            return view('front.order_daily', $result);
        }else{
            return redirect('/');
        }
    }

    public function registration_process(Request $request)
    {
        // prx($_POST);
        $valid=Validator::make($request->all(),[
            "name" => 'required',
            "email" => 'required|email|unique:users,email',
            "number" => 'required|numeric|unique:users,mobile|digits:10',
            "password" => 'required',
        ]);

        if (!$valid->passes()) {
            return response()->json(['status'=>'error', 'error' => $valid->errors()->toArray()]);
        }else{
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');
            $uname=$request->name;
            $refer_code=$uname[0].rand(1111,9999);
            $unameArray=explode(' ', $uname);
            $rand_id=rand(111111111,999999999);
            $arr=[
                "name" => Str::of($request->name)->lower(),
                "email" => Str::of($request->email)->lower(),
                "mobile" => $request->number,
                "password" => Crypt::encrypt($request->password),
                "wallet" => 0,
                "membership" => "inactive",
                "email_status" => "unverified",
                "mobile_status" => "unverified",
                "token" => $rand_id,
                "refer_code"=>$refer_code,
                "status" => 0,
                "added_on" => $added_on
            ];

            $insert=DB::table('users')->insertGetId($arr);
            if ($insert) {
                DB::table('wallet')
                ->insert([
                'user_name'=>Str::of($request->name)->lower(),
                'user_id'=>$insert,
                'amount'=>0,
                'payment_id'=>'sign-up',
                'status'=>'success',
                'updated_balance'=>0,
                'cashback'=>0,
                'updated_cashback'=>0,
                'coupon_id'=>'',
                'coupon_code'=>'',
                'added_on'=>$added_on,
                ]); 
                $data=['name'=>$request->name,'rand_id'=>$rand_id];
                $user['to']=$request->email;
                // Mail::send('front/email_verification',$data,function($messages) use ($user){
                //     $messages->to($user['to']);
                //     $messages->subject('Email Id Verification');
                // });
                return response()->json(['status'=> 'success', 'msg'=>'Account Created! Check Email-Id for Verification']);
            }
        }

    }

    public function email_verification(Request $request,$id)
    {
        $result=DB::table('users')  
            ->where(['token'=>$id])
            ->where(['status'=>0])
            ->get(); 

        if(isset($result[0])){
            DB::table('users')  
            ->where(['id'=>$result[0]->id])
            ->update(['status'=>1,'email_status'=>'verified']);
            // return redirect('/');
            $request->session()->flash('msg', 'Account Verified successful. Please Sign in to continue...');
            return view('front.signin');
        }else{
            return redirect('/login');
            // return redirect('/');
        }
    }    

    public function check__user(Request $request)
    {
        $result['check_user_login']=DB::table('users')
        ->where('mobile', '=', $request->mobile)
        ->where('status', '=', 1)
        ->get();
        echo count($result['check_user_login']);
    }

    public function user_login_process(Request $request)
    {
        $result['check_user']=DB::table('users')
        ->where(['mobile' => $request->mobile])
        ->get();

        $db_password=Crypt::decrypt($result['check_user'][0]->password);
        if ($db_password==$request->Password) {
            // if($request->rememberme===null){
            //     setcookie('login_email',$request->login_email,100);
            //     setcookie('login_pwd',$request->login_password,100);
            // }else{
            //    setcookie('login_email',$request->login_email,time()+60*60*24*365);
            //    setcookie('login_pwd',$request->login_password,time()+60*60*24*365);
            // }
            $request->session()->put('FRONT_USER_LOGIN', true);
            $request->session()->put('FRONT_USER_ID', $result['check_user'][0]->id);
            $request->session()->put('FRONT_USER_NUMBER', $result['check_user'][0]->mobile);
            $request->session()->put('FRONT_USER_EMAIL', $result['check_user'][0]->email);
            $uname=$result['check_user'][0]->name;
            $unameArray=explode(' ', $uname);
            // prx($unameArray[0]);
            $request->session()->put('FRONT_USER_NAME', $unameArray[0]);
            $status="success";
            $msg="signed in";
            $getUserTempId=getUserTempId();
            DB::table('carts')  
            ->where(['user_id'=>$getUserTempId,'user_type'=>'unregistered'])
            ->update(['user_id'=>$result['check_user'][0]->id,'user_type'=>'registered']);
            DB::table('wishlist')  
            ->where(['user_id'=>$getUserTempId])
            ->update(['user_id'=>$result['check_user'][0]->id]);
        }else{
            $status="error";
            $msg="Password Incorrect";
        }
        return response()->json(['status'=> $status, 'msg'=>$msg]);
    }

    public function registration_next(Request $request)
    {
        if (!isset($request->refer_code)) {
            $refer_by='not-entered';
            $referCBAmount=0;
        }
        else{
            $refer_by=$request->refer_code;
        }
        $verifyEmail=$check_user_email=valid_email($request->email);
        if ($verifyEmail=='not valid' || $verifyEmail=='invalid email') {
            echo "invalid email";
        }else{
            $verifyEmail=$check_user_email=valid_email($request->email);
            if ($verifyEmail=='not valid' || $verifyEmail=='invalid email') {
                echo "invalid email";
            }else{
                 $result['check_user']=DB::table('users')
                ->where(['email' => $request->email])
                ->get();
                // prx($result['check_user'][0]);
                 if(isset($result['check_user'][0])){
                    echo "email registered";
                 }else{
                    date_default_timezone_set("Asia/Kolkata");
                    $added_on=date('Y-m-d H:i:s');

                    $uname=$request->name;
                    $unameArray=explode(' ', $uname);
                    $refer_code=$unameArray[0].rand(1,9).'g'.rand(111,999).'k'.rand(11,99).'s';
                    $rand_id=rand(111111111,999999999);
                    $arr=[
                        "name" => Str::of($request->name)->lower(),
                        "email" => Str::of($request->email)->lower(),
                        "mobile" => $request->number,
                        "password" => Crypt::encrypt($request->password),
                        "wallet" => 0,
                        "membership" => "inactive",
                        "email_status" => "unverified",
                        "mobile_status" => "verified",
                        "token" => $rand_id,
                        "refer_code"=>$refer_code,
                        "refered_by"=>$refer_by,
                        "status" => 1,
                        "added_on" => $added_on
                    ];

                    $insert=DB::table('users')->insertGetId($arr);
                    $sms_msg='Dear '.$request->name.', thank you for registering with Grockart. Order all grocceries & get delivered as per selected scheduled. Know More https://grockart.in';
                    send_mobile_sms($sms_msg, $request->number); 
                    DB::table('wallet')
                    ->insert([
                    'type'=>'sign-up',
                    'user_id'=>$insert,
                    'amount'=>0,
                    'payment_id'=>'sign-up',
                    'status'=>'success',
                    'updated_balance'=>0,
                    'cashback'=>0,
                    'updated_cashback'=>0,
                    'coupon_id'=>'',
                    'coupon_code'=>'',
                    'added_on'=>$added_on,
                    ]);
                    $request->session()->put('FRONT_USER_LOGIN', true);
                    $request->session()->put('FRONT_USER_ID', $insert);
                    $request->session()->put('FRONT_USER_NUMBER', $request->number);
                    $request->session()->put('FRONT_USER_EMAIL', $request->email);
                    $uname=$request->name;
                    $unameArray=explode(' ', $uname);

                    $referCB=DB::table('users')
                    ->where('refer_code','=', $refer_by)
                    ->get();
                    // prx($referCB);
                    if(isset($referCB[0])){
                        $referCBAmount=50;
                        // $type='sign-up';
                        $type="referal bonus";
                        DB::table('users')
                        ->where(['id'=>$insert])
                        ->update(['wallet'=>$referCBAmount]);
                        $sms_msg='Voila! Hey '.$request->name.', your Account is credited with ₹50.   - Start Shopping, Grockart Team';
                        send_mobile_sms($sms_msg, $request->number);

                        $referCB=DB::table('users')
                        ->where('refer_code','=', $refer_by)
                        ->get();
                        
                        DB::table('users')
                        ->where('refer_code','=', $refer_by)
                        ->update(['wallet'=> $referCB[0]->wallet+25]);
                        // die();
                        $cb_order_id=rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999);
                        $result['userDetail']=DB::table('wallet')
                        ->where(['user_id'=>$referCB[0]->id])
                        ->orderBy('id', 'desc')->first();

                        date_default_timezone_set("Asia/Kolkata");
                        DB::table('wallet')
                        ->insert([
                        'type'=>'referal-cashback-received',
                        'user_id'=>$referCB[0]->id,
                        'amount'=>25,
                        'payment_id'=>$cb_order_id,
                        'status'=>'success',
                        'updated_balance'=>$result['userDetail']->updated_balance,
                        'cashback'=>25,
                        'updated_cashback'=>$result['userDetail']->updated_cashback+25,
                        'coupon_id'=>'',
                        'coupon_code'=>'',
                        'added_on'=>$added_on,
                        ]); 

                        $sms_msg='Hurray! Your referal bonus is credited in your Grockart Account.   - Refer More Earn More, Grockart Team';
                        send_mobile_sms($sms_msg, $referCB[0]->mobile);                    

                    }
                    $request->session()->put('FRONT_USER_NAME', $unameArray[0]);
                    if ($insert && $referCBAmount!=0) {
                        DB::table('wallet')
                        ->insert([
                        'type'=>'referal-cashback-received',
                        'user_id'=>$insert,
                        'amount'=>$referCBAmount,
                        'payment_id'=>rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999),
                        'status'=>'success',
                        'updated_balance'=>0,
                        'cashback'=>$referCBAmount,
                        'updated_cashback'=>$referCBAmount,
                        'coupon_id'=>'',
                        'coupon_code'=>$refer_by,
                        'added_on'=>$added_on,
                        ]); 
                        // $data=['name'=>$request->name,'rand_id'=>$rand_id];
                        // $user['to']=$request->email;
                        // Mail::send('front/email_verification',$data,function($messages) use ($user){
                        //     $messages->to($user['to']);
                        //     $messages->subject('Email Id Verification');
                        // });
                        // return response()->json(['status'=> 'success', 'msg'=>'Account Created! Check Email-Id for Verification']);
                    }
                }
            }            
        }
    }

    public function send_otp(Request $request)
    {  
        // prx($request->mobile);
        $otp=rand(11111,99999);
        $request->session()->put('REGISTRATION_OTP', $otp);
        $msg="Welcome to Grockart. Your Mobile Verification OTP is ".$otp;
        send_mobile_sms($msg, $request->number);
    
    }

    public function verify_OTP(Request $request)
    {
        $otp1=$request->otp1;
        $otp2=$request->otp2;
        $otp3=$request->otp3;
        $otp4=$request->otp4;
        $otp5=$request->otp5;

        $combined_otp=$otp1.$otp2.$otp3.$otp4.$otp5;
        $original_otp=$request->session()->get('REGISTRATION_OTP');
        if ($combined_otp==$original_otp) {
            echo "verified";
            $request->session()->forget('REGISTRATION_OTP');
        }else{
            echo "unverified";
        }
    }

    public function login_process(Request $request)
    {
        $result['check_user']=DB::table('users')
        ->where(['email' => $request->login_email])
        ->get();

        if (isset($result['check_user'][0])) {
            if($result['check_user'][0]->status==1){
                $db_password=Crypt::decrypt($result['check_user'][0]->password);
                if ($db_password==$request->login_password) {
                    if($request->rememberme===null){
                        setcookie('login_email',$request->login_email,100);
                        setcookie('login_pwd',$request->login_password,100);
                    }else{
                       setcookie('login_email',$request->login_email,time()+60*60*24*365);
                       setcookie('login_pwd',$request->login_password,time()+60*60*24*365);
                    }
                    $request->session()->put('FRONT_USER_LOGIN', true);
                    $request->session()->put('FRONT_USER_ID', $result['check_user'][0]->id);
                    $request->session()->put('FRONT_USER_NUMBER', $result['check_user'][0]->mobile);
                    $request->session()->put('FRONT_USER_EMAIL', $result['check_user'][0]->email);
                    $uname=$result['check_user'][0]->name;
                    $unameArray=explode(' ', $uname);
                    // prx($unameArray[0]);
                    $request->session()->put('FRONT_USER_NAME', $unameArray[0]);
                    $status="success";
                    $msg="signed in";
                    $getUserTempId=getUserTempId();
                    DB::table('carts')  
                    ->where(['user_id'=>$getUserTempId,'user_type'=>'unregistered'])
                    ->update(['user_id'=>$result['check_user'][0]->id,'user_type'=>'registered']);
                    DB::table('wishlist')  
                    ->where(['user_id'=>$getUserTempId])
                    ->update(['user_id'=>$result['check_user'][0]->id]);
                }else{
                    $status="error";
                    $msg="Password Incorrect";
                }
            }else{
                $status="error";
                $msg="Account Not Activated";                
            }
        }else{
            $status="error";
            $msg="E-Mail id not registered";
        }
            // if ($insert) {
                return response()->json(['status'=> $status, 'msg'=>$msg]);
            // }
        // }

    }

    public function apply_coupon_code(Request $request)
    {
        $result['check_coupon']=DB::table('coupons')
        ->where(['code' => $request->coupon_code])
        ->get(); 
        $getAddToCartTotalItem=getAddToCartTotalItem();
        $totalPrice=0;
        $coupon_code=$request->coupon_code;
        $discount=0;
        $value=0;
        $finalPrice=0;
        $coupon_id=0;
        $discountType='';
        foreach ($getAddToCartTotalItem as $totalprice) {
            $totalPrice=$totalPrice+($totalprice->qty*$totalprice->price);
        }       
        if($request->session()->has('FRONT_USER_LOGIN')){

            if (isset($result['check_coupon'][0])) {
                date_default_timezone_set("Asia/Kolkata");
                $today_date=date('Y-m-d');
                if($result['check_coupon'][0]->status==1){
                    if($today_date<$result['check_coupon'][0]->expired_on){
                        if($result['check_coupon'][0]->type1=='shopping'){
                            if($result['check_coupon'][0]->is_one_time==1){
                                if (session()->has('FRONT_USER_LOGIN')) {
                                    $result['check3']=DB::table('orders')
                                    ->where(['coupon_code' => $request->coupon_code])
                                    ->where(['user_id' => session()->get('FRONT_USER_ID')])
                                    ->get(); 
                                    if (count($result['check3'])>0) {
                                        $status='error';
                                    $msg='Coupon Applied Only For First Time';
                                    }else{
                                        $min_order_amount=$result['check_coupon'][0]->min_cart_value;
                                        if ($min_order_amount>0) {                                
                                            if ($min_order_amount<=$totalPrice) {
                                                $coupon_id=$result['check_coupon'][0]->id;
                                                $value=$result['check_coupon'][0]->value;
                                                $type2=$result['check_coupon'][0]->type2;
                                                $finalPrice=0;
                                                if ($type2=='fix amount') {
                                                    // $discount=$totalPrice-$value;
                                                    if ($value>=$result['check_coupon'][0]->max_discount) {
                                                        $discount=$result['check_coupon'][0]->max_discount;
                                                    }
                                                }
                                                if ($type2=='percentage') {
                                                    $discount=round(($value/100)*$totalPrice);
                                                    if ($discount>$result['check_coupon'][0]->max_discount) {
                                                        $discount=$result['check_coupon'][0]->max_discount;
                                                    }
                                                // $value=$discount;
                                                }

                                                $type3=$result['check_coupon'][0]->type3;
                                                if($type3=='instant'){
                                                    $finalPrice=$totalPrice-$discount;
                                                    $totalPrice=$finalPrice;
                                                    $status='success';
                                                    $discountType='instant';
                                                    // prx($finalPrice); 
                                                    $msg='Coupon applied';
                                                }else{
                                                    $finalPrice=$totalPrice;//-$discount;
                                                    $totalPrice=$finalPrice;
                                                    $discountType='cashback';
                                                    $status='success';
                                                    // prx($finalPrice); 
                                                    $msg='Coupon applied';
                                                }   

                                            }else{
                                                $status='error';
                                                $msg='cart amount must be graeater than '.$min_order_amount;                
                                            }
                                         }else{
                                            $status='success';
                                            $msg='Coupon applied';                
                                         }                                    
                                    }
                                }else{
                                    $status='error';
                                    $msg='Login to use this Coupon';
                                }
                            }else{
                                $min_order_amount=$result['check_coupon'][0]->min_cart_value;
                                if ($min_order_amount>0) {                                
                                    if ($min_order_amount<=$totalPrice) {
                                        $coupon_id=$result['check_coupon'][0]->id;
                                        $value=$result['check_coupon'][0]->value;
                                        $type2=$result['check_coupon'][0]->type2;
                                        $finalPrice=0;
                                        if ($type2=='fix amount') {
                                            // $discount=$totalPrice-$value;
                                            if ($value>=$result['check_coupon'][0]->max_discount) {
                                                $discount=$result['check_coupon'][0]->max_discount;
                                            }
                                        }
                                        if ($type2=='percentage') {
                                            $discount=round(($value/100)*$totalPrice);
                                            if ($discount>$result['check_coupon'][0]->max_discount) {
                                                $discount=$result['check_coupon'][0]->max_discount;
                                            }
                                        // $value=$discount;
                                        }

                                        $type3=$result['check_coupon'][0]->type3;
                                        if($type3=='instant'){
                                            $finalPrice=$totalPrice-$discount;
                                            $totalPrice=$finalPrice;
                                            $discountType='instant';
                                            $status='success';
                                            // prx($finalPrice); 
                                            $msg='Coupon applied';
                                        }else{
                                            $finalPrice=$totalPrice;//-$discount;
                                            $totalPrice=$finalPrice;
                                            $status='success';
                                            $discountType='cashback';
                                            // prx($finalPrice); 
                                            $msg='Coupon applied';
                                        } 
                                        // $finalPrice=$totalPrice-$discount;
                                        // $totalPrice=$finalPrice;
                                        // $status='success';
                                        // // prx($finalPrice); 
                                        // $msg='Coupon applied';                                            
                                    }else{
                                        $status='error';
                                        $msg='cart amount must be graeater than '.$min_order_amount;                
                                    }
                                 }else{
                                    $status='success';
                                    $msg='Coupon applied';                
                                 }             
                            }
                        }else{
                            $status='error';
                            $msg='Coupon invalid for shopping';  
                        }
                        
                    }else{
                        $status='error';
                        $msg='Coupon Expired on '.$result['check_coupon'][0]->expired_on;
                    }
                }else{
                    $status='error';
                    $msg='Coupon Expired';                
                }
            }else{
                $status='error';
                $msg='invalid Coupon'; 
            }   
        }else{
           $status='error';
            $msg='Login to Continue';  
        }

         return response()->json(['status'=>$status,'msg'=>$msg, 'value'=>$value, 'coupon_code'=>$coupon_code, 'coupon_id'=>$coupon_id, 'finalPrice'=>$finalPrice, 'discount'=>$discount, 'totalPrice'=>$totalPrice, 'discountType'=>$discountType]);
         // return response()->json(['status'=>$arr['status'],'msg'=>$arr['msg'],'totalPrice'=>$arr['totalPrice']]);
    }
    
    public function set_coupon_add_money(Request $request)
    {   
        // echo $request->addMoneyCoupon; die(); 
        $result['check_coupon']=DB::table('coupons')
        ->where(['code' => $request->addMoneyCoupon])
        ->get();
        // prx($result['check_coupon']);
        $totalPrice=$request->finalAddAmt;
        $discount=0;
        if (isset($result['check_coupon'][0])) {
            date_default_timezone_set("Asia/Kolkata");
            $today_date=date('Y-m-d');
            if($result['check_coupon'][0]->status==1){
                if($today_date<$result['check_coupon'][0]->expired_on){
                    if($result['check_coupon'][0]->type1=='add-money'){
                        if($result['check_coupon'][0]->is_one_time==1){
                            if (session()->has('FRONT_USER_LOGIN')) {
                                $result['check3']=DB::table('wallet')
                                ->where(['coupon_code' => $request->addMoneyCoupon])
                                ->where(['user_id' => session()->get('FRONT_USER_ID')])
                                ->where(['status' => 'Success'])
                                ->get(); 
                                // echo session()->get('FRONT_USER_ID');die()
                                // prx($result['check3']);
                                if (count($result['check3'])>0) {
                                    $status='error';
                                $msg='Coupon Applied Only For First Time';
                                }else{
                                    $min_order_amount=$result['check_coupon'][0]->min_cart_value;
                                    if ($min_order_amount>0) {                                
                                        if ($min_order_amount<=$totalPrice) {
                                            $coupon_id=$result['check_coupon'][0]->id;
                                            $value=$result['check_coupon'][0]->value;
                                            $type2=$result['check_coupon'][0]->type2;
                                            $finalPrice=0;
                                            if ($type2=='fix amount') {
                                                // $discount=$totalPrice-$value;
                                                if ($value>=$result['check_coupon'][0]->max_discount) {
                                                    $discount=$result['check_coupon'][0]->max_discount;
                                                }
                                            }
                                            if ($type2=='percentage') {
                                                $discount=round(($value/100)*$totalPrice);
                                                if ($discount>$result['check_coupon'][0]->max_discount) {
                                                    $discount=$result['check_coupon'][0]->max_discount;
                                                }
                                            // $value=$discount;
                                            }

                                            $type3=$result['check_coupon'][0]->type3;
                                            if($type3=='instant'){
                                                $finalPrice=$totalPrice-$discount;
                                                $totalPrice=$finalPrice;
                                                $status='success';
                                                // prx($finalPrice); 
                                                $msg='Coupon applied';
                                            }else{
                                                $finalPrice=$totalPrice;//-$discount;
                                                $totalPrice=$finalPrice;
                                                $status='success';
                                                // prx($finalPrice); 
                                                $msg='Coupon applied';
                                            }
                                            // $finalPrice=$totalPrice+$discount;
                                            // $totalPrice=$finalPrice;
                                            // $status='success';
                                            $request->session()->put('COUPON_NAME',$request->addMoneyCoupon);
                                            // $request->session()->put('COUPON_VALUE',$request->coupon_value);
                                            $request->session()->put('COUPON_DISCOUNT',$discount);
                                            // prx($finalPrice); 
                                            // $msg='Coupon applied';                                            
                                        }else{
                                            $status='error';
                                            $msg='cart amount must be graeater than '.$min_order_amount;                
                                        }
                                     }
                                     // else{
                                     //    $status='success';
                                     //    $msg='Coupon applied';                
                                     // }                                    
                                }
                            }else{
                                $status='error';
                                $msg='Login to use this Coupon';
                            }
                        }else{
                            $min_order_amount=$result['check_coupon'][0]->min_cart_value;
                            if ($min_order_amount>0) {                                
                                if ($min_order_amount<=$totalPrice) {
                                    $coupon_id=$result['check_coupon'][0]->id;
                                    $value=$result['check_coupon'][0]->value;
                                    $type2=$result['check_coupon'][0]->type2;
                                    $finalPrice=0;
                                    if ($type2=='fix amount') {
                                        // $discount=$totalPrice-$value;
                                        if ($value>=$result['check_coupon'][0]->max_discount) {
                                            $discount=$result['check_coupon'][0]->max_discount;
                                        }
                                    }
                                    if ($type2=='percentage') {
                                        $discount=round(($value/100)*$totalPrice);
                                        if ($discount>$result['check_coupon'][0]->max_discount) {
                                            $discount=$result['check_coupon'][0]->max_discount;
                                        }
                                    // $value=$discount;
                                    }

                                    $type3=$result['check_coupon'][0]->type3;
                                    if($type3=='instant'){
                                        $finalPrice=$totalPrice-$discount;
                                        $totalPrice=$finalPrice;
                                        $status='success';
                                        // prx($finalPrice); 
                                        $msg='Coupon applied';
                                    }else{
                                        $finalPrice=$totalPrice;//-$discount;
                                        $totalPrice=$finalPrice;
                                        $status='success';
                                        // prx($finalPrice); 
                                        $msg='Coupon applied';
                                    } 
                                    // $finalPrice=$totalPrice+$discount;
                                    // $totalPrice=$finalPrice;
                                    // $status='success';
                                    $request->session()->put('COUPON_NAME',$request->addMoneyCoupon);
                                    // $request->session()->put('COUPON_VALUE',$request->coupon_value);
                                    $request->session()->put('COUPON_DISCOUNT',$discount);                              
                                    // prx($finalPrice); 
                                    // $msg='Coupon applied';                                            
                                }else{
                                    $status='error';
                                    $msg='cart amount must be graeater than '.$min_order_amount;                
                                }
                            }else{
                                $status='success';
                                $msg='Coupon applied';                
                            }             
                        }
                    }else{
                        $status='error';
                        $msg='Coupon invalid for add money';  
                    }
                    
                }else{
                    $status='error';
                    $msg='Coupon Expired on '.$result['check_coupon'][0]->expired_on;
                }
            }else{
                $status='error';
                $msg='Coupon Expired';                
            }
        }else{
            $status='error';
            $msg='invalid Coupon'; 
        }
        return response()->json(['status'=> $status, 'msg'=>$msg, 'totalprice'=>$totalPrice]);
    }  

    public function cartAmount()
    {
        $getAddToCartTotalItem=getAddToCartTotalItem();
        $totalPrice=0;
        foreach ($getAddToCartTotalItem as $totalprice) {
            $totalPrice=$totalPrice+($totalprice->qty*$totalprice->price);
        }
        // prx($totalPrice);
         return response()->json(['totalPrice'=>$totalPrice]);
    }

    public function checkoutForm2(Request $request)
    {
       date_default_timezone_set("Asia/Kolkata");
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $user_type="registered";
            $user_name=$request->session()->get('FRONT_USER_NAME');
        }else{
            $uid=getUserTempId();
            $user_type="unregistered";
            $user_name='guest checkout';
        }        
        if($request->buyer_email!=''){
            $buyer_email=$request->buyer_email;    
        }else{
            $uid=session()->get('FRONT_USER_ID');
            $result['userDetails']=DB::table('users')
            ->where(['id' => $uid])
            ->get();
            // prx($result['userDetails']);    
            $buyer_email=$result['userDetails'][0]->email;
        }

        // prx($_POST);
        if ($request->post('delivery_daily')=='yes') {
            if ($request->post('delivery_days')==0) {
                $totalprice=$request->totalPriceCounter*7;
                $upto_days=7;
            }else{
                $totalprice=$request->totalPriceCounter;
                $upto_days=$request->post('delivery_days');
            }
        }else{
            $totalprice=$request->totalPrice;
        }        
        // print_r($_POST); die();

        $getAddToCartTotalItem=getAddToCartTotalItem();
        // prx($buyer_email);    
        $added_on=date('Y-m-d H:i:s');
        $order_id=DB::table('orders')
        ->insertGetId([
        'user_id'=>$uid,
        'user_type'=>$user_type,
        'address_type'=>$request->buyer_add_type,
        'user_name'=>$user_name,
        'saving'=>$request->netSaving,
        'buyer_name'=>$request->buyer_name,
        'buyer_number'=>$request->buyer_number,
        'buyer_email'=>$buyer_email,
        'address1'=>$request->buyer_add1,
        'address2'=>$request->buyer_add2,
        'city'=>$request->buyer_city,
        'state'=>$request->buyer_state,
        'pin_code'=>$request->buyer_zip,
        'added_on'=>$added_on,
        'delivery_time'=>$request->delivery_time,
        'delivery_date'=>$request->delivery_date,
        'payment_method'=>$request->payment_method,
        'payment_status'=>'failed',
        'order_status'=>0,
        'total_price'=>$totalprice,
        'discount'=>$request->discount,
        'txnid'=>'GOC'.rand(11111,99999).'DN'.rand(11111,99999),
        'payment_id'=>'not available',
        'coupon_id'=>$request->coupon_id,
        'coupon_value'=>$request->coupon_value,
        'coupon_code'=>$request->coupon_code
        ]); 

        if ($order_id>0) {

            if ($request->post('delivery_daily')=='yes') {
                if ($request->post('delivery_days')==0) {
                    $finalMRP=$request->totalPrice*7;
                }else{
                    $finalMRP=$request->totalPrice*$request->post('delivery_days');
                }
                foreach($getAddToCartTotalItem as $orders_detail_list){
                    $prductDetailArr['product_id']=$orders_detail_list->pid;
                    // $prductDetailArr['products_attr_id']=$orders_detail_list->attr_id;
                    $prductDetailArr['price']=$orders_detail_list->price;
                    $prductDetailArr['qty']=$orders_detail_list->qty*$upto_days;
                    $prductDetailArr['order_id']=$order_id;
                    DB::table('order_detail')->insert($prductDetailArr);
                }
                DB::table('order_daily')->insert(['order_id'=>$order_id, 'for_days'=> $upto_days]);
                
            }else{

                foreach($getAddToCartTotalItem as $orders_detail_list){
                    $prductDetailArr['product_id']=$orders_detail_list->pid;
                    // $prductDetailArr['products_attr_id']=$orders_detail_list->attr_id;
                    $prductDetailArr['price']=$orders_detail_list->price;
                    $prductDetailArr['qty']=$orders_detail_list->qty;
                    $prductDetailArr['order_id']=$order_id;
                    DB::table('order_detail')->insert($prductDetailArr);
                }

            }

            // DB::table('carts')->where(['user_id'=>$uid,'user_type'=>'registered'])->delete();
            $request->session()->put('ORDER_ID',$order_id);

            if ($request->payment_method=='CashOnDelivery') {
                $payment_url='CashOnDelivery';       
            }

            if ($request->payment_method=='PaymentGateway') {
                $payment_url='PaymentGateway';       
            } 

            if ($request->payment_method=='wallet') {
                $payment_url='wallet';       
            }            

            $status="success";
            $msg="Order placed";

        }else{
            $status="false";
            $msg="Please try after sometime";
        }
        return response()->json(['status'=>$status,'msg'=>$msg,'payment_url'=>$payment_url]);   
    }

    public function order_confirmation(Request $request)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        $orderId=session()->get('ORDER_ID');
        $result['orderId']=$orderId;
        if (!isset($orderId)) {
            return redirect('/user/orders');
        }
        $result['orderDetails']=DB::table('orders')
        ->where(['id' => $orderId])
        ->get();

        $uid=$result['orderDetails'][0]->user_id;
        $user_type=$result['orderDetails'][0]->user_type;
        $result['email']=$result['orderDetails'][0]->buyer_email;
        $result['name']=$result['orderDetails'][0]->buyer_name;
        // prx($orderId); die();
        $result['prevOrder']=DB::table('orders')
        ->where(['id'=>$orderId])
        ->get();
        // prx($result['prevOrder'][0]->discount);

        DB::table('orders')
        ->where(['id'=>$orderId])
        ->update(['payment_status'=>'success','order_status'=>1,'payment_id'=>'not available']);
        
        $msg='Dear '.$result['orderDetails'][0]->buyer_name.', We have received your order request for ₹'.$result['orderDetails'][0]->total_price.'successfully. You\'ll received another message when your order is proccessed & out for delivery.';
        send_mobile_sms($msg, $result['orderDetails'][0]->buyer_name);

        $result['payment_method']=$result['orderDetails'][0]->payment_method;
        $result['orderAmount']=$result['orderDetails'][0]->total_price;
        $result['delivery_time']=$result['orderDetails'][0]->delivery_time;
        $result['delivery_date']=$result['orderDetails'][0]->delivery_date;
        $result['address1']=$result['orderDetails'][0]->address1;
        $result['address2']=$result['orderDetails'][0]->address2;
        $result['city']=$result['orderDetails'][0]->city;
        $result['state']=$result['orderDetails'][0]->state;
        $result['pin_code']=$result['orderDetails'][0]->pin_code;
        $result['txnid']=$result['orderDetails'][0]->txnid;

        // $transactionData = $this->gateway->getTransactionInfo($request->input('payment-id'));
        // $result['status'] = $transactionData['status']; 
        $result['orderId'] = $orderId; 
        $result['payment_id'] = 'null'; 
        $result['payment_mode'] = 'cod'; 
        $result['transaction_status'] = 'Success';
        date_default_timezone_set("Asia/Kolkata");
        $added_on=date('Y-m-d H:i:s');
        if(session()->has('FRONT_USER_LOGIN')){
            $tempuid=$request->session()->get('FRONT_USER_ID');
        }else{
            $tempuid=0;

        }

        $add_insert=DB::table('user_addresses')
        ->where([
            // 'status'=>1,
            'address_type'=>$result['orderDetails'][0]->address_type,
            'user_addresses_name'=>$result['orderDetails'][0]->buyer_name,
            'user_id'=>$tempuid,
            'main_address'=>$result['orderDetails'][0]->address1,
            'street'=>$result['orderDetails'][0]->address2,
            'city'=>$result['orderDetails'][0]->city,
            'state'=>$result['orderDetails'][0]->state,
            'pincode'=>$result['orderDetails'][0]->pin_code
        ])
        ->get();
        if(!isset($add_insert[0])){

        DB::table('user_addresses')
        ->insert([
                'status'=>1,
                'address_type'=>$result['orderDetails'][0]->address_type,
                'user_addresses_name'=>$result['orderDetails'][0]->buyer_name,
                'user_id'=>$tempuid,
                'main_address'=>$result['orderDetails'][0]->address1,
                'street'=>$result['orderDetails'][0]->address2,
                'city'=>$result['orderDetails'][0]->city,
                'state'=>$result['orderDetails'][0]->state,
                'pincode'=>$result['orderDetails'][0]->pin_code,
                'created_at'=>$result['orderDetails'][0]->added_on,
                'updated_at'=>$result['orderDetails'][0]->added_on
            ]);
        }
            // prx($result);

        if(session()->has('FRONT_USER_LOGIN')){
            $cuid=$request->session()->get('FRONT_USER_ID');
            $cname=$request->session()->get('FRONT_USER_NAME');
            $result['demo']=DB::table('users')
            ->where(['id'=>$cuid])
            // ->where(['name'=>$cname])
            ->get();

            $result['demo1']=DB::table('wallet')
            ->where(['user_id'=>$cuid])
            // ->where(['user_name'=>$cname])
            ->orderBy('id', 'desc')->first();
            // ->get();
            // prx($result['demo1']->updated_cashback);
            $MainwalletBal=$result['demo'][0]->wallet;
            $updated_balance=$result['demo1']->updated_balance;
            $updated_cashback=$result['demo1']->updated_cashback;
            $orderAmount=$result['orderDetails'][0]->total_price;
            if($result['prevOrder'][0]->payment_method=='wallet'){
                $wallet_order_id=rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999);
                if ($updated_balance>$orderAmount) {
                    $newBalance=$updated_balance-$orderAmount;
                    DB::table('users')
                    ->where(['id'=>$cuid])
                    // ->where(['name'=>$cname])
                    ->update(['wallet'=>$newBalance+$updated_cashback]);

                    DB::table('wallet')
                    ->insert([
                    'type'=>'paid-from-wallet',
                    'user_id'=>$cuid,
                    'amount'=>$orderAmount,
                    'payment_id'=>$wallet_order_id,
                    'status'=>'success',
                    'updated_balance'=>$newBalance,
                    'cashback'=>0,
                    'updated_cashback'=>$result['demo1']->updated_cashback,
                    'coupon_id'=>'',
                    'coupon_code'=>'',
                    'added_on'=>$added_on
                    ]);

                }else{
                    $TempnewBalance=$updated_balance-$orderAmount;
                    $newBalance=$updated_cashback+$TempnewBalance;
                    $finalBalance=$MainwalletBal-$orderAmount;
                    DB::table('users')
                    ->where(['id'=>$cuid])
                    // ->where(['name'=>$cname])
                    ->update(['wallet'=>$finalBalance]);

                    DB::table('wallet')
                    ->insert([
                    'type'=>'paid-from-wallet',
                    'user_id'=>$cuid,
                    'amount'=>$orderAmount,
                    'payment_id'=>$wallet_order_id,
                    'status'=>'success',
                    'updated_balance'=>0,
                    'cashback'=>0,
                    'updated_cashback'=>$newBalance,
                    'coupon_id'=>'',
                    'coupon_code'=>'',
                    'added_on'=>$added_on,
                    ]); 

                }
            }
            $result['couponType']=DB::table('coupons')
            ->where(['id'=>$result['prevOrder'][0]->coupon_id])
            ->get();
            // prx($result['couponType']);
            if (isset($result['couponType'][0])) {
                $coupon_type=$result['couponType'][0]->type3;
                $couponDiscount=$result['prevOrder'][0]->discount;
                $couponCode=$result['prevOrder'][0]->coupon_code;
            }else{
                $coupon_type='';
                $couponDiscount=0;
                $couponCode='';
            }

            if ($coupon_type=='cashback' && isset($result['couponType'][0])) {
                $cb_order_id=rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999).'-'.rand(11111,99999);
                $result['demo112']=DB::table('wallet')
                ->where(['user_id'=>$cuid])
                // ->where(['user_name'=>$cname])
                ->orderBy('id', 'desc')->first();
                // prx($result['demo112']->updated_cashback);
                // prx($result['demo112']->updated_cashback+$couponDiscount);
                $newBalance=$updated_balance-$orderAmount;
                DB::table('wallet')
                ->insert([
                'type'=>'cashback-received',
                'user_id'=>$cuid,
                'amount'=>0,
                'payment_id'=>$cb_order_id,
                'status'=>'success',
                'updated_balance'=>$result['demo112']->updated_balance,
                'cashback'=>$couponDiscount,
                'updated_cashback'=>$result['demo112']->updated_cashback+$couponDiscount,
                'coupon_id'=>'',
                'coupon_code'=>$couponCode,
                'added_on'=>$added_on
                ]);
                DB::table('users')
                ->where(['id'=>$cuid])
                // ->where(['name'=>$cname])
                ->update(['wallet'=>$result['demo112']->updated_cashback+$couponDiscount+$result['demo112']->updated_balance]);
            }
            // ->update(['wallet'=>$updated_balance+$updated_cashback]);
        }

        // die();
        DB::table('carts')->where(['user_id'=>$uid,'user_type'=>$user_type])->delete();
        $request->session()->forget('ORDER_ID');
        return view('front.orderConfirm', $result);
    }

    public function my_orders()
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $uid=session()->get('FRONT_USER_ID');
        $result['customer_info']=DB::table('users')
        ->where(['users.id'=>$uid])
        ->get();
        
        $result['my_details']=DB::table('my_details')
        ->get();

        $result['orders']=DB::table('orders')
        ->select('orders.*','order_status.name as order_status')
        ->leftJoin('order_status','order_status.id','=','orders.order_status')
        ->where(['orders.user_id'=>$uid])
        ->where('orders.order_status', '!=', 0)
        ->orderBy('orders.id','desc')
        ->get();    
        
        // prx($result['check_qty']);
        // prx($result['orders']);
        // $check_qty=SoldQty(2);
        // prx($check_qty);
        return view('front.orders', $result);        
    }

    public function order_detail(Request $request,$id)
    {
        $uid=session()->get('FRONT_USER_ID');
        $result['customer_info']=DB::table('users')
        ->where(['users.id'=>$uid])
        ->get();
              
        $result['orders']=DB::table('orders')
        ->select('orders.*','order_status.name as order_status')
        ->leftJoin('order_status','order_status.id','=','orders.order_status')
        ->where(['orders.user_id'=>$uid, 'orders.id'=>$id])
        ->orderBy('orders.id','desc')
        ->get();    

        $result['my_details']=DB::table('my_details')
        ->get();

        $result['orders_details']=
        DB::table('order_detail')
        ->select('order_detail.price','order_detail.qty','order_detail.product_id','products.name as pname','product_attributes.weight')
        ->leftJoin('orders','orders.id','=','order_detail.order_id')
        // ->leftJoin('products_attr','products_attr.id','=','order_detail.products_attr_id')
        ->leftJoin('products','products.id','=','order_detail.product_id')
        ->leftJoin('product_attributes','product_attributes.product_id','=','products.id')
        // ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
        // ->leftJoin('order_status','order_status.id','=','orders.order_status')
        // ->leftJoin('colors','colors.id','=','products_attr.color_id')
        ->where(['orders.id'=>$id])
        // ->where(['orders.customers_id'=>$request->session()->get('FRONT_USER_ID')])
        ->get();

        if(!isset($result['orders'][0]) || !isset($uid)){
            return redirect('/user/orders');
        }
        // prx($result);
        // prx($result['orders']);
         // return response()->json(['data'=>$result]);
        return view('front.orderDetail',$result);
    }

    public function order_review(Request $request)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();

        $result['review_id']=$request->id;

        if(session()->get('FRONT_USER_ID')){
            $uid=session()->get('FRONT_USER_ID');
            $result['customer_info']=DB::table('users')
            ->where(['users.id'=>$uid])
            ->get();

            $check__review=DB::table('reviews')
            ->where('user_id', '=', $request->session()->get('FRONT_USER_ID'))
            ->where('order_id', '=', $request->id)
            ->get();    
            if (!isset($check__review[0])) { return redirect('/user/orders'); }
            return view('front.order-review', $result);  
        }else{ return redirect('/user/orders');}
    }    

    public function order_review_submit(Request $request)
    {
        // echo $request->id;die();
        date_default_timezone_set("Asia/Kolkata");
        $review_date=date('Y-m-d h:i:s');
        $check__review=DB::table('reviews')
        ->where('user_id', '=', $request->session()->get('FRONT_USER_ID'))
        ->where('order_id', '=', $request->id)
        ->get();
        // prx($check__review[0]->q11);
        if ($request->q11!='') {
            $xtra=$request->q11;
        }else{
            $xtra=$check__review[0]->q11;
        }
        if(count($check__review)>0){
            // DB::table('reviews')
            // ->update([
            //     'user_id'=>$request->session()->get('FRONT_USER_ID'),
            //     'order_id'=>$request->id,
            //     'q1'=>$request->q1,
            //     'q2'=>$request->q2,
            //     'q3'=>$request->q3,
            //     'q4'=>$request->q4,
            //     'q5'=>$request->q5,
            //     'q6'=>$request->q6,
            //     'q7'=>$request->q7,
            //     'q8'=>$request->q8,
            //     'q9'=>$request->q9,
            //     'q10'=>$request->q10,
            //     'q11'=>$xtra,
            //     'added_on'=>$review_date
            // ]);
        }else{
            DB::table('reviews')
            ->insert([
                'user_id'=>$request->session()->get('FRONT_USER_ID'),
                'order_id'=>$request->id,
                'q1'=>$request->q1,
                'q2'=>$request->q2,
                'q3'=>$request->q3,
                'q4'=>$request->q4,
                'q5'=>$request->q5,
                'q6'=>$request->q6,
                'q7'=>$request->q7,
                'q8'=>$request->q8,
                'q9'=>$request->q9,
                'q10'=>$request->q10,
                'q11'=>$request->q11,
                'added_on'=>$review_date
            ]);
        }
        if ($request->session()->has('review_status')) {
            $request->session()->forget('review_status');
        }
        $request->session()->put('review_status', 'thanks for your request, but your review for this order is submitted!');
            

        return redirect('/user/orders');
        return redirect('/user/orders');
    }

    public function categories(Request $request,$slug)
    {   
        if(isset($_GET['category']) && $_GET['category']!='null'){
            $tmp_category=explode(',', $_GET['category']);
            $i=0;
            $query1=DB::table('categories');
            $query2=DB::table('categories');
            $query1=$query1->where(['status'=>1]);
            $query2=$query2->where(['status'=>1]);
            foreach ($tmp_category as $tmpcat) {
                $query2=$query2->where('category_slug','!=',$tmpcat);
                if ($i==0){
                    $query1=$query1->where('category_slug','=',$tmpcat);
                }else{
                    $query1=$query1->orwhere('category_slug','=',$tmpcat);
                }
                $i++;
            }
            $query1=$query1->get();
            $query2=$query2->get();
            $result['selected_categories']=$query1;
            $result['remainig_categories']=$query2;
            $result['categories']=DB::table('categories')
            ->where(['status'=>1])
            ->orderBy('categories.category_name')
            // ->inRandomOrder()
            ->limit(8)
            ->get();
            
        }else{
            $result['categories']=DB::table('categories')
            ->where(['status'=>1])
            ->where(['show_home'=>1])
            ->orderBy('categories.category_name')
            // ->inRandomOrder()
            ->limit(8)
            ->get();
        }

        //----------------------------
        if(isset($_GET['subcategory']) && $_GET['subcategory']!='null'){
            $tmp_sub_categories=explode(',', $_GET['subcategory']);
            $j=0;
            $query111=DB::table('sub_categories');
            $query222=DB::table('sub_categories');
            $query111=$query111->where(['status'=>1]);
            $query222=$query222->where(['status'=>1]);
            foreach ($tmp_sub_categories as $tmpsubcat) {
                $query222=$query222->where('subcategory_slug','!=',$tmpsubcat);
                if ($j==0){
                    $query111=$query111->where('subcategory_slug','=',$tmpsubcat);
                }else{
                    $query111=$query111->orwhere('subcategory_slug','=',$tmpsubcat);
                }
                $j++;
            }
            $query111=$query111->get();
            $query222=$query222->get();
            $result['selected_sub_categories']=$query111;
            $result['remainig_sub_categories']=$query222;
            $result['subcategories']=DB::table('sub_categories')
            ->where(['status'=>1])
            ->orderBy('sub_categories.subcategory_name')
            // ->inRandomOrder()
            ->limit(8)
            ->get();            
        }else{
            $result['subcategories']=DB::table('sub_categories')
            ->where(['status'=>1])
            ->orderBy('sub_categories.subcategory_name')
            // ->orderBy('sub_categories.subcategory_name')
            // ->inRandomOrder()
            ->limit(8)
            ->get();
        }
        //----------------------------
            // prx($result['remainig_sub_categories']);

        if(isset($_GET['from']) && $_GET['from']=='all'){
            $result['all_sub_categories']=DB::table('sub_categories')
            ->where(['subcategory_slug'=>$_GET['subcategory']])
            ->get();   
        }else{
            $result['all_sub_categories']=[];
        }
        // prx($result['all_sub_categories']);

        $result['currentCategories']=DB::table('categories')
        ->where('category_slug','=',$slug)
        // ->select('categories.category_name','categories.category_slug')
        ->get();
        // prx($result['currentCategories'][0]);
        $result['sub_categories']=DB::table('sub_categories')
        ->where(['status'=>1])
        // ->where(['show_home'=>1])
        // ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();        

        $page=1;
        if (isset($_GET['page'])) {
            $page=$_GET['page'];
        }
        $result['page']=$page;

        $sort='null';
        $result['sort']=$sort;

        $result['urlcategoryslug']='null';
        // $urlcategory=$result['currentCategories'][0]->id;
        $result['urlcategory']=$slug; //urlcategory;
        if(isset($_GET['category']) && $_GET['category']!='null'){
            $result['urlcategoryslug']=$_GET['category'];
        }
        // prx($result['urlcategory']);
        $urlsubcategory='null';
        $result['urlsubcategory']=$urlsubcategory;        
        if(isset($_GET['subcategory']) && $_GET['subcategory']!='null'){
            $result['urlsubcategory']=$_GET['subcategory'];
        }

        $query=DB::table('products');
        $query=$query->leftJoin('product_attributes','products.id','=','product_attributes.product_id');
        $query=$query->where(['products.status'=>1]);

        $category=$request->get('category');
        $subcategory=$request->get('subcategory');

        if ( isset($category) && $category!='null' && isset($subcategory) && $subcategory!='null') {
            $category_arr = explode (",", $category);
            $category_arr_length=count($category_arr);

            $subcategory=$request->get('subcategory');
            $subcategory_arr = explode (",", $subcategory);
            $subcategory_arr_length=count($subcategory_arr);

            $query=$query->leftJoin('sub_categories','sub_categories.id','=','products.sub_cat_id');
            $query=$query->leftJoin('categories','categories.id','=','products.cat_id');
            if ($category_arr_length==1) {
                $query=$query->where('categories.category_slug','=',$category_arr[0]);
            }
            else{
                $i=0;
                foreach ($category_arr as $key => $value) {
                    if($i==0){
                        $query=$query->where(['categories.category_slug'=>$value]);
                    }else{
                        $query=$query->orwhere(['categories.category_slug'=>$value]);
                    }
                    $i++;
                }
            }

            if ($subcategory_arr_length==1) {
                $query=$query->where('sub_categories.subcategory_slug','=',$subcategory_arr[0]);
            }
            else{
                $j=0;
                foreach ($subcategory_arr as $key => $value1) {
                    if($j==0){
                        $query=$query->where(['sub_categories.subcategory_slug'=>$value1]);
                    }else{
                        $query=$query->orwhere(['sub_categories.subcategory_slug'=>$value1]);
                    }
                    $j++;
                }
            }
        }
        elseif(isset($category) && $category!='null'){
            // $query=$query->where('products.cat_id','=',$category_arr);
            $category=$request->get('category');
            $category_arr = explode (",", $category);
            $category_arr_length=count($category_arr);
            $query=$query->leftJoin('categories','categories.id','=','products.cat_id');
            if ($category_arr_length==1) {
                $query=$query->where('categories.category_slug','=',$category_arr[0]);
            }
            else{
                $i=0;
                foreach ($category_arr as $key => $value) {
                    if($i==0){
                        $query=$query->where(['categories.category_slug'=>$value]);
                    }else{
                        $query=$query->orwhere(['categories.category_slug'=>$value]);
                    }
                    $i++;
                }
            }
        }
        elseif(isset($subcategory) && $subcategory!='null'){
            $subcategory=$request->get('subcategory');
            $subcategory_arr = explode (",", $subcategory);
            $subcategory_arr_length=count($subcategory_arr);
            $query=$query->leftJoin('sub_categories','sub_categories.id','=','products.sub_cat_id');
            if ($subcategory_arr_length==1) {
                $query=$query->where('sub_categories.subcategory_slug','=',$subcategory_arr[0]);
            }
            else{
                $j=0;
                foreach ($subcategory_arr as $key => $value) {
                    if($j==0){
                        $query=$query->where(['sub_categories.subcategory_slug'=>$value]);
                    }else{
                        $query=$query->orwhere(['sub_categories.subcategory_slug'=>$value]);
                    }
                    $j++;
                }
            }
        }
        else {
            $query=$query->where(['products.cat_id'=>$result['currentCategories'][0]->id]);  
        }

        if($request->get('sort') && $request->get('sort')!='null'){
            $sort=$request->get('sort');
            $result['sort']=$sort;
            
            if($sort=='date'){
                $query=$query->orderBy('products.id','desc');
            }
            if($sort=='name'){
                $query=$query->orderBy('products.name','asc');
            }
            
            if($sort=='popularity'){
                $query=$query->orderBy('product_attributes.rating','desc');
            }
            
            if($sort=='price_low'){
                $query=$query->orderBy('product_attributes.price','desc');
            }
            if($sort=='price_high'){
                $query=$query->orderBy('product_attributes.price','asc');
            }

            $query=$query->distinct()->select('products.discount','products.name','product_attributes.product_id','product_attributes.image1','product_attributes.mrp','product_attributes.price','products.slug');
            $query=$query->paginate(24);

            // $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category='.$request->get('category').'&subcategory='.$request->get('subcategory'));
            if(!isset($_POST['category']) && !isset($_POST['subcategory'])){
                $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category=null&subcategory=null');
            }
            elseif(!isset($_POST['category']) && isset($_POST['subcategory'])){
                if ($_POST['subcategory']=='null') {
                    $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category=null&subcategory=null');
                }else{
                $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category=null&subcategory='.$_POST['subcategory']);
                }
            }
            elseif(isset($_POST['category']) && !isset($_POST['subcategory'])){
                if ($_POST['category']=='null') {
                    $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category=null&subcategory=null');
                }else{
                $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category='.$_POST['category'].'&subcategory=null');
                }
            }
            else{
             // elseif(isset($_POST['category']) && isset($_POST['subcategory'])){
                $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category='.$_POST['category'].'&subcategory='.$_POST['category']);
            }     

            // $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category='.$_POST['category'].'&subcategory='.$_POST['subcategory']);

            $result['product']=$query;
            return view('front.category',$result);
        }

        $query=$query->distinct()->select('products.discount','products.name','product_attributes.product_id','product_attributes.image1','product_attributes.mrp','product_attributes.price','products.slug');
        // $query=$query->toSql();
        // prx($query);
        $query=$query->paginate(24);

        //===

        if(!isset($_POST['category']) && !isset($_POST['subcategory'])){
            $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category=null&subcategory=null');
        }
        elseif(!isset($_POST['category']) && isset($_POST['subcategory'])){
            if ($_POST['subcategory']=='null') {
                $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category=null&subcategory=null');
            }else{
            $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category=null&subcategory='.$_POST['subcategory']);
            }
        }
        elseif(isset($_POST['category']) && !isset($_POST['subcategory'])){
            if ($_POST['category']=='null') {
                $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category=null&subcategory=null');
            }else{
            $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category='.$_POST['category'].'&subcategory=null');
            }
        }
        else{
            // elseif(isset($_POST['category']) && isset($_POST['subcategory'])){
            $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category='.$_POST['category'].'&subcategory='.$_POST['category']);
        }

        //===

        // $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$result['sort'].'&category='.$_POST['category'].'&subcategory='.$_POST['subcategory']);

        // $query=$query->withPath('/categories/'.$result['currentCategories'][0]->category_slug.'?sort='.$sort.'&category='.$request->get('category').'&subcategory='.$request->get('subcategory'));
        $result['product']=$query;
        return view('front.category',$result);
    }    

    public function featured(Request $request, $getsort='')
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();

        $page='';
        if (isset($_GET['page'])) {
            $page=$_GET['page'];
        }
        $result['page']=$page;

        $sort="";
        $result['sort']=$sort;
        if ($getsort!='') {
            $result['sort']='/'.$getsort;
        }
        $query=DB::table('products');
        // $query=$query->leftJoin('categories','categories.id','=','products.cat_id');
        $query=$query->leftJoin('product_attributes','products.id','=','product_attributes.product_id');
        $query=$query->where(['products.status'=>1]);
        $query=$query->where(['product_attributes.featured'=>1]);
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
            if($sort=='date'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('products.id','desc');
            }
            if($sort=='name'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('products.name','asc');
            }
            if($sort=='popularity'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.rating','desc');
            }
            if($sort=='price_low'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.price','desc');
            }
            if($sort=='price_high'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.price','asc');
            }
            $query=$query->distinct()->select('products.id','products.name','products.discount','products.slug','product_attributes.image1','product_attributes.mrp','product_attributes.price','product_attributes.product_id');
            // $query=$query->get();
            $query=$query->paginate(24);

            $query=$query->withPath('featured-products'.$result['sort']);
            $result['product']=$query;
            if ($product->count()==0) {
                return redirect('/featured-products');
            }
            return view('front.featured', $result);            
            // return response()->json(['products'=>$result['product']]);
        }
        $query=$query->select('products.id','product_attributes.product_id','products.name','products.discount','products.slug','product_attributes.image1','product_attributes.mrp','product_attributes.price','product_attributes.product_id');
        $query=$query->paginate(24);
        $query=$query->withPath('/featured-products'.$result['sort']);
        $result['product']=$query;
        // prx($result['product']);
        return view('front.featured', $result);
    }

    public function discounted(Request $request, $getsort='')
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();

        $page='';
        if (isset($_GET['page'])) {
            $page=$_GET['page'];
        }
        $result['page']=$page;

        $sort="";
        $result['sort']=$sort;
        if ($getsort!='') {
            $result['sort']='/'.$getsort;
        }
        $query=DB::table('products');
        // $query=$query->leftJoin('categories','categories.id','=','products.cat_id');
        $query=$query->leftJoin('product_attributes','products.id','=','product_attributes.product_id');
        $query=$query->where(['products.status'=>1]);
        $query=$query->where(['product_attributes.discounted'=>1]);
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
            if($sort=='date'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('products.id','desc');
            }
            if($sort=='name'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('products.name','asc');
            }
            if($sort=='popularity'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.rating','desc');
            }
            if($sort=='price_low'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.price','desc');
            }
            if($sort=='price_high'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.price','asc');
            }
            $query=$query->distinct()->select('products.id','products.name','products.discount','products.slug','product_attributes.image1','product_attributes.mrp','product_attributes.price','product_attributes.product_id');
            // $query=$query->get();
            $query=$query->paginate(24);
            $query=$query->withPath('featured-products'.$result['sort']);
            $result['product']=$query;
            return view('front.featured', $result);            
            // return response()->json(['products'=>$result['product']]);
        }
        $query=$query->select('products.id','product_attributes.product_id','products.name','products.discount','products.slug','product_attributes.image1','product_attributes.mrp','product_attributes.price','product_attributes.product_id');
        $query=$query->paginate(24);
        $query=$query->withPath('/featured-products'.$result['sort']);
        $result['product']=$query;
        // prx($result['product']);
        return view('front.discounted', $result);
    }

    public function about(Request $request)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.about', $result);
    }

    public function blog(Request $request)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['blog']=DB::table('blog')
        ->where(['status'=>1])
        ->limit(10)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        // prx($result['blog']);
        return view('front.blog', $result);
    }

    public function blogDetail(Request $request, $slug)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['blogDetail']=DB::table('blog')
        ->where(['status'=>1])
        ->where(['slug'=>$slug])
        ->get();

        $result['blogID']=DB::table('blog')
        ->where(['slug'=>$slug])
        ->select('id')
        ->get();

        // prx($result['blogID'][0]->id);

        $result['blogComment']=DB::table('blog_like')
        ->where(['blog_id'=>$result['blogID'][0]->id])
        ->get();

        $result['commentCount']=count($result['blogComment']);

        $result['my_details']=DB::table('my_details')
        ->get();
        // prx($result['commentCount']);
        return view('front.blogDetail', $result);
    }    

    public function blogLike(Request $request)
    {
        $blogId=$request->blog_id;
        $uid=$request->uid;
        $user_name=$request->user_name;
        $unum=session()->get('FRONT_USER_NUMBER');
        $uemail=session()->get('FRONT_USER_EMAIL');
        $check=DB::table('blog_like')
        ->where(['user_id'=>$uid])
        ->where(['user_name'=>$user_name])
        ->get();
        $blogTotalLike=DB::table('blog')
        // ->where(['user_id'=>$uid])
        // ->where(['user_name'=>$user_name])
        ->get();

        $blogTotalLikeRes=$blogTotalLike[0]->blog_like;
        // prx(count($check));
        if (isset($check[0]) && $check[0]->liked!='yes') {
            // echo "liked";
            DB::table('blog_like')
            ->where(['blog_id'=>$blogId])
            ->where(['user_id'=>$uid])
            ->where(['user_name'=>$user_name])
            ->update(['liked'=>'yes']);

            echo $blogTotalLikeRes+1;
            DB::table('blog')
            ->where(['id'=>$blogId])
            ->update(['blog_like'=>$blogTotalLikeRes+1]);

        }
        elseif(!isset($check[0])){
            echo $blogTotalLikeRes+1;
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');
            DB::table('blog')
            ->where(['id'=>$blogId])
            ->update(['blog_like'=>$blogTotalLikeRes+1]);
            
            DB::table('blog_like')
            ->insert([
            'user_name'=>Str::of($user_name)->lower(),
            'user_id'=>$uid,
            'blog_id'=>$blogId,
            'blog_comment'=>'',
            'added_on'=>$added_on,
            'email'=>$uemail,
            'mobile'=>$unum,
            'liked'=>'yes'
            ]);            
            // echo "done";
        }
        else{
            echo $blogTotalLikeRes;
        }
    }

    public function blogComment(Request $request)
    {
        // prx(count($request->post()));
        if (count($request->post())==2) {
            $blogId=$request->post('blogId');
            $uid=session()->get('FRONT_USER_ID');
            $uname=session()->get('FRONT_USER_NAME');
            $unum=session()->get('FRONT_USER_NUMBER');
            $uemail=session()->get('FRONT_USER_EMAIL');
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');
            $check=DB::table('blog_like')
            ->where(['user_id'=>$uid])
            ->where(['user_name'=>$uname])
            ->get();        
            // prx($check);
            if (isset($check[0]) && $check[0]->blog_comment=='') {
                DB::table('blog_like')
                ->where(['blog_id'=>$blogId])
                ->where(['user_id'=>$uid])
                ->where(['user_name'=>$uname])
                ->update(['blog_comment'=>Str::of($request->post('message'))->lower()]);
                echo "update commment";
            }
            elseif(!isset($check[0])){
                DB::table('blog_like')
                ->insert([
                    'user_name'=>Str::of($uname)->lower(),
                    'user_id'=>$uid,
                    'blog_id'=>$blogId,
                    'blog_comment'=>Str::of($request->post('message'))->lower(),
                    'email'=>$uemail,
                    'added_on'=>$added_on,
                    'mobile'=>$unum,
                    'liked'=>'no'
                ]); 
                echo "insert commment";
            }
            else{
               DB::table('blog_like')
                ->where(['blog_id'=>$blogId])
                ->where(['user_id'=>$uid])
                ->where(['user_name'=>$uname])
                ->update(['blog_comment'=>Str::of($request->post('message'))->lower()]);
                echo "update commment";
            }
        }

        if (count($request->post())==5) {
        // else{
            // prx($request->post());
            $blogId=$request->post('blogId');
            $uid=0;
            $uname=$request->post('fullname');
            $message=$request->post('message');
            $unum=$request->post('phonenumber');
            $uemail=$request->post('emailaddress');
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');
            $check2=DB::table('blog_like')
            ->where(['user_id'=>$uid])
            ->where(['user_name'=>$uname])
            ->where(['mobile'=>$unum])
            ->where(['email'=>$uemail])
            // ->where(['blogComment'!=''])
            ->get();  
            // prx(count($check2));
                // echo "not login";
            if (count($check2)<1) {
                DB::table('blog_like')
                ->insert([
                    'user_name'=>Str::of($uname)->lower(),
                    'user_id'=>$uid,
                    'blog_id'=>$blogId,
                    'blog_comment'=>Str::of($request->post('message'))->lower(),
                    'email'=>$uemail,
                    'added_on'=>$added_on,
                    'mobile'=>$unum,
                    'liked'=>'no'
                ]);
            }
            if (count($check2)>0) {
                DB::table('blog_like')
                ->where(['blog_id'=>$blogId])
                ->where(['user_id'=>$uid])
                ->where(['user_name'=>$uname])
                ->where(['mobile'=>$unum])
                ->update(['blog_comment'=>Str::of($request->post('message'))->lower()]);
                echo "update commment";
            }

        }
    }

    public function contact(Request $request)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.contact', $result);
    }    

    public function latest(Request $request, $getsort='')
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();

        $page='';
        if (isset($_GET['page'])) {
            $page=$_GET['page'];
        }
        $result['page']=$page;

        $sort="";
        $result['sort']=$sort;
        if ($getsort!='') {
            $result['sort']='/'.$getsort;
        }
        $query=DB::table('products');
        // $query=$query->leftJoin('categories','categories.id','=','products.cat_id');
        $query=$query->leftJoin('product_attributes','products.id','=','product_attributes.product_id');
        $query=$query->where(['products.status'=>1]);
        $query=$query->where(['product_attributes.discounted'=>1]);
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
            if($sort=='date'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('products.id','desc');
            }
            if($sort=='name'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('products.name','asc');
            }
            if($sort=='popularity'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.rating','desc');
            }
            if($sort=='price_low'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.price','desc');
            }
            if($sort=='price_high'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.price','asc');
            }
            $query=$query->distinct()->select('products.id','products.name','products.discount','products.slug','product_attributes.image1','product_attributes.mrp','product_attributes.price','product_attributes.product_id');
            // $query=$query->get();
            $query=$query->orderBy('products.id','desc');
            $query=$query->paginate(24);
            $query=$query->withPath('featured-products'.$result['sort']);
            $result['product']=$query;
            return view('front.featured', $result);            
            // return response()->json(['products'=>$result['product']]);
        }
        $query=$query->select('products.id','product_attributes.product_id','products.name','products.discount','products.slug','product_attributes.image1','product_attributes.mrp','product_attributes.price','product_attributes.product_id');
        $query=$query->orderBy('products.id','desc');
        $query=$query->paginate(24);
        $query=$query->withPath('/featured-products'.$result['sort']);
        $result['product']=$query;
        // prx($result['product']);
        return view('front.latest', $result);
    }

    public function bestSeller(Request $request, $getsort='')
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();

        $page='';
        if (isset($_GET['page'])) {
            $page=$_GET['page'];
        }
        $result['page']=$page;

        $sort="";
        $result['sort']=$sort;
        if ($getsort!='') {
            $result['sort']='/'.$getsort;
        }
        $query=DB::table('products');
        // $query=$query->leftJoin('categories','categories.id','=','products.cat_id');
        $query=$query->leftJoin('product_attributes','products.id','=','product_attributes.product_id');
        $query=$query->where(['products.status'=>1]);
        $query=$query->where(['product_attributes.best_seller'=>1]);
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
            if($sort=='date'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('products.id','desc');
            }
            if($sort=='name'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('products.name','asc');
            }
            if($sort=='popularity'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.rating','desc');
            }
            if($sort=='price_low'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.price','desc');
            }
            if($sort=='price_high'){
                // $query=$query->where(['categories.category_slug'=>$slug]);
                $query=$query->orderBy('product_attributes.price','asc');
            }
            $query=$query->distinct()->select('products.id','products.name','products.discount','products.slug','product_attributes.image1','product_attributes.mrp','product_attributes.price','product_attributes.product_id');
            // $query=$query->get();
            $query=$query->orderBy('products.id','desc');
            $query=$query->paginate(24);
            $query=$query->withPath('featured-products'.$result['sort']);
            $result['product']=$query;
            return view('front.featured', $result);            
            // return response()->json(['products'=>$result['product']]);
        }
        $query=$query->select('products.id','product_attributes.product_id','products.name','products.discount','products.slug','product_attributes.image1','product_attributes.mrp','product_attributes.price','product_attributes.product_id');
        $query=$query->orderBy('products.id','desc');
        $query=$query->paginate(24);
        $query=$query->withPath('/featured-products'.$result['sort']);
        $result['product']=$query;
        // prx($result['product']);
        return view('front.bestSeller', $result);
    }

    public function cartItem()
    {
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $user_type="registered";
        }else{
            $uid=getUserTempId();
            $user_type="unregistered";
        }
        $result['cart_items']=DB::table('carts')
        // ->leftJoin('products','products.id','=','carts.product_id')
        // ->leftJoin('product_attributes','product_attributes.product_id','=','carts.product_id')
        ->where(['user_id'=>$uid])
        ->where(['user_type'=>$user_type])
        // ->select('carts.qty','products.name','product_attributes.image1','product_attributes.weight', 'product_attributes.mrp', 'product_attributes.price','products.slug','products.id as pid','product_attributes.id as attribute_id')
        ->get();
        // prx($result['cart_items']);
        return response()->json(['carttotalItem'=>count($result['cart_items'])]);        
    }    

    public function dashboard()
    {
        $uid=session()->get('FRONT_USER_ID');
        $result['customer_info']=DB::table('users')
        ->where(['users.id'=>$uid])
        ->get();
        
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();

        $result['my_orders']=DB::table('orders')
        ->leftJoin('order_status','orders.order_status', '=', 'order_status.id')
        ->where('user_id', '=', $uid)
        ->select('orders.id','orders.total_price','orders.added_on','order_status.name')
        ->orderBy('orders.id', 'desc')
        ->limit(5)
        ->get();
        
        // prx($result['my_orders']);
        
        return view('front.dashboard', $result);
    }

    public function my_rewards()
    {
        $uid=session()->get('FRONT_USER_ID');
        $result['customer_info']=DB::table('users')
        ->where(['users.id'=>$uid])
        ->get();
        
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.rewards', $result);
    }

    public function my_wallet()
    {
        $uid=session()->get('FRONT_USER_ID');
        // $user_name=session()->get('FRONT_USER_NAME');
        $result['customer_info']=DB::table('users')
        ->where(['users.id'=>$uid])
        ->get();

        $result['wallet_info']=DB::table('wallet')
        ->where(['wallet.user_id'=>$uid])
        ->where('type', '!=',  'sign-up')
        ->orderBy('id', 'desc')
        ->limit(20)
        ->get();
        
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();

        $result['my_wallet']=DB::table('wallet')
        // ->where(['user_name'=>$user_name])
        ->where(['user_id'=>$uid])
        ->orderBy('id', 'desc')->first();
        // ->get();
        // prx($result['wallet_info']);
        // prx($result['my_wallet']);
        return view('front.wallet', $result);
    }

    public function my_wishlist()
    {
        $uid=session()->get('FRONT_USER_ID');
        $result['customer_info']=DB::table('users')
        ->where(['users.id'=>$uid])
        ->get();
        
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['currentItems']=checkWishlistItem($uid);
        // prx(count($result['currentItems']));
        if(count($result['currentItems'])!=0)
        {
            foreach ($result['currentItems'] as $value) {
                $wishlistDetails[]=DB::table('products')
                // ->Join('products','products.id','=','product_attributes.product_id')
                ->where('products.id', '=', $value->product_id)
                ->leftJoin('product_attributes','products.id','=','product_attributes.product_id')
                ->leftJoin('wishlist','wishlist.product_id','=','products.id')
                ->where(['wishlist.user_id'=>$uid])
                ->select('wishlist.id as wid','products.name','products.slug','product_attributes.image1','product_attributes.mrp','product_attributes.price','product_attributes.rating','products.discount')
                ->get();
            }
            // prx(count($wishlistDetails));
            $result['wishlistDetails']=$wishlistDetails;
        }
        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.wishlist', $result);
    }

    public function my_address_delete(Request $request, $id='')
    {
        $uid=session()->get('FRONT_USER_ID');
        $result['customer_info']=DB::table('users')
        ->where(['users.id'=>$uid])
        ->get();
        
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $uid=$request->session()->get('FRONT_USER_ID');
        $result['addresses']=DB::table('user_addresses')
        ->where(['status'=>1])
        ->where(['user_id' => $uid])
        ->get();
        $result['my_details']=DB::table('my_details')
        ->get();             

        DB::table('user_addresses')
        ->where(['id'=>$id,'user_id'=>$uid])
        ->update(['status'=>0]);

        return redirect('/user/address');
    }

    public function my_address(Request $request, $id='')
    {   
        $result['addAddress']='';
        $uid=session()->get('FRONT_USER_ID');
        $result['customer_info']=DB::table('users')
        ->where(['users.id'=>$uid])
        ->get();
        
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['addresses']=DB::table('user_addresses')
        ->where(['status'=>1])
        ->where(['user_id' => $uid])
        ->get();
        $result['my_details']=DB::table('my_details')
        ->get();     

        if(isset($id)){        
            if ($request->post('user_addresses_name')) {
                $user_addresses_type=$request->post('user_addresses_type');
                $user_addresses_name=$request->post('user_addresses_name');
                $main_address=$request->post('main_address');
                $street=$request->post('street');
                $city=$request->post('city');
                $state=$request->post('state');
                $pincode=$request->post('pincode');
                // prx($request->post('user_addresses_type'));
                DB::table('user_addresses')
                ->where(['id'=>$id,'user_id'=>$uid])
                ->update(['address_type'=>$user_addresses_type,'user_addresses_name'=>$user_addresses_name,'main_address'=>$main_address,'street'=>$street,'city'=>$city,'pincode'=>$pincode,'state'=>$state]);
                return redirect('/user/address');
            }   
        }

        if (isset($id) && $id=='add') {
            $result['addAddress']='add';
            // die();
        }
        $result['updateAddress']=DB::table('user_addresses')
        ->where(['status'=>1])
        ->where(['user_id' => $uid])
        ->where(['id' => $id])
        ->get();
        $result['CheckAddress']=count($result['updateAddress']);



        return view('front.address', $result);
    }

    public function set_address(Request $request)
    {
        $uid=$request->session()->get('FRONT_USER_ID');
        if ($request->post('user_addresses_type')=='') {
            $user_addresses_type='home';
        }else{
            $user_addresses_type=$request->post('user_addresses_type');
        }
        $user_addresses_name=Str::of($request->post('user_addresses_name'))->lower();
        $main_address=Str::of($request->post('main_address'))->lower();
        $street=Str::of($request->post('street'))->lower();
        $city=Str::of($request->post('city'))->lower();
        $state=Str::of($request->post('state'))->lower();
        $pincode=$request->post('pincode');
        date_default_timezone_set("Asia/Kolkata");
        $added_on=date('Y-m-d H:i:s');
        $status=1;
        $insert=DB::table('user_addresses')->insert(['address_type'=>$user_addresses_type,'user_addresses_name'=>$user_addresses_name,'user_id'=>$uid,'main_address'=>$main_address,'street'=>$street,'city'=>$city,'state'=>$state,'pincode'=>$pincode,'created_at'=>$added_on,'updated_at'=>$added_on,'status'=>$status]);
            if ($insert) {
                echo "submitted";
                // return redirect('/user/address');
            }
    }

    public function AddToWishlist(Request $request)
     {
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $product_id = $request->post('pid');
            $checkItems = checkWishlist($product_id, $uid);
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');
            if(count($checkItems)<1){
                DB::table('wishlist')->insert(['user_id'=>$uid, 'product_id'=>$product_id, 'added_on'=>$added_on]);
            }  
            $currentItems=checkWishlistItem($uid);
            echo count($currentItems);
        }else{
            $uid=getUserTempId();
            $product_id = $request->post('pid');
            $checkItems = checkWishlist($product_id, $uid);
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');
            if(count($checkItems)<1){
                DB::table('wishlist')->insert(['user_id'=>$uid, 'product_id'=>$product_id, 'added_on'=>$added_on]);
            }
            echo "login";  
        }
        
     } 
    public function deleteWishlist(Request $request, $id='')
     {
        $uid=$request->session()->get('FRONT_USER_ID');
        DB::table('wishlist')
        ->where(['id'=>$id, 'user_id'=>$uid])
        ->delete();
        return redirect('/user/wishlist');
     } 

    public function career()
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.career', $result);
    } 

    public function press()
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.press', $result);
    } 

    public function privacy_policy()
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.privacy_policy', $result);
    } 

    public function term_and_conditions()
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.term_and_conditions', $result);
    } 

    public function refund_and_return_policy()
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.refund_and_return_policy', $result);
    }             

    public function offers()
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['offer']=DB::table('offer')
        ->where(['status'=>1])
        ->limit(10)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.offers', $result);
    }

    public function offerDetail(Request $request, $slug)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['offerDetail']=DB::table('offer')
        ->where(['status'=>1])
        ->where(['slug'=>$slug])
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        // prx($result['commentCount']);
        return view('front.offerDetail', $result);
    }        

    public function faq()
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.faq', $result);
    }

   public function search(Request $request, $str)
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->where(['show_home'=>1])
        ->inRandomOrder()
        ->limit(8)
        ->get();

        // prx($str);
        $result['product']=
            $query=DB::table('products');
            // $query=$query->leftJoin('categories','categories.id','=','products.category_id');
            $query=$query->leftJoin('product_attributes','product_id','=','products.id');
            $query=$query->where(['products.status'=>1]);
            $query=$query->where('name','like',"%$str%");
            $query=$query->orwhere('brand','like',"%$str%");
            $query=$query->orwhere('short_desc','like',"%$str%");
            $query=$query->orwhere('desc','like',"%$str%");
            $query=$query->orwhere('keywords','like',"%$str%");
            $query=$query->orwhere('meta_title','like',"%$str%");
            $query=$query->orwhere('meta_desc','like',"%$str%");
            $query=$query->orwhere('slug','like',"%$str%");
            $query=$query->distinct()->select('product_attributes.product_id','products.name','products.slug','products.discount','product_attributes.image1','product_attributes.mrp','product_attributes.price');
            $query=$query->get();
            $result['product']=$query;
            $result['str']=$str;
            
            // foreach($result['product'] as $list1){
               
            //     $query1=DB::table('product_attributes');
            //     $query1=$query1->leftJoin('sizes','sizes.id','=','product_attributes.size_id');
            //     $query1=$query1->leftJoin('colors','colors.id','=','product_attributes.color_id');
            //     $query1=$query1->where(['product_attributes.products_id'=>$list1->id]);
            //     $query1=$query1->get();
            //     $result['product_attr'][$list1->id]=$query1;
            // }
        // return view('front.search',$result);

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.search', $result);
    }                

    public function subscribeNewsletter(Request $request)
    {
        // echo $request->post('newsletterEmail');
            $validation=valid_email($request->post('newsletterEmail'));
        if($validation=='not valid'){
            echo "not valid";
        }elseif($validation=='invalid email'){
            echo "invalid email";
        }else{
            $check=DB::table('newsletter')
            ->where(['email'=>$request->post('newsletterEmail')])
            ->get();
            // prx($check);
            if (isset($check[0])) {
                echo "subscibed";
            }
            else{
                date_default_timezone_set("Asia/Kolkata");
                $added_on=date('Y-m-d H:i:s');
                DB::table('newsletter')
                ->insert([
                'email'=>Str::of($request->post('newsletterEmail'))->lower(),
                'added_on'=>$added_on
                ]);
                echo "done";
            }
        }
    }

    public function contact_form(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $added_on=date('Y-m-d H:i:s');
        DB::table('contact')
        ->insert([
        'name'=>Str::of($request->post('contact_name'))->lower(),
        'email'=>Str::of($request->post('contact_email'))->lower(),
        'subject'=>Str::of($request->post('contact_subject'))->lower(),
        'message'=>Str::of($request->post('contact_message'))->lower(),
        'status'=>0,
        'added_on'=>$added_on
        ]);
        $request->session()->flash('contact_result', 'Query Submitted Successfully');
        return redirect('contact');
    }

    public function notifyme_submit(Request $request)
    {
        // prx($request->pid);
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $user_name=$request->session()->get('FRONT_USER_NAME');
        }else{
            $uid=getUserTempId();
            $user_name='guest';
        }
         date_default_timezone_set("Asia/Kolkata");
         $added_on=date('Y-m-d H:i:s');
         $outOfOrderPrev = DB::table('out_of_stock')
         ->where('pid', '=', $request->pid)
         ->where('user_id', '=', $uid)
         ->get();
         // prx($outOfOrderPrev);
         if(!isset($outOfOrderPrev[0])){
            DB::table('out_of_stock')
            ->insert([
                'pid'=>$request->pid,
                'user_id'=>$uid,
                'user_name'=>$user_name,
                'added_on'=>$added_on
            ]);
         }
    }

    public function all_categories()
    {
        $result['categories']=DB::table('categories')
        ->where(['status'=>1])
        ->inRandomOrder()
        ->get();

        $result['sub_categories']=DB::table('sub_categories')
        ->where(['status'=>1])
        ->inRandomOrder()
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();
        return view('front.all_categories', $result);        
    }

    public function setUserCookie(Request $request)
    {
        $preVisitors=DB::table('visitors')->get();
        // prx($preVisitors[0]->total_visits);
        $updateValue=(int)($preVisitors[0]->total_visits)+1;
        DB::table('visitors')
        ->update(['total_visits'=> $updateValue]);
    }

    public function send_reset_password_email(Request $request)
    {
       $fetch = $request->login;
       $is_user=DB::table('users')
       ->where('email', '=', $fetch)
       ->orWhere('mobile', '=', $fetch)
       ->get();
       // prx($is_user[0]->email);
        if (isset($is_user[0])) {
           $rand_id=rand(11111,99999);
           $data=['user_name'=>$is_user[0]->name,'token'=>Crypt::encrypt($is_user[0]->token)];
           $user['to']=$is_user[0]->email;
           Mail::send('front/email_verification',$data,function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('Grockart Account Reset Password');
            });
           echo "done";
        }else{
            echo "not";
        }
    }

    public function forgot_password(Request $request, $token)
    {
        $result['token'] = $token;
         $is_user=DB::table('users')
            ->where('token','=',$token)
            ->get();
            if(!isset($is_user[0])){
                return view('errors.404', $result);
            }else{
                return view('front.forgot_password', $result);
            }
    }

    public function updateUserPassword(Request $request)
    {
        $token = Crypt::decrypt($request->post('token'));
        // prx($token);
        $password = $request->post('password');
        $con_password = $request->post('confirmpassword');
        if($password===$con_password){
            $is_user=DB::table('users')
            ->where('token','=',$token)
            ->get();
            if(isset($is_user[0])){
                DB::table('users')
                ->where('token','=',$token)
                ->update(['password'=>Crypt::encrypt($password)]);
                $new_token=rand(111111111,999999999);
                DB::table('users')
                ->where('token','=',$token)
                ->update(['token'=>$new_token, 'email_status'=>'verified']);
            }
            die();
            echo "done";
        }else{
            echo "not match";
        }
    }

    public function getPincode(Request $request)
    {
        $pincode=$request->post('pincode');
        $data=file_get_contents('http://postalpincode.in/api/pincode/'.$pincode);
        $data=json_decode($data);
        // prx($data);
        if(isset($data->PostOffice['0'])){
            $city=Str::of($data->PostOffice['0']->District)->lower();
            $state=Str::of($data->PostOffice['0']->State)->lower();
            $deliverable_location=DB::table('deliverable_location')
            ->where('city','=',$city)
            ->get();
            if (isset($deliverable_location[0])) {
                if(!isset($_COOKIE['Location'])){
                    setcookie('Location',$city,time()+60*60*24*365);
                }
                return response()->json(['msg'=>'success', 'city'=>$city]);
            }else{
                return response()->json(['msg'=>'error', 'city'=>$city]);
            }
        }else{
                return response()->json(['msg'=>'invalid']);
        }
    }

    public function updatePincode(Request $request)
    {
        $pincode=$request->post('pincode');
        $data=file_get_contents('http://postalpincode.in/api/pincode/'.$pincode);
        $data=json_decode($data);
        // prx($data);
        if(isset($data->PostOffice['0'])){
            $city=Str::of($data->PostOffice['0']->District)->lower();
            $state=Str::of($data->PostOffice['0']->State)->lower();
            $deliverable_location=DB::table('deliverable_location')
            ->where('city','=',$city)
            ->get();
            if (isset($deliverable_location[0])) {
                if(isset($_COOKIE['Location'])){
                    setcookie('Location','',time()-60*60*24*365);
                    setcookie('Location',$city,time()+60*60*24*365);
                }else{
                    setcookie('Location',$city,time()+60*60*24*365);
                }
                return response()->json(['msg'=>'success', 'city'=>$city]);
            }else{
                return response()->json(['msg'=>'error', 'city'=>$city]);
            }
        }else{
                return response()->json(['msg'=>'invalid']);
        }
        
    }

}
