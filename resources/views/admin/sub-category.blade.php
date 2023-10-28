@extends('admin/layout')
@section('sub_categories_active','active')
@section('page_title','Grockart | Admin | Manage Sub Categories')
@section('container')
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Sub Categories</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
         <li class="breadcrumb-item active">Sub Categories</li>
      </ol>
      <div class="row justify-content-between">
         <div class="col-lg-12">
            <a href="{{url('admin/sub-category/manage-sub-category')}}" class="add-btn hover-btn">Add New</a>
         </div>
         @if(session()->has('message'))
         <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible mb-0 mt-3">
               {{session('message')}}  
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">×</span>
               </button>
            </div>
         </div>
         @endif    
         <div class="col-lg-12 col-md-12">
            <div class="card card-static-2 mt-30 mb-30">
               <div class="card-title-2">
                  <h4>All Categories</h4>
               </div>
               <div class="card-body-table">
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <!-- <th style="width:130px">Image</th> -->
                              <th>Sub Category</th>
                              <th>Slug</th>
                              <th>Category</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($sub_categories as $sub_categories)
                           <tr>
                              <td>{{$sub_categories->id}}</td>
                              <td class="text-capitalize">{{$sub_categories->subcategory_name}}</td>
                              <td class="text-capitalize">{{$sub_categories->subcategory_slug}}</td>
                              <td class="text-capitalize">{{$sub_categories->category_name}}</td>
                              <td class="customStatus{{$sub_categories->id}}">
                                 @php if($sub_categories->status==1){ @endphp
                                 <span class="badge-item badge-status curHov" id="{{$sub_categories->subcategory_slug}}" onclick="updateSubCatStats('{{$sub_categories->subcategory_slug}}', 0,'{{$sub_categories->id}}')">Active</span>
                                 @php }else{ @endphp
                                 <span class="badge-item badge-status curHov" id="{{$sub_categories->subcategory_slug}}" onclick="updateSubCatStats('{{$sub_categories->subcategory_slug}}', 1, '{{$sub_categories->id}}')">Deactive</span>
                                 @php } @endphp
                              </td>
                              <td class="action-btns">
                                 <a href="{{url('admin/sub-category/manage-sub-category/')}}/{{$sub_categories->subcategory_slug}}" class="edit-btn"><i class="fas fa-edit"></i></a>
                                 <a href="{{url('admin/sub-category/delete/')}}/{{$sub_categories->id}}" class="edit-btn"><i class="fas fa-trash"></i></a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection