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
                            <div class="card-header ">
                                <div class="row flex justify-content-around">
                                    <h3 class="card-title">DataTable with default features</h3>
                                    <h3 class="card-title">
                                        <button class="btn btn-success">
                                            <a class="text-white" href="{{url('admin/add-banner')}}">
                                                Add Brand
                                            </a>
                                        </button>
                                    </h3>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="section" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Title</th>
                                        <th>Alt Tag</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banner as $key)
                                        <tr>
                                            <td>{{$key->id}}</td>
                                            <td>
                                                @if(!empty($key['image']) && file_exists("images/bannar_images/".$key['image']))
                                                    <img  style="height: 40px ; width: 100px"   src="{{asset('images/bannar_images/'.$key['image'])}}">
                                                @else
                                                    <img  style="height: 40px ;width: 100px"   src="{{asset('images/dummy.png')}}">
                                                @endif
                                            </td>
                                            <td>{{$key->link}}</td>
                                            <td>{{$key->title}}</td>
                                            <td>{{$key->altTag}}</td>

                                            <td>
                                                @if($key['status']==1)
                                                    <button class="btn btn-sm btn-success"><a class="check text-white" id="check-{{$key['id']}}" check_id="{{$key['id']}}" url="banner"> Active </a></button>
                                                @elseif ($key['status']==0)
                                                    <button class="btn btn-sm btn-danger"><a class="check text-white" id="check-{{$key['id']}}" check_id="{{$key['id']}} " url="banner"> Inactive </a></button>

                                                @endif

                                            </td>
                                            <td  >
                                                <div  >
                                                    <button class="btn btn-warning mx-5 ">
                                                        <a href="{{url('admin/add-banner/'.$key->id)}}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </button>

                                                    <button class="btn btn-danger ">
                                                        <a href="javascript:void (0)" class="del" record="banner" recordId="{{$key['id']}}" <?php /*href="{{url('admin/del-cat/'.$ke->id)}}" */?>>
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </button>
                                                </div>

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
