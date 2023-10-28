@extends('admin/layout')
@section('products_active','active')
@section('page_title','Grockart | Admin Home')
@section('container')
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Products</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="products.html">Products</a></li>
         <li class="breadcrumb-item active">Add Product</li>
      </ol>
      <div class="row">
         <div class="col-lg-6 col-md-6">
            <div class="card card-static-2 mb-30">
               <div class="card-title-2">
                  <h4>Add New Product</h4>
               </div>
               <div class="card-body-table">
                  <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data" class="news-content-right pd-20">
                     @csrf
                     @if($product_id!=0)
                     <div class="form-group">
                        <label class="form-label">Product Id : </label>
                        <label class="form-label">{{$product_id}}</label>
                     </div>
                     @endif
                     <div class="form-group">
                        <label class="form-label">Name*</label>
                        <input type="text" class="form-control text-capitalize" required="" name="product_name" value="{{$name}}" placeholder="Product Name">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Category*</label>
                        <select id="categtory" required="" name="product_category_name" class="form-control text-capitalize">
                           <option value="">--Select Category--</option>
                           @if(isset($selected_category[0]))
                           <option value="{{$selected_category[0]->id}}" selected="">{{$selected_category[0]->category_name}}</option>
                           @foreach($Allcategory as $Allcategory)
                           <option value="{{$Allcategory->id}}">{{$Allcategory->category_name}}</option>                           
                           @endforeach
                           @else
                           @foreach($Allcategory as $Allcategory)
                           <option value="{{$Allcategory->id}}">{{$Allcategory->category_name}}</option>                           
                           @endforeach
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Sub Category*</label>
                        <select id="categtory" required="" name="product_sub_category_name" class="form-control text-capitalize">
                           <option value="">--Select Sub Category--</option>
                           @if(isset($selected_sub_category[0]))
                           <option value="{{$selected_sub_category[0]->id}}" selected="">{{$selected_sub_category[0]->subcategory_name}}</option>
                           @foreach($Allsubcategory as $Allsubcategory)
                           <option value="{{$Allsubcategory->id}}">{{$Allsubcategory->subcategory_name}}</option>                           
                           @endforeach
                           @else
                           @foreach($Allsubcategory as $Allsubcategory)
                           <option value="{{$Allsubcategory->id}}">{{$Allsubcategory->subcategory_name}}</option>                           
                           @endforeach
                           @endif
                        </select>
                     </div>
                     
                     <div class="form-group">
                        <label class="form-label">Brand*</label>
                        <input type="text" class="form-control" value="{{$brand}}" required="" name="product_brand" placeholder="Brand Name">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Short Description*</label>
                        <textarea rows="5" style="resize: none;" class="form-control" required="" name="product_short_desc" placeholder="Meta Description">{{$short_desc}}</textarea>
                        <!-- <input type="text" class="form-control" value="{{$short_desc}}" required="" name="product_short_desc" placeholder="Short Description About Product"> -->
                     </div>
                     <div class="form-group">
                        <label class="form-label">Description*</label>
                        <textarea rows="5" style="resize: none;" class="form-control" required="" name="product_desc" placeholder="Meta Description">{{$desc}}</textarea>
                        <!-- <input type="text" class="form-control" value="{{$desc}}" required="" name="product_desc" placeholder="Description About Product"> -->
                     </div>
                     <div class="form-group">
                        <label class="form-label">MRP*</label>
                        <input type="text" class="form-control" required="" name="mrp" value="@if($mrp!=0){{$mrp}}@endif" placeholder="Printed Price">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Selling Price*</label>
                        <input type="text" class="form-control" value="@if($price!=0){{$price}}@endif" required="" name="price" placeholder="Selling Price">
                     </div>                     
                     <div class="form-group">
                        <label class="form-label">Keywords*</label>
                        <textarea rows="5" style="resize: none;" class="form-control" required="" name="product_keywords" placeholder="Keywords">{{$keywords}}</textarea>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Meta Title*</label>
                        <input type="text" class="form-control" value="{{$meta_title}}" required="" name="meta_title" placeholder="Meta Title">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Meta Description*</label>
                        <textarea rows="5" style="resize: none;" class="form-control" required="" name="meta_description" placeholder="Meta Description">{{$meta_desc}}</textarea>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Slug*</label>
                        <input type="text" class="form-control" value="{{$slug}}" required="" name="product_slug" placeholder="Product Slug">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Discount*</label>
                        <label class="form-label">₹</label>
                        <input type="text" class="form-control" value="@if($discount!=0){{$discount}}@endif" readonly="" name="discount" placeholder="Calculated Automatically">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Quantity*</label>
                        <input type="text" class="form-control" value="{{$quantity}}" required="" name="quantity" placeholder="Product Quantity in Stock">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Created At* : </label>
                        <label class="form-label">{{$created_at}}</label>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Updated At* : </label>
                        <label class="form-label">{{$updated_at}}</label>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Weight*</label>
                        <input type="text" class="form-control" value="{{$weight}}" required="" name="weight" placeholder="Product Weight">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Show Home*</label>
                        <select id="status" required="" name="show_home" class="form-control">
                           @if($show_home==0)
                           <option selected="" value="0">Inactive</option>
                           <option value="1">Active</option>
                           @else
                           <option selected="" value="1">Active</option>
                           <option value="0">Inactive</option>
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Rating*</label>
                        <input type="text" class="form-control" required="" name="rating" value="@if($rating!=0){{$rating}}@endif" placeholder="Product Rating">
                     </div>
                     <div class="form-group">
                        <label class="form-label">Status*</label>
                        <select id="status" required="" name="product_status" class="form-control">
                           @if($status==0)
                           <option selected="" value="0">Inactive</option>
                           <option value="1">Active</option>
                           @else
                           <option selected="" value="1">Active</option>
                           <option value="0">Inactive</option>
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Featured*</label>
                        <select id="status" required="" name="featured" class="form-control">
                           @if($featured==0)
                           <option selected="" value="0">Inactive</option>
                           <option value="1">Active</option>
                           @else
                           <option selected="" value="1">Active</option>
                           <option value="0">Inactive</option>
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Best Seller*</label>
                        <select id="status" required="" name="best_seller" class="form-control">
                           @if($best_seller==0)
                           <option selected="" value="0">Inactive</option>
                           <option value="1">Active</option>
                           @else
                           <option selected="" value="1">Active</option>
                           <option value="0">Inactive</option>
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Discounted*</label>
                        <select id="status" required="" name="discounted" class="form-control">
                           @if($discounted==0)
                           <option selected="" value="0">Inactive</option>
                           <option value="1">Active</option>
                           @else
                           <option selected="" value="1">Active</option>
                           <option value="0">Inactive</option>
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Product Image*</label>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input curHov" name="product_image1" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                              <label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
                           </div>
                        </div>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input curHov" name="product_image2" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                              <label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
                           </div>
                        </div>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input curHov" name="product_image3" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                              <label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
                           </div>
                        </div>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input curHov" name="product_image4" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                              <label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
                           </div>
                        </div>
                        <ul class="add-produc-imgs">
                           @if($image1!='')
                           <li>
                              <div class="add-cate-img-1">
                                 <img src="{{asset('storage/ProductsImage/'.$image1)}}" alt="Something Went Wrong">
                              </div>
                           </li>
                           @endif
                           @if($image2!='')
                           <li>
                              <div class="add-cate-img-1">
                                 <img src="{{asset('storage/ProductsImage/'.$image2)}}" alt="Something Went Wrong">
                              </div>
                           </li>
                           @endif
                           @if($image3!='')
                           <li>
                              <div class="add-cate-img-1">
                                 <img src="{{asset('storage/ProductsImage/'.$image3)}}" alt="Something Went Wrong">
                              </div>
                           </li>
                           @endif
                           @if($image4!='')
                           <li>
                              <div class="add-cate-img-1">
                                 <img src="{{asset('storage/ProductsImage/'.$image4)}}" alt="Something Went Wrong">
                              </div>
                           </li>
                           @endif                           
                        </ul>
                     </div>
                     <button class="save-btn hover-btn" type="submit">Add New Product</button>
                     <input type="hidden" name="id" value="{{$id}}"/>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection