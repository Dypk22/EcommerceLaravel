<?php

namespace App\Http\Controllers\Front;
namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Paykun\Checkout\Payment;

class PaykunController extends Controller
{   
    protected $MerchantId;
    protected $AccessToken;
    protected $APIsecretKey;
    protected $LiveStatus;
    public $gateway;
  
    public function __construct()
    {
        $this->gateway = new Payment('867302054722361', '8AE637963AA726191EC0C1E073D86490', '550F4937F8085BC6DCC851983D0EEC36', false); // here we pass last parameter as false to enable sandbox mode.
    }

    /**
     * Method to generate paykun payment
     */
    public function pay() {

    	try {
 
                $this->gateway->setCustomFields(array('udf_1' => 'test')); //remove or comment this line when go live

 				$orderId=session()->get('ORDER_ID');
                $result['orderDetails']=DB::table('orders')
                ->where(['id' => $orderId])
                ->get();
                $amount=$result['orderDetails'][0]->total_price;
      // echo "<pre>"; print_r($result['orderDetails']); die();

	            if(session()->has('FRONT_USER_LOGIN')){
	                $uid=session()->get('FRONT_USER_ID');
	                $name=$result['orderDetails'][0]->user_name;
	                $result['userDetails']=DB::table('users')
	                ->where('id', '=', $uid)
	                ->get();
	                $email=$result['userDetails'][0]->email;
	            }else{
	                $name=$result['orderDetails'][0]->buyer_name;
	                $email='';
	            }
                $mobile=$result['orderDetails'][0]->buyer_number;
                
                $this->gateway->initOrder('ORD'.uniqid(), 'Enjoying Shopping', $amount, url('/payment-success'), url('/payment-fail'));
 
                // Add Customer
                $this->gateway->addCustomer($name, $email, $mobile);
 
                // Add Shipping address
                $this->gateway->addShippingAddress('', '', '', '', '');
 
                // Add Billing Address
                $this->gateway->addBillingAddress('', '', '', '', '');
 
                echo $this->gateway->submit();
            }
            catch(Exception $e) {
                return $e->getMessage();
            }
    }

    public function AddMoney(Request $request, $amount) {
    	// echo $amount;
    	try {
 
                $this->gateway->setCustomFields(array('udf_1' => 'test')); //remove or comment this line when go live

 				$orderId=rand(11111,99999)."GAM".rand(11111,99999);

                $uid=session()->get('FRONT_USER_ID');
                $name=session()->get('FRONT_USER_NAME');
                $email=session()->get('FRONT_USER_EMAIL');
                $mobile=session()->get('FRONT_USER_NUMBER');
                
                $this->gateway->initOrder('ORD'.uniqid(), 'Add Money', $amount, url('/add-money-success'), url('/add-money-fail'));
 
                // Add Customer
                $this->gateway->addCustomer($name, $email, $mobile);
 
                // Add Shipping address
                $this->gateway->addShippingAddress('', '', '', '', '');
 
                // Add Billing Address
                $this->gateway->addBillingAddress('', '', '', '', '');
 
                echo $this->gateway->submit();
            }
            catch(Exception $e) {
                return $e->getMessage();
            }
    }

    /**
     * After the successfull payment redirect here
     */

    public function success(Request $request)
    {
        if ($request->input('payment-id'))
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
            $result['orderDetails']=DB::table('orders')
            ->where(['id' => $orderId])
            ->get();


            if(session()->has('FRONT_USER_LOGIN')){
                $uid=session()->get('FRONT_USER_ID');
                $result['user_Details']=DB::table('users')
                ->where(['id' => $uid])
                ->get();
                $result['name']=$result['user_Details'][0]->name;
                $result['email']=$result['user_Details'][0]->email;
            }else{
                $uid='000';
                $result['name']='';
                $result['email']='';
            }

            if (!isset($result['orderDetails'][0])) {
                return redirect('/user/orders');
            }
            // $uid=$result['orderDetails'][0]->user_id;
            $user_type=$result['orderDetails'][0]->user_type;
            // $result['email']=$result['orderDetails'][0]->buyer_email;
            // $result['name']=$result['orderDetails'][0]->buyer_name;
            // prx($orderId); die();
            $result['prevOrder']=DB::table('orders')
            ->where(['id'=>$orderId])
            ->get();
            // prx($result['prevOrder'][0]->discount);
            $result['couponType']=DB::table('coupons')
            ->where(['id'=>$result['prevOrder'][0]->coupon_id])
            ->get();
            // prx($result['prevOrder'][0]->coupon_code);
            if(isset($result['couponType'][0])){
                $coupon_type=$result['couponType'][0]->type3;
                $couponDiscount=$result['prevOrder'][0]->discount;
                $couponCode=$result['prevOrder'][0]->coupon_code;
            }else{
                $coupon_type='none';
                $couponDiscount=0;
                $couponCode='';
            }

            $transactionData = $this->gateway->getTransactionInfo($request->input('payment-id'));
			$result['status'] = $transactionData['status']; 
			$result['orderId'] = $orderId; 
			$result['payment_id'] = $transactionData['data']['transaction']['payment_id']; 
			$result['payment_mode'] = $transactionData['data']['transaction']['payment_mode']; 
			$result['transaction_status'] = $transactionData['data']['transaction']['status'];

            DB::table('orders')
            ->where(['id'=>$orderId])
            ->update(['payment_status'=>'success','order_status'=>1,'payment_id'=>$result['payment_id']]);

            $result['payment_method']=$result['orderDetails'][0]->payment_method;
	        // $result['name']=$result['user_Details'][0]->name;
	        // $result['email']=$result['user_Details'][0]->email;
	        $result['orderAmount']=$result['orderDetails'][0]->total_price;
	        $result['delivery_time']=$result['orderDetails'][0]->delivery_time;
	        $result['delivery_date']=$result['orderDetails'][0]->delivery_date;
	        $result['address1']=$result['orderDetails'][0]->address1;
	        $result['address2']=$result['orderDetails'][0]->address2;
	        $result['city']=$result['orderDetails'][0]->city;
	        $result['state']=$result['orderDetails'][0]->state;
	        $result['pin_code']=$result['orderDetails'][0]->pin_code;
	        $result['txnid']=$result['orderDetails'][0]->txnid;

			// prx($result['orderDetails']);
            // DB::table('carts')->where(['user_id'=>$uid,'user_type'=>'registered'])->delete();

            if(session()->has('FRONT_USER_LOGIN')){
                date_default_timezone_set("Asia/Kolkata");
                $added_on=date('Y-m-d H:i:s');
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
                
                if ($coupon_type=='cashback') {
                    $result['demo112']=DB::table('wallet')
                    ->where(['user_id'=>$cuid])
                    // ->where(['user_name'=>$cname])
                    ->orderBy('id', 'desc')->first();
                    // prx($result['demo112']->updated_cashback);
                    // prx($result['demo112']->updated_cashback+$couponDiscount);
                    DB::table('wallet')
                    ->insert([
                    'type'=>'cashback-received',
                    'user_id'=>$cuid,
                    'amount'=>$couponDiscount,
                    'payment_id'=>$transactionData['data']['transaction']['payment_id'],
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
                    ->update(['wallet'=>$result['demo112']->updated_cashback+$couponDiscount]);
                }
            }
            $request->session()->forget('ORDER_ID');
            DB::table('carts')->where(['user_id'=>$uid,'user_type'=>'registered'])->delete();
	        
            return view('front.orderConfirm', $result);

        }
    }

    public function add_money_success(Request $request)
	{
		if ($request->input('payment-id'))
        {
            $transactionData = $this->gateway->getTransactionInfo($request->input('payment-id'));
	    	if ($transactionData['status']==1) {
				$coupon_name='';
				$coupon_value=0;
				$coupon_discount=0;
				if(session()->has('COUPON_NAME')){
					$coupon_name = $request->session()->get('COUPON_NAME');
					// $coupon_value = $request->session()->get('COUPON_VALUE');
					$coupon_discount = $request->session()->get('COUPON_DISCOUNT');
				}
				date_default_timezone_set("Asia/Kolkata");
	            $added_on=date('Y-m-d H:i:s');
				$uid=session()->get('FRONT_USER_ID');
                $name=session()->get('FRONT_USER_NAME');
                $email=session()->get('FRONT_USER_EMAIL');
                $mobile=session()->get('FRONT_USER_NUMBER');

                $result['prev_cb']=DB::table('wallet')
                ->where(['user_id'=>$uid])
                // ->where(['user_name'=>$name])
	            ->orderBy('id','desc')
                ->first();
                // prx($result['prev_cb']);
                $prev_balance=$result['prev_cb']->updated_balance;
				$updated_balance=$prev_balance+$transactionData['data']['transaction']['order']['gross_amount'];
                
                $prev_cb=$result['prev_cb']->updated_cashback;
				$updated_cashback=$prev_cb+$coupon_discount;
				// prx($updated_balance+$updated_cashback);
                DB::table('wallet')
	            ->insert([
	            'type'=>'money-add-success',
	            'user_id'=>$uid,
	            'coupon_id'=>'',
	            'coupon_code'=>$coupon_name,
	            'amount'=>$transactionData['data']['transaction']['order']['gross_amount'],
	            'added_on'=>$added_on,
	            'payment_id'=>$transactionData['data']['transaction']['payment_id'],
	            'status'=>$transactionData['data']['transaction']['status'],
	            'updated_balance'=>$updated_balance,
	            'amount'=>$transactionData['data']['transaction']['order']['gross_amount'],
	            'status'=>$transactionData['data']['transaction']['status'],
	            'cashback'=>$coupon_discount,
	            'updated_cashback'=>$updated_cashback,
	            'added_on'=>$added_on,
	            ]); 

	            DB::table('users')
	            ->where(['id'=>$uid])
                // ->where(['name'=>$name])
	            ->update(['wallet'=>$updated_balance+$updated_cashback]);

	            session()->forget('COUPON_NAME');
	            // session()->forget('COUPON_VALUE');
	            session()->forget('COUPON_DISCOUNT');
	            return redirect('/user/wallet');
			}
	    }
	}
    /**
     * After the payment fail redirect here
     */
        public function fail(Request $request)
    { 
        if ($request->input('payment-id'))
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
            $result['orderDetails']=DB::table('orders')
            ->where(['id' => $orderId])
            ->get();

	        $uid=$result['orderDetails'][0]->user_id;
	        $user_type=$result['orderDetails'][0]->user_type;
	        $result['email']=$result['orderDetails'][0]->buyer_email;
	        $result['name']=$result['orderDetails'][0]->buyer_name;

            $transactionData = $this->gateway->getTransactionInfo($request->input('payment-id'));
			$result['status'] = $transactionData['status']; 
			$result['orderId'] = $orderId; 
			$result['payment_id'] = $transactionData['data']['transaction']['payment_id']; 
			$result['payment_mode'] = $transactionData['data']['transaction']['payment_mode']; 
			$result['transaction_status'] = $transactionData['data']['transaction']['status'];
	        $result['txnid']=$result['orderDetails'][0]->txnid;

            DB::table('orders')
            ->where(['id'=>$orderId])
            ->update(['payment_status'=>'fail','order_status'=>4,'payment_id'=>$result['payment_id']]);
 

            $result['payment_method']=$result['orderDetails'][0]->payment_method;
	        // $result['name']=$result['user_Details'][0]->name;
	        // $result['email']=$result['user_Details'][0]->email;
	        $result['orderAmount']=$result['orderDetails'][0]->total_price;

            DB::table('carts')->where(['user_id'=>$uid,'user_type'=>$user_type])->delete();

	        return view('front.orderConfirm', $result);
	    }
    }

