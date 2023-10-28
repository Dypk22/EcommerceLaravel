@extends('admin/layout')
@section('sub_categories_active','active')
@section('page_title','Grockart | Admin | Manage Categories')
@section('container')
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Sub Categories</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="/admin/sub-categories">Sub Categories</a></li>
         <li class="breadcrumb-item active">Add Sub Category</li>
      </ol>
      <div class="row">
         <div class="col-lg-6 col-md-6">
            <div class="card card-static-2 mb-30">
               <div class="card-title-2">
                  <h4>Add New Category</h4>
               </div>
               <form action="{{route('category.manage_sub_category_process')}}" method="post" class="card-body-table">
                  @csrf
                  <div class="news-content-right pd-20">
                     <div class="form-group">
                        <label class="form-label">Sub Category Name*</label>
                        <input type="text" class="form-control" name="subcategory_name" required="" value="{{$subcategory_name}}" placeholder="Category Name">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Category Name*</label>
                        <select required="" id="category_name" name="category_name" class="form-control text-capitalize">
                           @if($category_name!='')
                           <option value="{{$category_name}}" selected="">{{$category_name}}</option>
                           @foreach($exceptCategory as$exceptCategory)
                           <option value="{{$exceptCategory->category_name}}">{{$exceptCategory->category_name}}</option>
                           @endforeach
                           @else                           
                           @foreach($exceptCategory as $exceptCategory)
                           <option value="{{$exceptCategory->category_name}}">{{$exceptCategory->category_name}}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Sub Category Slug*</label>
                        <input type="text" class="form-control" name="subcategory_slug" required="" value="{{$subcategory_slug}}" placeholder="Category Name">
                     </div>
                     @error('subcategory_slug')
                     <div class="alert alert-danger alert-dismissible">
                        {{session('message')}}  Already Taken
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                     </div>                     
                     @enderror
                     <div class="form-group">
                        <label class="form-label">Status*</label>
                        <select required="" id="status" name="status" class="form-control">
                           @if($status==1)
                           <option value="1" selected="">Active</option>
                           <option value="0">Inactive</option>
                           @else
                           <option value="0" selected="">Inactive</option>
                           <option value="1">Active</option>
                           @endif
                        </select>
                     </div>
                     <button class="save-btn hover-btn" type="submit">Add New Category</button>
                  </div>
                  <input type="hidden" name="id" value="{{$id}}"/>
               </form>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection