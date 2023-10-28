<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Crypt;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( $request->session()->has('ADMIN_LOGIN')) {
            return redirect('admin/dashboard');
        }
        // else{
        //     $request->session()->flash('error', 'Access Denied - Login To Continue');
        //     return view('admin.login');
        //     // return redirect('admin');
        // }
        return view('admin.login');
    }

    public function auth(Request $request)
    {
        // return $request->post();
        // return $request->input();
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email, 'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();
        DB::table('admins')->where(['email'=>$email,'password'=>$password])->update(['password'=> Crypt::encrypt($password)]);
        if ($result!=null) {
            // if (Hash::check($request->post('password'), $result->password)) {
            $admin_password=Crypt::decrypt($result->password);
            if ($request->post('password')===$admin_password) {
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_NAME', $result->name);
                $request->session()->flash('ADMIN_ID', $result->id);
                return redirect('admin/dashboard');
            }
            else{
                $request->session()->flash('error', 'password Not Matched');
                return redirect('admin');            
            }
        }
        else{
            $request->session()->flash('error', 'Email Not Found');
            return redirect('admin');            
        }

    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function category(Request $request)
    {
        $result['categories']=DB::table('categories')->get();
        return view('admin/category', $result);
     }

    public function updateCategoryStatus(Request $request)
    {
        $slug=$request->slug;
        $status=$request->status;
        DB::table('categories')
        ->where('category_slug','=',$slug)
        ->update(['status'=>$status]);
        echo "done";
    }

    public function updateCatShowHomeStats(Request $request)
    {
        $slug=$request->slug;
        $status=$request->status;
        DB::table('categories')
        ->where('category_slug','=',$slug)
        ->update(['show_home'=>$status]);
        echo "done";
    }

    public function delete(Request $request,$id){
        DB::table('categories')
        ->where('id','=',$id)
        ->delete();
        $request->session()->flash('message','Category deleted');
        return redirect('admin/category');
    }

    public function manage_category(Request $request,$slug='')
    {
        if($slug!=''){
            $arr=DB::table('categories')
            ->where(['category_slug'=>$slug])
            ->get(); 

            $result['category_name']=$arr['0']->category_name;
            $result['category_slug']=$arr['0']->category_slug;
            $result['category_status']=$arr['0']->status;
            $result['show_home']=$arr['0']->show_home;
            $result['id']=$arr['0']->id;

            $result['exceptCategory']=DB::table('categories')->where(['status'=>1])->where('category_slug','!=',$slug)->get();
        }else{
            $result['category_name']='';
            $result['category_slug']='';
            $result['show_home']=0;
            $result['id']=0;

            $result['exceptCategory']=DB::table('categories')->where(['status'=>1])->get();
            
        }
        return view('admin/manage_category',$result);
    }

    public function manage_category_process(Request $request)
    {
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id'),   
        ]);
        date_default_timezone_set("Asia/Kolkata");
        $current_time=date('Y-m-d H:i:s');
        if($request->post('id')>0){
            $model=DB::table('categories')
            ->where(['id'=>$request->post('id')])
            ->update(['category_name'=>$request->post('category_name'),
                'category_slug'=>$request->post('category_slug'),
                'status'=>$request->post('status'),
                'show_home'=>$request->post('show_home'),
                'updated_at'=>$current_time
            ]);
            $msg="Category updated";
        }else{
            $model=DB::table('categories')
            ->where(['id'=>$request->post('id')])
            ->insert(['category_name'=>Str::of($request->post('category_name'))->lower(),
                'category_slug'=>Str::of($request->post('category_slug'))->lower(),
                'status'=>$request->post('status'),
                'show_home'=>$request->post('show_home'),
                'created_at'=>$current_time,
                'updated_at'=>$current_time
            ]);
            $msg="Category inserted";
        }

        $request->session()->flash('message',$msg);
        return redirect('admin/category');        
    }

    public function sub_category(Request $request)
    {
        $result['sub_categories']=DB::table('sub_categories')->get();
        return view('admin/sub-category', $result);
     }    

    public function updateSubCatStats(Request $request)
    {
        $slug=$request->slug;
        $status=$request->status;
        DB::table('sub_categories')
        ->where('subcategory_slug','=',$slug)
        ->update(['status'=>$status]);
        echo "done";
    }

    public function manage_sub_category(Request $request,$slug='')
    {
        // echo $slug;
        // die();
        if($slug!=''){
            $arr=DB::table('sub_categories')
            ->where(['subcategory_slug'=>$slug])
            ->get();

            $result['subcategory_name']=$arr['0']->subcategory_name;
            $result['category_name']=$arr['0']->category_name;
            $result['subcategory_slug']=$arr['0']->subcategory_slug;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;

            $result['exceptCategory']=DB::table('categories')->where(['status'=>1])->where('category_name','!=',$arr['0']->category_name)->get();
        }else{
            $result['subcategory_name']='';
            $result['category_name']='';
            $result['subcategory_slug']='';
            $result['status']=0;
            $result['id']=0;

            $result['exceptCategory']=DB::table('categories')->where(['status'=>1])->get();
            
        }
        return view('admin/manage_sub_category',$result);
    }

    public function manage_sub_category_process(Request $request)
    {
        // return $request->post();
        $request->validate([
            'subcategory_slug'=>'required|unique:sub_categories,subcategory_slug',   
        ]);
        date_default_timezone_set("Asia/Kolkata");
        $current_time=date('Y-m-d H:i:s');
        if($request->post('id')>0){
            $model=DB::table('sub_categories')
            ->where(['id'=>$request->post('id')])
            ->update(['subcategory_name'=>$request->post('subcategory_name'),
                'subcategory_slug'=>$request->post('subcategory_slug'),
                'status'=>$request->post('status'),
                'category_name'=>$request->post('category_name'),
                'updated_at'=>$current_time
            ]);
            $msg="Sub Category updated";
        }else{
            $model=DB::table('sub_categories')
            ->where(['id'=>$request->post('id')])
            ->insert(['subcategory_name'=>Str::of($request->post('subcategory_name'))->lower(),
                'subcategory_slug'=>Str::of($request->post('subcategory_slug'))->lower(),
                'status'=>$request->post('status'),
                'category_name'=>Str::of($request->post('category_name'))->lower(),
                'created_at'=>$current_time,
                'updated_at'=>$current_time
            ]);
            $msg="Sub Category inserted";
        }

        $request->session()->flash('message',$msg);
        return redirect('admin/sub-category');        
    }

    public function subcategory_delete(Request $request,$id){
        DB::table('sub_categories')
        ->where('id','=',$id)
        ->delete();
        $request->session()->flash('message','Sub Category deleted');
        return redirect('admin/sub-category');
    }

    public function orders(Request $request)
    {
        $result['orders'] = DB::table('orders')
        ->leftjoin('order_status','order_status.id', '=', 'orders.order_status')
        ->select('orders.*','order_status.name as order_status')
        ->get();
        
        return view('admin/orders', $result);
    }

     public function order_detail(Request $request,$id)
    {
        $result['order_details'] = DB::table('orders')
        ->leftjoin('order_status','order_status.id', '=', 'orders.order_status')
        ->select('orders.*','order_status.name as order_status','order_status.id as order_status_id')
        ->where(['orders.id'=>$id])
        ->get();
                
        $result['order_details_particulars'] = DB::table('order_detail')
        ->leftjoin('products','products.id', '=', 'order_detail.product_id')
        ->where(['order_id'=>$id])
        ->select('order_detail.*','products.name','products.slug')
        ->get();

        $result['my_details']=DB::table('my_details')
        ->get();

        $result['orderStats']=DB::table('order_status')
        ->where('order_status.id','!=',$result['order_details'][0]->order_status_id)
        ->get();
                
        // echo "<pre>";
        // print_r($result['order_details'][0]->order_status_id);
        // die();     
        return view('admin.orderDetail',$result);
    }

    public function update_OrderStats(Request $request)
    {
        DB::table('orders')
        ->where('id','=',$request->post('OrderId'))
        ->update(['order_status'=>$request->post('order_status')]);
        return redirect(url()->previous());
    }

        public function order_user_detail(Request $request,$id)
    {
        $result['orders']=DB::table('orders')
        ->select('orders.*','order_status.name as order_status')
        ->leftJoin('order_status','order_status.id','=','orders.order_status')
        ->where(['orders.id'=>$id])
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
        if(!isset($result['orders_details'][0])){
            return redirect('/');
        }
        // prx($result);
        // die();
        // $ordertotalItem=count($result['orders_details']);
         // return response()->json(['data'=>$result]);
        return view('admin.invoice',$result);
    }

    public function allProducts()
    {
        $result['products']=DB::table('products')
        ->join('categories','categories.id','=','products.cat_id')
        ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
        ->join('sub_categories','sub_categories.id','=','products.sub_cat_id')
        ->select('products.*','products.name','products.slug','products.status','categories.category_name','sub_categories.subcategory_name','product_attributes.image1','product_attributes.created_at')
        ->get();
        // echo "<pre>";
        // print_r($result['products']);
        // die();
        return view('admin.products', $result);     
    }

    public function updateProductStats(Request $request)
    {
        $slug=$request->slug;
        $status=$request->status;
        DB::table('products')
        ->where('slug','=',$slug)
        ->update(['status'=>$status]);
        echo "done";
    }

    public function manage_product(Request $request, $id='')
    {
        // echo $id;die();
        if ($id!='') {
            $arr=DB::table('products')
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->where(['products.slug'=> $id])
            ->get();

            $result['product_id']=$arr['0']->product_id;            
            $result['name'] = $arr['0']->name;
            $result['cat_id'] = $arr['0']->cat_id;
            $result['sub_cat_id'] = $arr['0']->sub_cat_id;
            $result['image1'] = $arr['0']->image1;
            $result['image2'] = $arr['0']->image2;
            $result['image3'] = $arr['0']->image3;
            $result['image4'] = $arr['0']->image4;
            $result['status'] = $arr['0']->status;
            $result['slug'] = $arr['0']->slug;
            $result['discount'] = $arr['0']->discount;
            $result['brand'] = $arr['0']->brand;
            $result['short_desc'] = $arr['0']->short_desc;
            $result['desc'] = $arr['0']->desc;
            $result['rating'] = $arr['0']->rating;
            $result['keywords'] = $arr['0']->keywords;
            $result['meta_title'] = $arr['0']->meta_title;
            $result['meta_desc'] = $arr['0']->meta_desc;
            $result['weight'] = $arr['0']->weight;
            $result['mrp'] = $arr['0']->mrp;
            $result['show_home'] = $arr['0']->show_home;
            $result['featured'] = $arr['0']->featured;
            $result['discounted'] = $arr['0']->discounted;
            $result['best_seller'] = $arr['0']->best_seller;
            $result['price'] = $arr['0']->price;
            $result['quantity'] = $arr['0']->quantity;
            $result['id']=$arr['0']->product_id;
            $result['created_at'] = $arr['0']->created_at;
            $result['updated_at'] = $arr['0']->updated_at;
            $result['selected_category']=DB::table('categories')->where('id','=',$arr['0']->cat_id)->get();
            $result['selected_sub_category']=DB::table('sub_categories')->where('id','=',$arr['0']->sub_cat_id)->get();

        }else{
            $result['name'] = '';
            $result['cat_id'] = 0;
            $result['sub_cat_id'] = 0;
            $result['image1'] = '';
            $result['image2'] = '';
            $result['image3'] = '';
            $result['product_id']= 0;//$arr['0']->id;            
            $result['image4'] = '';
            $result['discount'] = 0;//$arr['0']->discount;
            $result['status'] = 0;
            $result['slug'] = '';
            $result['brand'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['show_home'] = 0;//$arr['0']->show_home;
            $result['rating'] = 0;
            $result['keywords'] = '';
            $result['meta_title'] = '';
            $result['meta_desc'] = '';
            $result['weight'] = '';                        
            $result['created_at'] = 0;//$arr['0']->created_at;
            $result['updated_at'] = 0;//$arr['0']->created_at;
            $result['quantity'] = 0;//$arr['0']->quantity;
            $result['product_id']=0;           
            $result['featured'] = 0;//$arr['0']->featured;
            $result['discounted'] = 0;//$arr['0']->discounted;
            $result['best_seller'] = 0;//$arr['0']->best_seller;
            $result['mrp'] = 0;//$arr['0']->mrp;
            $result['price'] = 0;//$arr['0']->price; 
            $result['selected_category']=0;
            $result['selected_sub_category']=0;
            $result['id']=0;
        }
        // echo "<pre>"; print_r($result['selected_category']);die();
        if (isset($result['selected_category'][0])) {
            $result['Allcategory']=DB::table('categories')->where('id','!=', $arr['0']->cat_id)->get();            
        }else{
            $result['Allcategory']=DB::table('categories')->where('status','=',1)->get();            
        }
        if (isset($result['selected_sub_category'][0])) {
            $result['Allsubcategory']=DB::table('sub_categories')->where('id','!=', $arr['0']->sub_cat_id)->get();            
        }else{
            $result['Allsubcategory']=DB::table('sub_categories')->where('status','=',1)->get();            
        }        
        // $result['product_sub_category_data']=DB::table('sub_categories')->get();
        // $result['product_sub_category_name']=SubCategory::where(['id'=>$id])->get();
        // echo "<pre>"; print_r($result['Allsubcategory']);die();
        // $result['product_sub_category_name']=DB::table('sub_categories')->where(['id'=>$id]);
        return view('admin/manage_product', $result);

    }

    public function manage_product_process(Request $request)
    {   
        // return $request->post('id');
        // echo "<pre>";
        // print_r($_POST);
        // die();
        // $request->validate([
        //     'Product_name' => 'required|unique:sub_categories',
        //     'Product_slug' => 'required|unique:sub_categories,Product_slug,'.$request->post('id'),
        // ]); 

        // prx($request->file('product_image1')->getClientOriginalName());
        // if($request->hasfile('product_image1')){
        //     $image_name=$request->file('product_image1')->getClientOriginalName();
        //     $request->file('product_image1')->storeas('ProductsImage');
        //     // $image1=$request->file('product_image1');
        //     // $ext=$image1->extension();
        //     // $image_name=time().'.'.$ext;
        //     // $image1->storeas('ProductsImage',$image_name);
        //     // $request->file('product_image1')->storeas('ProductsImage');
        //     // $AddProduct->image1=$image_name;
        // }  

        // echo $request->file('product_image1')->storeas('ProductsImage');

             $image=DB::table('product_attributes')
            ->where(['product_id'=> $request->post('id')])
            ->select('image1','image2','image3','image4')
            ->get();
        $price=$request->post('price');
        $mrp=$request->post('mrp');
        $product_discount=ceil((($mrp-$price)/$mrp)*100);
            // prx($request->post());
        if ($request->post('id')>0) {
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');              
            $productimage1=$image[0]->image1;
            $productimage2=$image[0]->image2;
            $productimage3=$image[0]->image3;
            $productimage4=$image[0]->image4;
            if($request->hasfile('product_image1')){
                $productimage1=$request->file('product_image1')->getClientOriginalName();
                $request->file('product_image1')->storeas('public/ProductsImage',$productimage1);
            }
            if($request->hasfile('product_image2')){
                $productimage2=$request->file('product_image2')->getClientOriginalName();
                $request->file('product_image2')->storeas('public/ProductsImage',$productimage2);
            }
            if($request->hasfile('product_image3')){
                $productimage3=$request->file('product_image3')->getClientOriginalName();
                $request->file('product_image3')->storeas('public/ProductsImage',$productimage3);
            }
            if($request->hasfile('product_image4')){
                $productimage4=$request->file('product_image4')->getClientOriginalName();
                $request->file('product_image4')->storeas('public/ProductsImage',$productimage4);
            }
            // Str::of($request->post('subcategory_name'))->lower();/
            // $AddProduct=Product::find($request->post('id'));
            $AddProduct=DB::table('products')
            ->where('id', $request->post('id'))
            ->update(['name' => Str::of($request->post('product_name'))->lower(), 'cat_id' => Str::of($request->post('product_category_name'))->lower(),'sub_cat_id' => Str::of($request->post('product_sub_category_name'))->lower(),'brand' => Str::of($request->post('product_brand'))->lower(),'short_desc' => Str::of($request->post('product_short_desc'))->lower(), 'discount' => $product_discount, 'desc' => Str::of($request->post('product_desc'))->lower(),'slug' => Str::of($request->post('product_slug'))->lower(),'keywords' => Str::of($request->post('product_keywords'))->lower(),'meta_title' => Str::of($request->post('meta_title'))->lower(),'meta_desc' => Str::of($request->post('meta_description'))->lower(),'status' => $request->post('product_status') ,'updated_at' => $added_on, 'created_at' => $added_on]);

            $AddProductAttribute=DB::table('product_attributes')
            ->where('product_id', $request->post('id'))
            ->update(['weight' => Str::of($request->post('weight')), 'image1' => $productimage1, 'image2' => $productimage2, 'image3' => $productimage3, 'image4' => $productimage4, 'rating' => $request->post('rating'), 'mrp' => $request->post('mrp'), 'price' => $request->post('price'), 'quantity' => $request->post('quantity'), 'featured' => $request->post('featured'), 'discounted' => $request->post('discounted'), 'best_seller' => $request->post('best_seller'), 'updated_at' => $added_on, 'show_home' => $request->post('show_home')]);
            $msg='Product Updated';      
        }
        else{
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');              
            $productimage1='';
            $productimage2='';
            $productimage3='';
            $productimage4='';
            if($request->hasfile('product_image1')){
                $productimage1=$request->file('product_image1')->getClientOriginalName();
                $request->file('product_image1')->storeas('public/ProductsImage',$productimage1);
            }
            if($request->hasfile('product_image2')){
                $productimage2=$request->file('product_image2')->getClientOriginalName();
                $request->file('product_image2')->storeas('public/ProductsImage',$productimage2);
            }
            if($request->hasfile('product_image3')){
                $productimage3=$request->file('product_image3')->getClientOriginalName();
                $request->file('product_image3')->storeas('public/ProductsImage',$productimage3);
            }
            if($request->hasfile('product_image4')){
                $productimage4=$request->file('product_image4')->getClientOriginalName();
                $request->file('product_image4')->storeas('public/ProductsImage',$productimage4);
            }
            // prx($request->post());   
            $AddProduct=DB::table('products')
            ->insertGetId(['name' => Str::of($request->post('product_name'))->ucfirst(), 'cat_id' => Str::of($request->post('product_category_name'))->lower(),'sub_cat_id' => Str::of($request->post('product_sub_category_name'))->lower(),'brand' => Str::of($request->post('product_brand'))->lower(),'short_desc' => Str::of($request->post('product_short_desc'))->lower(), 'discount' => $product_discount, 'desc' => Str::of($request->post('product_desc'))->lower(),'slug' => Str::of($request->post('product_slug'))->lower(),'keywords' => Str::of($request->post('product_keywords'))->lower(),'meta_title' => Str::of($request->post('meta_title'))->lower(),'meta_desc' => Str::of($request->post('meta_description'))->lower(),'status' => $request->post('product_status') ,'updated_at' => $added_on, 'created_at' => $added_on]);  

            $AddProductAttribute=DB::table('product_attributes')
            ->insert(['product_id' => $AddProduct, 'weight' => Str::of($request->post('weight')), 'image1' => $productimage1, 'image2' => $productimage2, 'image3' => $productimage3, 'image4' => $productimage4, 'rating' => $request->post('rating'), 'mrp' => $request->post('mrp'), 'price' => $request->post('price'), 'quantity' => $request->post('quantity'), 'featured' => $request->post('featured'), 'discounted' => $request->post('discounted'), 'best_seller' => $request->post('best_seller'), 'updated_at' => $added_on, 'created_at' => $added_on, 'show_home' => $request->post('show_home')]);      
            $msg='Product Inserted';      
        }

        $request->session()->flash('messsage', $msg);
        return redirect('admin/products');
    }

    public function Productdelete(Request $request,$id){
        DB::table('products')
        ->where('id','=',$id)
        ->delete();
        DB::table('product_attributes')
        ->where('product_id','=',$id)
        ->delete();
        $request->session()->flash('message','Product deleted');
        return redirect('admin/products');
    }

}
