<?php use App\Models\Product ?>
@extends('layouts.adminLayout.adminDesign')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Advanced Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(Session::has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{Session::get('fail')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{Session::get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bordered Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
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
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Delivery Address</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
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
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th><strong>name</strong></th>
                                        <th><strong> {{$order['name']}}</strong></th>
                                    </tr>
                                    <tr>
                                        <th><strong>Country</strong></th>
                                        <th> <strong>{{$order['mobile']}}</strong></th>
                                    </tr>


                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Billing Address</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>name</th>
                                        <th>{{$user['name']}}</th>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <th>{{$user['country']}}</th>
                                    </tr>
                                    <tr>
                                        <th>Zipcode</th>
                                        <td>{{$user['zipcode']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <th>{{$user['mobile']}}</th>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <th>{{$user['city']}}</th>
                                    </tr>

                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Billing Address</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table>
                                    <tr>
                                   <form class="form-control " action="{{url('admin/order-status')}}" method="post">@csrf
                                       <input type="hidden" name="order_id" value="{{$order['id']}}">
                                       <div class="form-group">
                                           <select name="order_status" id="order_status" style="width: 25%">
                                                @foreach($status as $key)
                                               <option value="{{$key['name']}}" @if(isset($order['order_status']) && $order['order_status']==$key['name']) selected="" @endif> {{$key['name']}}</option>
                                               @endforeach
                                           </select>
                                           <input value="{{$order['courier_name']}}" style="width: 25% " name="courier_name" @if(empty($order['courier_name']))id="courier_name"  @endif type="text" placeholder="courier name">
                                           <input value="{{$order['tracking_number']}}" style="width: 25% " name="tracing_number"  @if(empty($order['tracking_number']))id="tracing_number"  @endif type="text" placeholder="Track Number">
                                           <button  type="submit" class="btn btn-primary ml-5">update </button>
                                       </div>

                                   </form>
                                    </tr>
                                    <tr>
                                        @foreach($logs as $log)
                                            <strong>Status: &nbsp; {{$log['order_status']}}</strong><br>
                                          Date: &nbsp; {{ date('j F,Y, g:i a', strtotime($log['created_at']))}} <hr>
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">

                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Simple Full Width Table</h3>

                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-right">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Product Size</th>
                                        <th>Product Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
