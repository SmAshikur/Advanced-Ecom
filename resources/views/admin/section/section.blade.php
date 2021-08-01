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

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with default features</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="section" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sections as $key)
                                    <tr>
                                        <td>{{$key->id}}</td>
                                        <td>{{$key->name}}</td>
                                        <td>
                                            @if($key['status']==1)
                                                <button class="btn btn-sm btn-success"><a class="check text-white" id="check-{{$key['id']}}" check_id="{{$key['id']}}" url="section"> Active </a></button>
                                            @elseif ($key['status']==0)
                                                <button class="btn btn-sm btn-danger"><a class="check text-white" id="check-{{$key['id']}}" check_id="{{$key['id']}} " url="section"> Inactive </a></button>

                                            @endif

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
