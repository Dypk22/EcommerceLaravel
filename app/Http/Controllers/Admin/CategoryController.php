<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // *
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
     
    public function index()
    {
        // echo "string";
        //fetch cat data
        $result['data']=Category::all();
        return view('admin/category', $result);
    }

    public function manage_category(Request $request, $id='')
    {
        // echo "string";
        if ($id>0) {
            $arr=Category::where(['id'=> $id])->get();

            $result['category_name']=$arr['0']->category_name;
            $result['category_slug']=$arr['0']->category_slug;            
            $result['category_status']=$arr['0']->status;            
            $result['category_id']=$arr['0']->id;            
            $result['show_home']=$arr['0']->show_home;            

        }else{
            $result['category_name']='';
            $result['category_slug']='';
            $result['category_status']=0;            
            $result['category_id']=0;            
            $result['show_home']=0;            
        }
        return view('admin/manage-category', $result);
        // echo "<pre>";
        // echo print_r($result['data']);
        // die();
    }

    public function manage_category_process(Request $request)
    {
        // echo "string";
        // return $request->post();
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
            'category_slug' => 'required|unique:categories,category_slug,'.$request->post('id'),
        ]);

        if ($request->post('id')>0) {
            $model=Category::find($request->post('id'));      
            $msg='Category Updated';      
        }
        else{
            $model=new Category();            
            $msg='Category Inserted';      
        }
        $model->category_name=Str::of($request->post('category_name'))->lower();
        $model->category_slug=Str::of($request->post('category_slug'))->lower();
        $model->status=$request->post('category_status');
        $model->show_home=$request->post('show_home');            
        date_default_timezone_set("Asia/Kolkata");
        $added_on=date('Y-m-d H:i:s');  
        $model->updated_at=$added_on;
        $model->save();
        $request->session()->flash('messsage', $msg);
        return redirect('admin/category');
    }   

    public function delete(Request $request, $id)
    {
        // echo "string";
        // echo $id;
        // return view('admin/manage-category');
        $model=Category::find($id);
        $model->delete();
        $request->session()->flash('messsage', 'Category Deleted');
        return redirect('admin/category');

    }

    public function active(Request $request, $id)
    {   
        // echo $id;
        if ($id>0) {
            $res = Category::find($id);
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
        return redirect('admin/category');        
    }    

    public function deactive(Request $request, $id)
    {   
        // echo $id;
        if ($id>0) {
            $res = Category::find($id);
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
        return redirect('admin/category');        
    }        

}
