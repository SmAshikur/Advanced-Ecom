@extends('layouts.userLayout.userDesign')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
        <li class="active">Order</li>
    </ul>
    <h4>Order List</h4>
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
        <div class="span8">
             <table class="table table-bordered table-striped">
                 <tr>
                     <th>Order Id</th>
                     <th>Order Products</th>
                     <th>Payment Method</th>
                     <th>Grand Total</th>
                     <th>Created At</th>
                     <th> </th>
                 </tr>
                 @foreach($orders as $order)
                     <tr>

                         <td>{{$order['id']}}</td>
                         <td>
                             @foreach($order['orders_products'] as $pro)
                                 {{$pro['product_code']}}<br>
                             @endforeach
                         </td>
                         <td>{{$order['pay_method']}}</td>
                         <td>{{$order['grand_total']}}l</td>
                         <td>{{date('d-m-y',strtotime($order['created_at']))}}</td>
                         <td>
                                <a class="btn btn-primary" href="{{url('/orders-details/'.$order['id'])}}"> </a>
                         </td>

                     </tr>
                 @endforeach
             </table>
        </div>


    </div>

</div>
@endsection
