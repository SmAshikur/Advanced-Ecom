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

                      @if(!empty($catData['id']))
                      action="{{url('admin/add-category/'.$catData->id)}}"
                      @else
                      action="{{url('admin/add-category')}}"
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
                                        <label for="category_name"> Category name</label>
                                        <input name="category_name" placeholder="Enter category name" class="form-control" id="category_name" @if(!empty($catData['category_name']))
                                        value="{{$catData['category_name']}}" @else value="{{old('category_name')}}" @endif >
                                    </div>
                                    <div id="appendCat">
                                        @include('admin.Category.add_categoryAppend')
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Section</label>
                                        <select name="section_id" id="section_id" class="select2" data-placeholder="Select a Section" style="width: 100%">

                                            @foreach($getSection as $section)

                                                <option value="{{$section->id}}"
                                                        @if(!empty($catData['section_id']) && $catData['section_id']== $section->id) selected @endif
                                                >{{$section->name}}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="catImage">Image</label>
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input name="category_image" type="file" class="custom-file-input" id="catImage">
                                                 <label class="custom-file-label" for="catImage"> Chose Image</label>
                                             </div>
                                             <div class="input-group-append">
                                                 <span class="input-group-text"> Upload </span>
                                             </div>
                                         </div>
                                      @if(!empty($catData['category_image']))
                                            <div class="row">
                                                <div style="height: 50px">
                                                    <img class="h-100" src="{{asset('images/cat_images/'.$catData['category_image'])}}">
                                                </div>
                                                <div  style="height: 50px" class="ml-5 mt-3">i
                                                    <a href="javascript:void(0)" class="del" record="img" recordId="{{$catData->id}}"<?php /*href="{{url('admin/del-img/'.$catData->id)}}"*/ ?>>
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
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" catUrl">Url</label>
                                        <input name="url" id=" catUrl" type="text" class="form-control" placeholder="Enter category Url"  @if(!empty($catData['url']))
                                        value="{{$catData['url']}}" @else value="{{old('url')}}" @endif >

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" catDiscount">Category Discount</label>
                                        <input name="category_discount" id=" catDiscount" type="text" class="form-control" placeholder="Enter Discount"  @if(!empty($catData['category_discount']))
                                        value="{{$catData['category_discount']}}" @else value="{{old('category_discount')}}" @endif >

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" catDescription">Category Description</label>
                                        <textarea name="description" id=" catDescription" rows="3" class="form-control" placeholder="Enter category Description">
                                             @if(!empty($catData['description']))
                                                {{$catData['description']}} @else {{old('description')}} @endif
                                        </textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label  for="metaTitle">Meta Title</label>
                                        <input type="text"  name="meta_title" id="metaTitle" class="form-control" placeholder="Enter category Url"  @if(!empty($catData['meta_title']))
                                        value="{{$catData['meta_title']}}" @else value="{{old('meta_title')}}" @endif >

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" catKeywords">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" id=" catKeywords" class="form-control" placeholder="Enter category Meta Keywords"  @if(!empty($catData['meta_keywords']))
                                        value="{{$catData['meta_keywords']}}" @else value="{{old('meta_keywords')}}" @endif >

                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" metaDescription">Meta Description</label>
                                        <input type="text" name="meta_description" id=" metaDescription" class="form-control" placeholder="Enter meta Description"  @if(!empty($catData['meta_description']))
                                        value="{{$catData['meta_description']}}" @else value="{{old('meta_description')}}" @endif >

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
