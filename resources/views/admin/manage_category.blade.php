@extends('admin/layout')
@section('categories_active','active')
@section('page_title','Grockart | Admin | Manage Categories')
@section('container')
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Categories</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="category.html">Categories</a></li>
         <li class="breadcrumb-item active">Add Category</li>
      </ol>
      <div class="row">
         <div class="col-lg-6 col-md-6">
            <div class="card card-static-2 mb-30">
               <div class="card-title-2">
                  <h4>Add New Category</h4>
               </div>
               <form action="{{route('category.manage_category_process')}}" method="post" class="card-body-table">
                  @csrf
                  <div class="news-content-right pd-20">
                     <div class="form-group">
                        <label class="form-label">Category Name*</label>
                        <input type="text" class="form-control" name="category_name" required="" value="{{$category_name}}" placeholder="Category Name">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Category Slug*</label>
                        <input type="text" class="form-control" name="category_slug" required="" value="{{$category_slug}}" placeholder="Category Name">
                     </div>
                     @error('category_slug')
                     <div class="alert alert-danger alert-dismissible">
                        {{session('message')}}  
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                     </div>                     
                     @enderror
                     <div class="form-group">
                        <label class="form-label">Status*</label>
                        <select required="" id="status" name="status" class="form-control">
                           @php $categoryName=''; if(isset($category_status)){ $categoryName=$category_status; } @endphp
                           @if($categoryName!='' && $categoryName==1)
                           <option value="1" selected="">Active</option>
                           <option value="0">Inactive</option>
                           @elseif($categoryName!='' && $categoryName==0)
                           <option value="0" selected="">Inactive</option>
                           <option value="1">Active</option>
                           @else                           
                           <option value="" selected="">Select Status</option>
                           <option value="1">Active</option>
                           <option value="0">Inactive</option>
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Show in Home Page*</label>
                        <select required="" id="status" name="show_home" class="form-control">
                           @php $showHome=111; if(isset($show_home)){ $showHome=$show_home; } @endphp
                           @if($showHome!=111 && $showHome==1)
                           <option value="1" selected="">Yes</option>
                           <option value="0">No</option>
                           @else                           
                           <option value="1">Yes</option>
                           <option value="0" selected="">No</option>
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