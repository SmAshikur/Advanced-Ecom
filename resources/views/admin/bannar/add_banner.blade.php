@extends('layouts.adminLayout.adminDesign')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$title}}</h1>
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
                <form name="addCatForm" id="addCatForm" enctype="multipart/form-data" method="post"

                      @if(!empty($getBanner['id']))
                      action="{{url('admin/add-banner/'.$getBanner['id'])}}"
                      @else
                      action="{{url('admin/add-banner')}}"
                      @endif >@csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Select2 (Default Theme)</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="link"> Link </label>
                                        <input name="link" placeholder="Enter link" class="form-control" id="link" @if(!empty($getBanner['link']))
                                        value="{{$getBanner['link']}}" @else value="{{old('link')}}" @endif >
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input name="title" placeholder="Enter category name" class="form-control" id="title" @if(!empty($getBanner['title']))
                                        value="{{$getBanner['title']}}" @else value="{{old('title')}}" @endif >
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="altTag"> Alt Tag</label>
                                        <input name="altTag" placeholder="Enter category name" class="form-control" id="altTag" @if(!empty($getBanner['altTag']))
                                        value="{{$getBanner['altTag']}}" @else value="{{old('altTag')}}" @endif >
                                    </div>  <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="catImage">Image</label>
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input name="image" type="file" class="custom-file-input" id="image">
                                                 <label class="custom-file-label" for="image"> Chose Image</label>
                                             </div>
                                             <div class="input-group-append">
                                                 <span class="input-group-text"> Upload </span>
                                             </div>
                                         </div>
                                      @if(!empty($getBanner['image']))
                                            <div class="row">
                                                <div style="height: 50px">
                                                    <img class="h-100" src="{{asset('images/bannar_images/'.$getBanner['image'])}}">
                                                </div>
                                                <div  style="height: 50px" class="ml-5 mt-3">
                                                    <a href="javascript:void(0)" class="del" record="ban-img" recordId="{{$getBanner['id']}}"<?php /*href="{{url('admin/del-img/'.$catData->id)}}"*/ ?>>
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>


                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                           <button type="submit" class="btn btn-danger"> Submit</button>
                        </div>
                    </div>
                <!-- /.card -->
                </form>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
