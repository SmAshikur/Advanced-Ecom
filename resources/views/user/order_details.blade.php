<?php use App\Models\Product ?>
@extends('layouts.userLayout.userDesign')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
        <li class="active"><a href="{{url('/orders')}}">Order</a> <span class="divider">/</span> </li>
    </ul>
    <h4>Order Details</h4>
    <hr class="soft"/>

    <div class="row">
        @if(Session::has('fail'))
            <div class="alert alert-danger  " role="alert">
                {{Session::get('fail')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert  " role="alert">
                {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            <div class="span4">
                <table class="table  table-striped table-bordered">
                    <tr>
                        <th colspan="2" class="align-items-center"> Order Details <th>

                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <th>{{date('d-m-y',strtotime($order['created_at']))}}</th>
                    </tr>
                    <tr>
                        <th>Order Status</th>
                        <th>{{$order['order_status']}}</th>
                    </tr>
                    <tr>
                        <th>Order Total</th>
                        <td>{{$order['grand_total']}}</td>
                    </tr>
                    <tr>
                        <th>Shipping Charge</th>
                        <th>{{$order['shipping_charges']}}</th>
                    </tr>
                    <tr>
                        <th>Coupon Code</th>
                        <th> {{$order['coupon_code']}}</th>
                    </tr>
                    <tr>
                        <th>Coupon Amount</th>
                        <th>{{$order['coupon_amount']}}</th>
                    </tr>

                </table>
            </div>
            <div class="span4">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th colspan="2"> Delivery Address <th>
                    </tr>
                    <tr>
                        <th>name</th>
                        <th>{{$order['name']}}</th>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <th>{{$order['country']}}</th>
                    </tr>
                    <tr>
                        <th>Zipcode</th>
                        <td>{{$order['zipcode']}}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <th>{{$order['mobile']}}</th>
                    </tr>
                    <tr>
                        <th>City</th>
                        <th>{{$order['city']}}</th>
                    </tr>

                </table>
            </div>
            <div class="span8">
             <table class="table table-bordered table-striped">
                 <tr>
                     <th>Product Image</th>
                     <th>Product Name</th>
                     <th>Product Code</th>
                     <th>Product Color</th>
                     <th>Product Size</th>
                     <th>Product Quantity</th>

                 </tr>
                 @foreach($order['orders_products'] as $pro)
                     <tr>
                         <td>
                             <?php $img=Product::img($pro['product_id']) ?>
                            <a href="{{url('/'.$pro['product_name'].'/'.$pro['product_code'].'/'.$pro['product_id'])}}" target="_blank">  <img style="height:100px" src="{{asset('images/product_images/small/'.$img)}}"></a>

                         </td>
                         <td>{{$pro['product_name']}}</td>
                         <td>{{$pro['product_code']}}</td>
                         <td>{{$pro['product_color']}}</td>
                         <td>{{$pro['product_size']}}l</td>
                         <td>{{$pro['product_quantity']}}</td>


                     </tr>
                 @endforeach
             </table>
        </div>


    </div>

</div>
@endsection
