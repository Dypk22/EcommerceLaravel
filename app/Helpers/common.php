<?php
use Illuminate\Support\Facades\DB;

function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}

function getUserTempId(){

	if (session()->has('USER_TEMP_ID')) {
		return session()->get('USER_TEMP_ID');
	}else{
		$rand=rand(111111111,999999999);
		session()->put('USER_TEMP_ID',$rand);
		return $rand;
	}
}


function getAddToCartTotalItem(){
	if(session()->has('FRONT_USER_LOGIN')){
		$uid=session()->get('FRONT_USER_ID');
		$user_type="Registered";
	}else{
		$uid=getUserTempId();
		$user_type="Unregistered";
	}
	$result['cart_items']=DB::table('carts')
    ->leftJoin('products','products.id','=','carts.product_id')
    ->leftJoin('product_attributes','product_attributes.product_id','=','carts.product_id')
    ->where(['user_id'=>$uid])
    ->where(['user_type'=>$user_type])
    ->select('carts.qty','products.name','products.discount','product_attributes.image1','product_attributes.weight', 'product_attributes.mrp', 'product_attributes.price','products.slug','products.id as pid','product_attributes.id as attribute_id')
    // ->select('cart.qty','products.name','product_attributes.image1','product_attributes.price','products.slug','products.id as pid','product_attributes.id as attribute_id')
    ->get();
	return $result['cart_items'];
   
}

function SoldQty($product_id)
{
    $result=DB::table('order_detail')
    ->leftJoin('orders', 'orders.id','=','order_detail.order_id')
    ->where('orders.order_status','!=','4')
    ->where('orders.order_status','!=','0')
    ->where(['order_detail.product_id'=>$product_id])
    ->sum('order_detail.qty');
    return $result;    
}

function AvaliableQty($product_id){
	$result=DB::table('product_attributes')
    ->where(['product_attributes.product_id'=>$product_id])
    ->select('product_attributes.quantity')
    ->get();
	return $result[0]->quantity;
}

function checkWishlistItem($uid)
{
	$result['wishlist']=DB::table('wishlist')
    // ->where(['product_id'=>$product_id])
    ->where(['user_id'=>$uid])
    ->get();
    // prx($result['wishlist']);
	return $result['wishlist'];
}

function checkWishlist($product_id, $uid){
	$result['wishlist']=DB::table('wishlist')
    ->where(['product_id'=>$product_id])
    ->where(['user_id'=>$uid])
    ->get();
    // prx($result['wishlist']);
	return $result['wishlist'];
}

function send_mobile_sms($msg, $mobile_number)
{
    //8882959139=jDM9oN2kwG476zqPutHYR5QyKeFALshCXJx8f0VIpiU3vOdWZTJOFCKL3ZVlw4byoNuse2zWtfMmApD6
    //8470083628=gijhTkwxu7zZBaR4HodQrEVebqm1JK23vc96NSnAWUlpC5FOLfiu2kMUgFsCh3EJWyrpjQoRxlPD64V5
	// echo "done";
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=jDM9oN2kwG476zqPutHYR5QyKeFALshCXJx8f0VIpiU3vOdWZTJOFCKL3ZVlw4byoNuse2zWtfMmApD6&message=".urlencode($msg)."&language=english&route=v3&numbers=".urlencode($mobile_number),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    }
     else {
      echo "done";
    }
}

function valid_email($email) 
{
    if(is_array($email) || is_numeric($email) || is_bool($email) || is_float($email) || is_file($email) || is_dir($email) || is_int($email))
        return "not valid";
    else
    {
        $email=trim(strtolower($email));
        if(filter_var($email, FILTER_VALIDATE_EMAIL)!==false) return $email;
        else
        {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            return (preg_match($pattern, $email) === 1) ? $email : "invalid email";
        }
    }
}

$delete_query_duplicate_rows='delete from  carts where id not in(select max(id) from carts GROUP by product_id)';
$delete_query_duplicate_rows_wishlist='delete from  wishlist where id not in(select max(id) from wishlist GROUP by product_id)';
$con=mysqli_connect('localhost','root','','ecom');
mysqli_query($con, $delete_query_duplicate_rows);
mysqli_query($con, $delete_query_duplicate_rows_wishlist);
mysqli_query($con,"delete from  carts where qty = 0");

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);
date_default_timezone_set("Asia/Kolkata");
$added_on=date('Y-m-d H:i:s');
/*
if($result->status=='success'){
    
    if(isset($result->lat) && isset($result->lon)){
    
        $query=" select * from visitor_details where `country`='$result->country' and  `country_code`='$result->countryCode' and `region`='$result->region' and `region_name`='$result->regionName' and `city`='$result->city' and `zip`='$result->zip' and `lat`='$result->lat' and `long`='$result->lon' and `timezone`='$result->timezone' and `isp`='$result->isp' and `org`='$result->org' and `ip`='$result->query' ";

        $insert_query=" insert into visitor_details (`country`, `country_code`, `region`, `region_name`, `city`, `zip`, `lat`, `long`, `timezone`, `isp`, `org`, `ip`,`added_on`) VALUES ('$result->country','$result->countryCode','$result->region','$result->regionName','$result->city','$result->zip','$result->lat','$result->lon','$result->timezone','$result->isp','$result->org','$result->query','$added_on') ";
        $select_query=mysqli_query($con,$query);
        $select_query_records = mysqli_num_rows($select_query);
        
        if ($select_query_records==0) {
            mysqli_query($con,$insert_query);
        }
        // else{
        //     mysqli_query($con,$insert_query);
        // }

    }else{

        $query=" select * from visitor_details where `country`='$result->country' and  `country_code`='$result->countryCode' and `region`='$result->region' and `region_name`='$result->regionName' and `city`='$result->city' and `zip`='$result->zip' and `timezone`='$result->timezone' and `isp`='$result->isp' and `org`='$result->org' and `ip`='$result->query' ";

        $insert_query=" insert into visitor_details (`country`, `country_code`, `region`, `region_name`, `city`, `zip`, `lat`, `long`, `timezone`, `isp`, `org`, `ip`, `added_on`) VALUES ('$result->country','$result->countryCode','$result->region','$result->regionName','$result->city','$result->zip','none','$result->timezone','$result->isp','$result->org','$result->query','$added_on') ";
        $select_query=mysqli_query($con,$query);
        $select_query_records = mysqli_num_rows($select_query);
        
        if ($select_query_records==0) {
            mysqli_query($con,$insert_query);
        }
        // if ($select_query_records>0) {
            
        // }else{
        //     mysqli_query($con,$insert_query);
        // }

    }   
}
*/

?>