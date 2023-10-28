<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $result['data']=Product::join('categories','categories.id','=','products.cat_id')
        ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
        ->join('sub_categories','sub_categories.id','=','products.sub_cat_id')
        ->select('products.*','products.name','products.slug','products.status','categories.category_name','sub_categories.subcategory_name')
        ->get();
        // prx($result['data']);
        return view('admin/product', $result);     
    }

    public function manage_product(Request $request, $id='')
    {
        // echo $id;die();
        if ($id>0) {
            $arr=DB::table('products')
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->where(['products.id'=> $id])
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
            $result['created_at'] = $arr['0']->created_at;
            $result['updated_at'] = $arr['0']->updated_at;

        }else{
            $result['name'] = '';
            $result['cat_id'] = 0;
            $result['sub_cat_id'] = 0;
            $result['image1'] = '';
            $result['image2'] = '';
            $result['image3'] = '';
            $result['product_id']= 0;//$arr['0']->id;            
            $result['image4'] = '';
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
            $result['quantity'] = 0;//$arr['0']->quantity;
            $result['product_id']=0;           
            $result['featured'] = 0;//$arr['0']->featured;
            $result['discounted'] = 0;//$arr['0']->discounted;
            $result['best_seller'] = 0;//$arr['0']->best_seller;
            $result['mrp'] = 0;//$arr['0']->mrp;
            $result['price'] = 0;//$arr['0']->price; 
        }

        $category_data['category_data']=Category::all();
        $result['product_sub_category_data']=SubCategory::all();
        // $result['product_sub_category_name']=SubCategory::where(['id'=>$id])->get();
        // echo "<pre>"; print_r($sub_category_data);die();
        // $result['product_sub_category_name']=DB::table('sub_categories')->where(['id'=>$id]);
        return view('admin/manage-product', $result, $category_data);

    }

    public function manage_product_process(Request $request)
    {   
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
            ->update(['name' => Str::of($request->post('product_name'))->ucfirst(), 'cat_id' => Str::of($request->post('product_category_name'))->lower(),'sub_cat_id' => Str::of($request->post('product_sub_category_name'))->lower(),'brand' => Str::of($request->post('product_brand'))->lower(),'short_desc' => Str::of($request->post('product_short_desc'))->lower(),'desc' => Str::of($request->post('product_desc'))->lower(),'slug' => Str::of($request->post('product_slug'))->lower(),'keywords' => Str::of($request->post('product_keywords'))->lower(),'meta_title' => Str::of($request->post('meta_title'))->lower(),'meta_desc' => Str::of($request->post('meta_description'))->lower(),'status' => $request->post('product_status') ,'updated_at' => $added_on, 'created_at' => $added_on]);

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
            ->insertGetId(['name' => Str::of($request->post('product_name'))->ucfirst(), 'cat_id' => Str::of($request->post('product_category_name'))->lower(),'sub_cat_id' => Str::of($request->post('product_sub_category_name'))->lower(),'brand' => Str::of($request->post('product_brand'))->lower(),'short_desc' => Str::of($request->post('product_short_desc'))->lower(),'desc' => Str::of($request->post('product_desc'))->lower(),'slug' => Str::of($request->post('product_slug'))->lower(),'keywords' => Str::of($request->post('product_keywords'))->lower(),'meta_title' => Str::of($request->post('meta_title'))->lower(),'meta_desc' => Str::of($request->post('meta_description'))->lower(),'status' => $request->post('product_status') ,'updated_at' => $added_on, 'created_at' => $added_on]);  

            $AddProductAttribute=DB::table('product_attributes')
            ->insert(['product_id' => $AddProduct, 'weight' => Str::of($request->post('weight')), 'image1' => $productimage1, 'image2' => $productimage2, 'image3' => $productimage3, 'image4' => $productimage4, 'rating' => $request->post('rating'), 'mrp' => $request->post('mrp'), 'price' => $request->post('price'), 'quantity' => $request->post('quantity'), 'featured' => $request->post('featured'), 'discounted' => $request->post('discounted'), 'best_seller' => $request->post('best_seller'), 'updated_at' => $added_on, 'show_home' => $request->post('show_home')]);      
            $msg='Product Inserted';      
        }

        $request->session()->flash('messsage', $msg);
        return redirect('admin/product');
    }   

    public function delete(Request $request, $id)
    {
        // echo "string";
        // echo $id;
        // return view('admin/manage-category');
        $model=Product::find($id);
        $model->delete();
        $request->session()->flash('messsage', 'Sub Category Deleted');
        return redirect('admin/product');

    }

    public function active(Request $request, $id)
    {   
        // echo $id;
        if ($id>0) {
            $res = Product::find($id);
            $res->status=1;
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');  
            $res->updated_at=$added_on;
            $res->save();
            $msg='Status Updated';      
        }
        else{
            $msg='Invalid Request';      
        }

        $request->session()->flash('messsage', $msg);
        return redirect('admin/product');        
    }    

    public function deactive(Request $request, $id)
    {   
        // echo $id;
        if ($id>0) {
            $res = Product::find($id);
            $res->status=0;
            date_default_timezone_set("Asia/Kolkata");
            $added_on=date('Y-m-d H:i:s');  
            $res->updated_at=$added_on;
            $res->save();
            $msg='Status Updated';      
        }
        else{
            $msg='Invalid Request';      
        }

        $request->session()->flash('messsage', $msg);
        return redirect('admin/product');        
    }        


}