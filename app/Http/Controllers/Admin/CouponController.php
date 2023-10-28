<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']=Coupon::all();
        return view('admin/coupon', $result);
    }

    public function manage_coupon(Request $request, $id='')
    {
        // echo "string";

        if ($id>0) {
            $arr=Coupon::where(['id'=> $id])->get();

            $result['coupon_name']=$arr['0']->code;
            $result['coupon_type_1']=$arr['0']->type1;
            $result['coupon_type_2']=$arr['0']->type2;
            $result['coupon_status']=$arr['0']->status;            
            $result['coupon_value']=$arr['0']->value;            
            $result['min_cart_value']=$arr['0']->min_cart_value;            
            $result['max_discount']=$arr['0']->max_discount;            
            $result['coupon_id']=$arr['0']->id;            

        }else{
            $result['coupon_name']='';
            $result['coupon_type_1']='';
            $result['coupon_type_2']='';
            $result['coupon_status']='';            
            $result['coupon_value']='';            
            $result['min_cart_value']='';            
            $result['max_discount']='';            
            $result['coupon_id']=0;
        }
        return view('admin/manage-coupon', $result);
        // echo "<pre>";
        // echo print_r($result['data']);
        // die();
    }

    public function manage_coupon_process(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
        ]);

        if ($request->post('id')>0) {
            $model=Coupon::find($request->post('id'));      
            $msg='Coupon Updated';      
        }
        else{
            $model=new Coupon();            
            $msg='Coupon Inserted';      
        }
        $model->code=$request->post('code');
        $model->status=$request->post('coupon_status');
        $model->type1=$request->post('coupon_type_1');
        $model->type2=$request->post('coupon_type_2');
        $model->value=$request->post('coupon_value');
        $model->min_cart_value=$request->post('min_cart_value');
        $model->max_discount=$request->post('max_coupon_discount');
        date_default_timezone_set("Asia/Kolkata");
        $added_on=date('Y-m-d H:i:s');  
        $model->updated_at=$added_on;
        $model->save();
        $request->session()->flash('messsage', $msg);
        return redirect('admin/coupon');
    }   

    public function delete(Request $request, $id)
    {
        // echo "string";
        // echo $id;
        // return view('admin/manage-category');
        $model=Coupon::find($id);
        $model->delete();
        $request->session()->flash('messsage', 'Coupon Deleted');
        return redirect('admin/coupon');

    }

    public function active(Request $request, $id)
    {   
        // echo $id;
        if ($id>0) {
            $res = Coupon::find($id);
            $res->status=1;
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');            
            $res->save();
            $msg='Status Updated';      
        }
        else{
            $msg='Invalid Request';      
        }

        $request->session()->flash('messsage', $msg);
        return redirect('admin/coupon');        
    }    

    public function deactive(Request $request, $id)
    {   
        // echo $id;
        if ($id>0) {
            $res = Coupon::find($id);
            $res->status=0;
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');
            $res->save();
            $msg='Status Updated';      
        }
        else{
            $msg='Invalid Request';      
        }

        $request->session()->flash('messsage', $msg);
        return redirect('admin/coupon');        
    }        


}