    public function add_money_fail(Request $request)
    {
    	$transactionData = $this->gateway->getTransactionInfo($request->input('payment-id'));
    	if ($transactionData['status']==1) {
			$coupon_name='';
			$coupon_value=0;
			$coupon_discount=0;
			if(session()->has('COUPON_NAME')){
				$coupon_name = $request->session()->get('COUPON_NAME');
				$coupon_value = $request->session()->get('COUPON_VALUE');
				$coupon_discount = $request->session()->get('COUPON_DISCOUNT');
			}
			date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');
			$uid=session()->get('FRONT_USER_ID');
            $name=session()->get('FRONT_USER_NAME');
            $email=session()->get('FRONT_USER_EMAIL');
            $mobile=session()->get('FRONT_USER_NUMBER');

            $result['prev_cb']=DB::table('wallet')
            ->where(['user_id'=>$uid])
            // ->where(['user_name'=>$name])
            ->orderBy('id','desc')
            ->first();
            $prev_balance=$result['prev_cb']->updated_balance;
			$updated_balance=$prev_balance;//+$transactionData['data']['transaction']['order']['gross_amount'];
            
            $prev_cb=$result['prev_cb']->updated_cashback;
			$updated_cashback=$prev_cb;//+$coupon_discount;
			// prx($prev_cb);/
            DB::table('wallet')
            ->insert([
            'type'=>'money-add-fail',
            'user_id'=>$uid,
            'coupon_id'=>'',
            'coupon_code'=>$coupon_name,
            'amount'=>$transactionData['data']['transaction']['order']['gross_amount'],
            'added_on'=>$added_on,
            'payment_id'=>$transactionData['data']['transaction']['payment_id'],
            'status'=>$transactionData['data']['transaction']['status'],
            'updated_balance'=>$updated_balance,
            'amount'=>$transactionData['data']['transaction']['order']['gross_amount'],
            'status'=>$transactionData['data']['transaction']['status'],
            'cashback'=>$coupon_discount,
            'updated_cashback'=>$updated_cashback,
            'added_on'=>$added_on,
            ]); 

            DB::table('users')
            ->where(['id'=>$uid])
            // ->where(['name'=>$name])
            ->update(['wallet'=>$updated_balance+$updated_cashback]);

            session()->forget('COUPON_NAME');
            session()->forget('COUPON_VALUE');
            session()->forget('COUPON_DISCOUNT');
            return redirect('/user/wallet');
		}
	}    
}
