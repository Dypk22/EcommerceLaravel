@extends('admin/layout')
@section('products_active','active')
@section('page_title','Grockart | Admin Home')
@section('container')
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Products</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
         <li class="breadcrumb-item active">Products</li>
      </ol>
      <div class="row justify-content-between">
         <div class="col-lg-12">
            <a href="{{url('admin/products/manage-products')}}" class="add-btn hover-btn">Add New</a>
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
                  <h4>All Areas</h4>
               </div>
               <div class="card-body-table">
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th style="width:60px">ID</th>
                              <th style="width:100px">Image</th>
                              <th>Name</th>
                              <th>Category</th>
                              <th>Created</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($products as $products)
                           <tr>
                              <td>{{$products->id}}</td>
                              <td>
                                 <div class="cate-img-5">
                                    <img src="{{asset('storage/ProductsImage/'.$products->image1)}}" alt="">
                                 </div>
                              </td>
                              <td><a href="{{url('products/'.$products->slug)}}" target="_blank" class="text-dark text-capitalize">{{$products->name}}</a></td>
                              <td class="text-capitalize">{{$products->category_name}}</td>
                              <td>{{date('d M, Y', strtotime(($products->created_at)))}}</td>
                              <td class="customStatus{{$products->id}}">
                                 @php if($products->status==1){ @endphp
                                 <span class="badge-item badge-status curHov" id="{{$products->slug}}" onclick="updateProductStats('{{$products->slug}}', 0,'{{$products->id}}')">Active</span>
                                 @php }else{ @endphp
                                 <span class="badge-item badge-status curHov" id="{{$products->slug}}" onclick="updateProductStats('{{$products->slug}}', 1, '{{$products->id}}')">Deactive</span>
                                 @php } @endphp
                                 <!-- <span class="badge-item badge-status">Active</span> -->
                              </td>
                              <td class="action-btns">
                                 <a href="{{url('admin/products/manage-products')}}/{{$products->slug}}" class="edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
                                 <a href="{{url('admin/products/delete')}}/{{$products->id}}" class="edit-btn" title="Delete"><i class="fas fa-trash"></i></a>
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