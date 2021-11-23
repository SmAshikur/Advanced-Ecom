<?php use App\Models\Product?>
@extends('layouts.userLayout.userDesign')
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active"> SHOPPING CART</li>
        </ul>
        <h3><a href="{{url('account')}}" class="btn btn-large btn-primary  "> Your Account </a>
            <a href="products.html" class="btn btn-large btn-primary pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>
        <hr class="soft"/>
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

        <form action="" method="post">@csrf
        <table class="table table-bordered">
            <tr><th>Delivery Address  </th></tr>
            @foreach($deliveryAddress as $key)
            <tr>
                <td>
                        <div class="control-group" style="float: left; margin-top: -2px; margin-right: 5px">
                                <input type="radio" value="{{$key['id']}}" id="address{{$key['id']}}" name="key_id">
                        </div>
                        <div class="control-group">
                            <label class="control-label" >{{$key['name']}},{{$key['address']}},{{$key['country']}},{{$key['city']}}</label>

                        </div>
                </td>
                <td>
                    <button class="btn btn-primary"><a href="{{url('add-delivery/'.$key['id'])}}"> Edit</a></button>
                    <button class="btn btn-primary"><a href="{{url('del-delivery/'.$key['id'])}}"> Delete</a></button>
                </td>
            </tr>
            @endforeach
            <button class="btn btn-success"><a href="{{url('add-delivery')}}"> Add </a></button>
        </table>
        <div id="AppendCart" >

           <table class="table table-bordered">
               <thead>
               <tr>
                   <th>Product</th>
                   <th colspan="2">Description</th>
                   <th>Quantity/Update</th>
                   <th>Price</th>
                   <th>Discount</th>

                   <th>Total</th>
               </tr>
               </thead>
               <tbody>
               <?php $totalPrice=0;$totalDis=0; ?>
               @foreach($userCart as $key)
                   <?php $getPrice =Product::attrDiscount($key['product_id'],$key['size']); ?>
                   <tr>
                       <td> <img width="60" src="{{asset('images/product_images/small/'.$key['product']['main_image'])}}" alt=""/></td>
                       <td colspan="2">{{$key['product']['product_name']}}<br/>Color :{{$key['product']['product_color']}}</td>
                       <td>
                           <div class="input-append">
                               <input class="span1" style="max-width:34px"  value="{{$key['quantity']}}" id="appendedInputButtons" size="16" type="text">
                               <button class="btn updateItem qMinus" data-cartid="{{$key['id']}}" type="button"><i class="icon-minus"></i></button>
                               <button class="btn updateItem qPlus" data-cartid="{{$key['id']}}" type="button"><i class="icon-plus"></i></button>
                               <button class="btn btn-danger deleteItem" data-cartid="{{$key['id']}}" type="button"><i class="icon-remove icon-white"></i></button>
                           </div>
                       </td>
                       <td>Rs.{{$getPrice['product_price']}} BDT</td>
                       <td>Rs.{{$getPrice['discount']}} BDT</td>

                       <td>Rs.{{$getPrice['discounted_price']*$key['quantity']}} BDT </td>
                   </tr>
                   <?php $totalPrice= $totalPrice+ ($getPrice['discounted_price']*$key['quantity'])  ; ?>
               @endforeach

               <tr>
                   <td colspan="6" style="text-align:right">Total Price: 	</td>
                   <td>{{$totalPrice}} BDT</td>
               </tr>
               <tr>
                   <td colspan="6" style="text-align:right">Coupon Discount:	</td>
                   <?php  ?>
                   <td  class="cop" >
                       @if(Session::has('copAmount'))
                           {{Session::get('copAmount')}} BDT
                       @else
                           00 BDT
                       @endif
                   </td>
               </tr>

               <tr>
                   <td colspan="6" style="text-align:right"><strong>TOTAL ({{$totalPrice}} BDT -<span class="cop"> @if(Session::has('copAmount'))
                                   {{Session::get('copAmount')}} BDT @else 00 BDT @endif</span>)  =</strong></td>
                   <td class="label label-important" style="display:block"> <strong class="grand"> {{$grand_total= $totalPrice-Session::get('copAmount')}} BDT </strong></td>
                    <?php Session::put('grand_total',$grand_total);?>
               </tr>
               </tbody>
           </table>
       </div>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>
                      <div class="control-group">
                            <label class="control-label"><strong> Payment Methods: </strong> </label>
                            <div class="controls">

                                <input id="cod" name="pay_gateway" type="radio" value="cod">&nbsp;&nbsp;<strong >COD</strong>&nbsp;
                                <input id="paypal" name="pay_gateway" type="radio" value="paypal">&nbsp;&nbsp;<strong>Paypal</strong>&nbsp;

                            </div>
                        </div>

                </td>
            </tr>

            </tbody>
        </table>
        <a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
        <button class="btn btn-large pull-right">Place order <i class="icon-arrow-right"></i></button>
        </form>
    </div>
@endsection
