@extends('admin/layout')
@section('orders_active','active')
@section('page_title','Grockart | Admin | Manage Categories')
@section('container')
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Orders</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
         <li class="breadcrumb-item active">Orders</li>
      </ol>
      <div class="row justify-content-between">
         <div class="col-lg-12 col-md-12">
            <div class="card card-static-2 mb-30">
               <div class="card-title-2">
                  <h4>All Orders</h4>
               </div>
               <div class="card-body-table">
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th>Order ID</th>
                              <th>Txn Id</th>
                              <th>Date</th>
                              <!-- <th>Address</th> -->
                              <th>Status</th>
                              <th>Total</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($orders as $orders)
                           <tr>
                              <td>{{$orders->id}}</td>
                              <td>{{$orders->txnid}}</td>
                              <td>
                                 <span class="delivery-time">{{date('d M, Y', strtotime($orders->added_on))}}</span>
                                 <span class="delivery-time">{{date('h:iA', strtotime($orders->added_on))}}</span>
                              </td>
                              <!-- <td>#0000, St No. 8, Shahid Karnail Singh Nagar, MBD Mall, Frozpur road, Ludhiana, 141001</td> -->
                              <td>
                                 <span class="badge-item badge-status">{{$orders->order_status}}</span>
                              </td>
                              <td>₹{{$orders->total_price}}</td>
                              <td class="action-btns">
                                 <a href="{{url('admin/order-details/'.$orders->id)}}" class="views-btn"><i class="fas fa-edit"></i></a>
                                 <!-- <a href="order_edit.html" class="edit-btn"><i class="fas fa-edit"></i></a> -->
                              </td>
                           </tr>
                           <tr>
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