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

                      @if(!empty($proData['id']))
                      action="{{url('admin/add-product/'.$proData['id'])}}"
                      @else
                      action="{{url('admin/add-product')}}"
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
                                        <label for="product_name"> product name</label>
                                        <input name="product_name" placeholder="Enter category name" class="form-control" id="category_name" @if(!empty($proData['product_name']))
                                        value="{{$proData['product_name']}}" @else value="{{old('product_name')}}" @endif >
                                    </div>
                                    <div >

                                    </div>
                                    <div class="form-group">
                                        <label for="pattern">Select Brand</label>
                                        <select name="brand_id" id="brand_id" class="select2" data-placeholder="Select a Section" style="width: 100%">
                                            <option value=" ">select</option>
                                            @foreach($brands as $brand)
                                                <option value=" {{$brand['id']}}" @if(!empty($proData['brand_id'] ) && $proData['brand_id']==$brand['id']) selected=""  @endif>{{$brand['name']}} </option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for=" product_color">product_color</label>
                                        <input name="product_color" id=" product_color" type="text" class="form-control" placeholder="Enter product_color"  @if(!empty($proData['product_color']))
                                        value="{{$proData['product_color']}}" @else value="{{old('product_color')}}" @endif >

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        <select name="category_id" id="category_id" class="select2" data-placeholder="Select a Section" style="width: 100%">
                                            @foreach($categories as $section)
                                                <optgroup label="{{$section['name']}}">{{$section['name']}} </optgroup>
                                                @foreach($section['categories'] as $category)
                                                    <option value="{{$category['id']}}"
                                                        @if(!empty(@old('category_id')) && $category['id']== @old('category_id')) selected=""
                                                            @elseif(!empty ($proData['category_id']) && $proData['category_id']== $category['id']) selected=""
                                                        @endif>
                                                        &nbsp;&nbsp;&nbsp; -- &nbsp;&nbsp; {{$category['category_name']}} </option>
                                                    @foreach($category['subcategories'] as $subCats)
                                                        <option value="{{$subCats['id']}}"
                                                                @if(!empty(@old('category_id')) && $subCats['id']== @old('category_id')) selected=""
                                                                @elseif(!empty ($proData['category_id']) && $proData['category_id']== $subCats['id']) selected=""
                                                            @endif>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- &nbsp;&nbsp;&nbsp;&nbsp; {{$subCats['category_name']}} </option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="proImage">Image</label>
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input name="main_image" type="file" class="custom-file-input" id="proImage">
                                                 <label class="custom-file-label" for="proImage"> Chose Image</label>
                                             </div>
                                             <div class="input-group-append">
                                                 <span class="input-group-text"> Upload </span>
                                             </div>
                                         </div>
                                      @if(!empty($proData['main_image']))
                                            <div class="row">
                                                <div style="height: 50px">
                                                    <img class="h-100" src="{{asset('images/product_images/small/'.$proData['main_image'])}}">
                                                </div>
                                                <div  style="height: 50px" class="ml-5 mt-3">
                                                    <a href="javascript:void(0)" class="del" record="pro-img" recordId="{{$proData['id']}}"<?php /*href="{{url('admin/del-img/'.$catData->id)}}"*/ ?>>
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label for="video">video</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="product_video" type="file" class="custom-file-input" id="video">
                                                <label class="custom-file-label" for="catImage"> Chose Video</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> Upload </span>
                                            </div>
                                        </div>
                                        @if(!empty($proData['product_video']))
                                            <div class="row">
                                                <div style="height: 50px" class="ml-5 mt-3">
                                                    <a class="h-100" href="{{asset('images/videos/'.$proData['product_video'])}}" download> Download</a>
                                                </div>
                                                <div  style="height: 50px" class="ml-5 mt-3">
                                                    <a href="javascript:void(0)" class="del" record="video" recordId="{{$proData['id']}}"<?php /*href="{{url('admin/del-img/'.$catData->id)}}"*/ ?>>
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
                                        <label for=" product_price">product_price</label>
                                        <input name="product_price" id=" product_price" type="text" class="form-control" placeholder="Enter product_price"  @if(!empty($proData['product_price']))
                                        value="{{$proData['product_price']}}" @else value="{{old('product_price')}}" @endif >
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" product_code">product_code</label>
                                        <input name="product_code" id=" catUrl" type="text" class="form-control" placeholder="Enter product_code"  @if(!empty($proData['product_code']))
                                        value="{{$proData['product_code']}}" @else value="{{old('product_code')}}" @endif >
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" product_discount">product_discount</label>
                                        <input name="product_discount" id=" product_discount" type="product_discount" class="form-control" placeholder="Enter product_discount"  @if(!empty($proData['product_discount']))
                                        value="{{$proData['product_discount']}}" @else value="{{old('product_discount')}}" @endif >
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_weight">product_weight</label>
                                        <input name="product_weight" id=" product_weight" type="text" class="form-control" placeholder="Enter product_weight"  @if(!empty($proData['product_weight']))
                                        value="{{$proData['product_weight']}}" @else value="{{old('product_weight')}}" @endif >
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="wash_care">wash_care </label>
                                        <input name="wash_care" id="wash_care" type="text" class="form-control" placeholder="Enter wash_care" @if(!empty($proData['wash_care ']))
                                        value="{{$proData['wash_care']}}" @else value="{{old('wash_care')}}" @endif >
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="fabric">Select Fabric</label>
                                        <select name="fabric" id="fabric" class="select2" data-placeholder="Select a Section" style="width: 100%">
                                            <option value=" ">select</option>
                                            @foreach($fabArry as $fab)
                                                <option value=" {{$fab}}" @if(!empty($proData['fabric'] ) && $proData['fabric']==$fab) selected=""  @endif>{{$fab}} </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="sleeve">Select Sleeve</label>
                                        <select name="sleeve" id="sleeve" class="select2" data-placeholder="Select a Section" style="width: 100%">
                                            <option value=" ">select</option>
                                            @foreach($sleeveArry as $sleeve)
                                                <option value=" {{$sleeve}}" @if(!empty($proData['sleeve'] ) && $proData['sleeve']==$sleeve) selected=""  @endif>{{$sleeve}} </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="pattern">Select Pattern</label>
                                        <select name="pattern" id="pattern" class="select2" data-placeholder="Select a Section" style="width: 100%">
                                            <option value=" ">select</option>
                                            @foreach($patternArry as $pattern)
                                                <option value=" {{$pattern}}" @if(!empty($proData['pattern'] ) && $proData['pattern']==$pattern) selected=""  @endif>{{$pattern}} </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="fit">Select Fit</label>
                                        <select name="fit" id="fit" class="select2" data-placeholder="Select a Section" style="width: 100%">
                                            <option value=" ">select</option>
                                            @foreach($fitArry as $fit)
                                                <option value=" {{$fit}}" @if(!empty($proData['fit'] ) && $proData['fit']==$fit) selected=""  @endif>{{$fit}} </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="occasion">Select Occasion</label>
                                        <select name="occasion" id="occasion" class="select2" data-placeholder="Select a Section" style="width: 100%">
                                            <option value=" ">select</option>
                                            @foreach($occasionArry as $occ)
                                                <option value=" {{$occ}}" @if(!empty($proData['occasion'] ) && $proData['occasion']==$occ) selected=""  @endif>{{$occ}} </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" catDescription">Category Description</label>
                                        <textarea name="description" id=" catDescription" rows="3" class="form-control" placeholder="Enter category Description">
                                             @if(!empty($proData['description']))
                                                {{$proData['description']}} @else {{old('description')}} @endif
                                        </textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label  for="metaTitle">Meta Title</label>
                                        <input type="text"  name="meta_title" id="metaTitle" class="form-control" placeholder="Enter category Url"  @if(!empty($proData['meta_title']))
                                        value="{{$proData['meta_title']}}" @else value="{{old('meta_title')}}" @endif >

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" metaKeywords">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" id=" metaKeywords" class="form-control" placeholder="Enter category Meta Keywords"  @if(!empty($proData['meta_keywords']))
                                        value="{{$proData['meta_keywords']}}" @else value="{{old('meta_keywords')}}" @endif >

                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for=" metaDescription">Meta Description</label>
                                        <input type="text" name="meta_description" id=" metaDescription" class="form-control" placeholder="Enter meta Description"  @if(!empty($proData['meta_description']))
                                        value="{{$proData['meta_description']}}" @else value="{{old('meta_description')}}" @endif >

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6 ">
                                    <div class="form-group">
                                        <label for=" is_featured">Feature </label>
                                        <input name="is_featured" id="is_featured" type="checkbox" class="custom-checkbox"  value="1"
                                               @if(!empty($proData['is_featured'] ) && $proData['is_featured']=="yes") checked=""  @endif  >
                                    </div>
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
