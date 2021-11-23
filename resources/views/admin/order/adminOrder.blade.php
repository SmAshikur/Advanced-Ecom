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


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
            <!-- SELECT2 EXAMPLE -->

                    <div class="card">
                        <div class="card-header">
                            <div class="row flex justify-content-around ">
                                <div >
                                    <h2 class="card-title text-bold pt-2 ">Category Table</h2>
                                </div>
                                <div >
                                    <a href="#" class="btn btn-success"> Add Category </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="products" class="ashik table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Order Products</th>
                                    <th>Payment Method</th>
                                    <th>Grand Total</th>
                                    <th>Created At</th>
                                    <th> </th>

                                </tr>
                                </thead>
                                <tbody>
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
                                            <a class="btn btn-primary" href="{{url('admin/orders-details/'.$order['id'])}}">view </a>
                                            <a class="btn btn-primary" href="{{url('admin/orders-invoice/'.$order['id'])}}">invoice </a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
