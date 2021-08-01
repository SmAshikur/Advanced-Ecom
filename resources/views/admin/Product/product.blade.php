@extends('layouts.adminLayout.adminDesign')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->
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

                        <div class="card">
                            <div class="card-header">
                                <div class="row flex justify-content-around ">
                                    <div >
                                        <h2 class="card-title text-bold pt-2 ">Category Table</h2>
                                    </div>
                                    <div >
                                        <a href="{{url('admin/add-product')}}" class="btn btn-success"> Add Category </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="ashik table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Section</th>
                                        <th>Section</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product as $ke)

                                        <tr>
                                            <td>{{$ke->id}}</td>
                                            <td>{{$ke->product_name}}</td>
                                            <td>{{$ke->category->category_name}}</td>
                                            <td>{{$ke->section->name}}</td>
                                            <th>

                                                @if(!empty($ke->main_image) && file_exists("images/product_images/small/".$ke->main_image))
                                                  <img style="width: 100px; height: 100px"   src="{{asset('images/product_images/small/'.$ke->main_image)}}">
                                                @else
                                                    <img style="width: 100px; height: 100px"   src="{{asset('images/dummy.png')}}">
                                                @endif
                                            </th>

                                            <td>
                                                <div >
                                                    @if($ke['status']==1)
                                                        <button class="btn btn-sm btn-success"><a class="check text-white" id="check-{{$ke['id']}}" check_id="{{$ke['id']}}" url="product"> Active </a></button>
                                                    @elseif ($ke['status']==0)
                                                        <button class="btn btn-sm btn-danger"><a class="check text-white" id="check-{{$ke['id']}}" check_id="{{$ke['id']}} " url="product"> Inactive </a></button>

                                                    @endif
                                                </div>

                                            </td>
                                            <td>
                                                <button class="btn btn-success">
                                                    <a href="{{url('admin/add-pAttr/'.$ke->id)}}">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-secondary">
                                                    <a href="{{url('admin/add-attrImg/'.$ke->id)}}">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-warning">
                                                    <a href="{{url('admin/add-product/'.$ke->id)}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </button>
                                                <button class="btn btn-danger">
                                                    <a href="javascript:void (0)" class="del" record="pro" recordId="{{$ke->id}}" <?php /*href="{{url('admin/del-cat/'.$ke->id)}}" */?>>
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
