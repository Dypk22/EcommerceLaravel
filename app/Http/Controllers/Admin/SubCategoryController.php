<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $result['data']=SubCategory::all();
        return view('admin/sub-category', $result);    	
    }

    public function manage_sub_category(Request $request, $id='')
    {
    	// echo $id;die();
        if ($id>0) {
            $arr=SubCategory::where(['id'=> $id])->get();

            $result['sub_category_name']=$arr['0']->subcategory_name;
            $result['category_name']=$arr['0']->category_name;            
            $result['sub_category_slug']=$arr['0']->subcategory_slug;            
            $result['sub_category_status']=$arr['0']->status;            
            $result['sub_category_id']=$arr['0']->id;            

        }else{
            $result['sub_category_name']='';
            $result['sub_category_slug']='';
            $result['category_name']='';            
            $result['sub_category_status']=0;            
            $result['sub_category_id']=0;            
        }

        $category_data['category_data']=Category::all();
        return view('admin/manage-sub-category', $result, $category_data);

    }

    public function manage_sub_category_process(Request $request)
    {	
        // return $request->post();
    	$request->validate([
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name',
            'subcategory_slug' => 'required|unique:sub_categories,subcategory_slug,'.$request->post('id'),
        ]); 

        if ($request->post('id')>0) {
            $NewSubCat=SubCategory::find($request->post('id'));      
            $msg='Sub Category Updated';      
        }
        else{
	    	       	
            $NewSubCat=new SubCategory();            
            $msg='Sub Category Inserted';      
        }
        
        $NewSubCat->status=$request->post('sub_category_status');
        $NewSubCat->subcategory_name=Str::of($request->post('subcategory_name'))->lower();
        $NewSubCat->category_name=Str::of($request->post('category_name'))->lower();
        // $NewSubCat->status=$request->post('status');
        $NewSubCat->subcategory_slug=Str::of($request->post('subcategory_slug'))->lower();
        date_default_timezone_set("Asia/Kolkata");
        $added_on=date('Y-m-d H:i:s');  
        $NewSubCat->updated_at=$added_on;

        $NewSubCat->save();

        $request->session()->flash('messsage', $msg);
        return redirect('admin/sub-category');
    }   

    public function delete(Request $request, $id)
    {
        // echo "string";
        // echo $id;
        // return view('admin/manage-category');
        $model=SubCategory::find($id);
        $model->delete();
        $request->session()->flash('messsage', 'Sub Category Deleted');
        return redirect('admin/sub-category');

    }

    public function active(Request $request, $id)
    {   
        // echo $id;
        if ($id>0) {
            $res = SubCategory::find($id);
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
        return redirect('admin/sub-category');        
    }    

    public function deactive(Request $request, $id)
    {   
        // echo $id;
        if ($id>0) {
            $res = SubCategory::find($id);
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
        return redirect('admin/sub-category');        
    }        


}
