@extends('admin/layout')
@section('orders_active','active')
@section('page_title','Grockart | Admin | Manage Categories')
@section('container')
<main>
   <div class="container-fluid">
      <h2 class="mt-30 page-title">Orders</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="{{url('/admin/orders')}}">Orders</a></li>
         <li class="breadcrumb-item active">Order View</li>
      </ol>
      <div class="row">
         <div class="col-xl-12 col-md-12">
            <div class="card card-static-2 mb-30">
               <div class="card-title-2">
                  <h2 class="title1458">Invoice</h2>
                  <span class="order-id d-none d-md-block">Txn Id : {{$order_details[0]->txnid}}</span>
               </div>
               <div class="invoice-content">
                  <div class="row">
                     <div class="col-lg-6 col-sm-6">
                        <div class="ordr-date">
                           <b>Customer Details : </b><br>
                           Date : {{date('d M Y (h:iA)', strtotime($order_details[0]->added_on))}},<br>
                           User : <span class="text-capitalize">{{$order_details[0]->user_id}} / {{$order_details[0]->user_name}} / {{$order_details[0]->user_type}}</span>,<br>
                           Payment Method : <span class="text-capitalize">{{$order_details[0]->payment_method}}</span>,<br>
                           @if($order_details[0]->payment_method=='PaymentGateway')
                           Payment Id : <span class="text-capitalize">{{$order_details[0]->payment_id}}</span>,<br>
                           @endif
                           Payment Status : <span class="text-capitalize">{{$order_details[0]->payment_status}}</span>                           
                        </div>
                        <div>
                           <a target="_blank" href="{{url('admin/user/order-detail/'.$order_details[0]->id)}}" class="text-dark">Details</a>
                        </div>
                     </div>
                     <div class="col-lg-6 col-sm-6">
                        <div class="ordr-date right-text">
                           <b>Shipping Details :</b><br>
                           Contact No : +91{{$order_details[0]->buyer_number}},<br>
                           Email : <span class="text-capitalize">{{$order_details[0]->buyer_email}}</span>,<br>
                           Delivery at : <span class="text-capitalize">{{$order_details[0]->buyer_name}} ({{$order_details[0]->address_type}})</span>,<br>
                           <span class="text-capitalize">{{$order_details[0]->address1}}</span>,<br>
                           <span class="text-capitalize">{{$order_details[0]->address2}}</span>, 
                           <span class="text-capitalize">{{$order_details[0]->city}}</span>,<br>
                           {{$order_details[0]->state}}, {{$order_details[0]->pin_code}}<br>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="card card-static-2 mb-30 mt-30">
                           <div class="card-title-2">
                              <h4>Order Particulars</h4>
                           </div>
                           <div class="card-body-table">
                              <div class="table-responsive">
                                 <table class="table ucp-table table-hover">
                                    <thead>
                                       <tr>
                                          <th style="width:130px">#</th>
                                          <th>Item</th>
                                          <th style="width:150px" class="text-center">Price</th>
                                          <th style="width:150px" class="text-center">Qty</th>
                                          <th style="width:100px" class="text-center">Total</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($order_details_particulars as $order_details_particulars)
                                       <tr>
                                          <td>1</td>
                                          <td>
                                             <a href="{{url('/products/'.$order_details_particulars->slug)}}" class="text-capitalize CustomATag text-dark" target="_blank">{{$order_details_particulars->name}}</a>
                                          </td>
                                          <td class="text-center">₹{{$order_details_particulars->price}}</td>
                                          <td class="text-center">{{$order_details_particulars->qty}}</td>
                                          <td class="text-center">₹{{$order_details_particulars->price*$order_details_particulars->qty}}</td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-7"></div>
                     <div class="col-lg-5">
                        <div class="order-total-dt">
                           <div class="order-total-left-text">
                              Sub Total
                           </div>
                           <div class="order-total-right-text">
                              ₹{{$order_details[0]->total_price+$order_details[0]->coupon_value}}
                           </div>
                        </div>
                        @if($order_details[0]->coupon_code!='')
                        <div class="order-total-dt">
                           <div class="order-total-left-text">
                              Coupon Discount
                           </div>
                           <div class="order-total-right-text">
                              ₹{{$order_details[0]->coupon_value}}
                           </div>
                        </div>
                        @endif
                        <div class="order-total-dt">
                           <div class="order-total-left-text">
                              Delivery Fees
                           </div>
                           <div class="order-total-right-text">
                              Free <del>₹{{$my_details[0]->delivery_charge}}</del>
                           </div>
                        </div>
                        <div class="order-total-dt">
                           <div class="order-total-left-text fsz-18">
                              Total Amount
                           </div>
                           <div class="order-total-right-text fsz-18">
                              ₹{{$order_details[0]->total_price}}
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-7"></div>
                     <div class="col-lg-5">
                        <form class="select-status"  method="post" action="{{route('OrderStats.update_OrderStats')}}">
                           @csrf
                           <label for="status">Status*</label>
                           <input type="hidden" name="OrderId" value="{{$order_details[0]->id}}">
                           <select required="" name="order_status" class="form-control">
                              <option selected value="{{$order_details[0]->order_status_id}}">{{$order_details[0]->order_status}}</option>
                              @foreach($orderStats as $orderStats)
                              <option value="{{$orderStats->id}}">{{$orderStats->name}}</option>
                              @endforeach
                           </select>
                           <button class="save-btn hover-btn" type="submit">Update</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection