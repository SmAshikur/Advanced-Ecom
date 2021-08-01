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
                <form name="addCatForm" id="addCatForm"   method="post" action="{{url('admin/add-attrImg/'.$proData['id'])}}" enctype="multipart/form-data">@csrf
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
                                        <label for="product_name"> product Name :</label>
                                        {{$proData['product_name']}}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name"> product Code :</label>
                                        {{$proData['product_code']}}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name"> product Color:</label>
                                        {{$proData['product_color']}}
                                    </div>
                                    <div class="form-group">
                                        <label for="image"> product Image:</label>
                                        <input multiple="" type="file" id="image" name="image[]" value="" required="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <img style="width: 200px;" src="{{asset('images/product_images/small/'.$proData['main_image'])}}">

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
<form  method="post" action="{{url('admin/edit-pAttr/'.$proData['id'])}}"> @csrf

                    <div class="card-body">
                        @if(Session::has('fail2'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{Session::get('fail2')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <table id="products" class="ashik table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>

                                <th>Image</th>

                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($proData['attrs_img'] as $key)

                                <input style="display: none" name="atrrId[]" type="text" value="{{$key['id']}}">
                                <tr>
                                    <td>{{$key['id']}}</td>

                                    <td>

                                        <img style="width: 100px;" src="{{asset('images/product_images/small/'.$key['image'])}}">

                                    </td>

                                    <td>

                                        @if($key['status']==1)
                                            <button class="btn btn-sm btn-success"><a href="javascript:void(0)" class="check text-white" id="check-{{$key['id']}}" check_id="{{$key['id']}}" url="product-img"> Active </a></button>
                                        @elseif ($key['status']==0)
                                            <button class="btn btn-sm btn-danger"><a href="javascript:void(0)" class="check text-white" id="check-{{$key['id']}}" check_id="{{$key['id']}} " url="product-img"> Inactive </a></button>

                                        @endif
                                        <button class="btn btn-danger">
                                            <a href="javascript:void (0)" class="del" record="attrImg" recordId="{{$key['id']}}" <?php /*href="{{url('admin/del-cat/'.$ke->id)}}" */?>>
                                                Delete
                                            </a>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
    <div >
        <button type="submit" class="btn btn-danger"> Submit</button>
    </div>
</form>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
@endsection

