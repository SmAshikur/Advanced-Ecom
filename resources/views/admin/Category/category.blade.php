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
                                      <a href="{{url('admin/add-category')}}" class="btn btn-success"> Add Category </a>
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
                                        <th>Parent Category</th>
                                        <th>Section</th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cats as $ke)
                                        @if(!isset($ke->category->category_name))
                                            <?php $x="Root" ;?>
                                        @else
                                            <?php $x= $ke->category->category_name ;?>
                                        @endif
                                    <tr>
                                        <td>{{$ke->id}}</td>
                                        <td>{{$ke->category_name}}</td>
                                        <td>{{$x}}</td>
                                        <td>{{$ke->section->name}}</td>
                                        <td>{{$ke->url}}</td>
                                        <td>
                                            <div >
                                                @if($ke['status']==1)
                                                    <button class="btn btn-sm btn-success"><a class="check text-white" id="check-{{$ke['id']}}" check_id="{{$ke['id']}}" url="category"> Active </a></button>
                                                @elseif ($ke['status']==0)
                                                    <button class="btn btn-sm btn-danger"><a class="check text-white" id="check-{{$ke['id']}}" check_id="{{$ke['id']}} " url="category"> Inactive </a></button>

                                                @endif
                                            </div>

                                        </td>
                                        <td>
                                            <button class="btn btn-success">
                                                <a href="{{url('admin/add-category/'.$ke->id)}}">
Edit
                                                </a>
                                            </button>
                                            <button class="btn btn-danger">
                                                <a href="javascript:void (0)" class="del" record="cat" recordId="{{$ke->id}}" <?php /*href="{{url('admin/del-cat/'.$ke->id)}}" */?>>
                                                    Delete
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
