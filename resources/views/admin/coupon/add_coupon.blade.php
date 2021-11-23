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

                      @if(!empty($couponData['id']))
                      action="{{url('admin/add-coupon/'.$couponData['id'])}}"
                      @else
                      action="{{url('admin/add-coupon')}}"
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
                                    @if(empty($coupon['coupon_code']))
                                        <div class="form-group">
                                            <label for="link"> Coupon Option : </label>&nbsp;
                                            <span> <input id="menuCoupon" name="coupon_option" type="radio" value="Manual">  Manual</span> &nbsp;&nbsp;
                                            <span> <input id="autoCoupon" name="coupon_option" type="radio" value="Automatic">  Automatic</span> &nbsp;
                                        </div>
                                        <div class="form-group" id="codeCoupon" style="display: none">
                                            <label for="coupon_code">Coupon Code</label>
                                            <input name="coupon_code" placeholder="Enter category name" class="form-control" id="coupon_code" @if(!empty($getBanner['title']))
                                            value="{{$getBanner['title']}}" @else value="{{old('title')}}" @endif >
                                        </div>
                                    @else
                                        <input type="hidden" name="coupon_option" value=" {{ $coupon['coupon_option'] }}">
                                        <input type="hidden" name="coupon_code" value=" {{ $coupon['coupon_code'] }}">
                                        <div class="form-group" >
                                            <label for="coupon_code">Coupon Code : </label>
                                             <span> {{ $coupon['coupon_code'] }}</span>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="type"> Coupon Type : </label>&nbsp;
                                        <span> <input id="menuCoupon" name="coupon_type" type="radio" value="single"
                                                      @if(isset($coupon['coupon_type']) && $coupon['coupon_type']=="single") checked @endif >  Single</span> &nbsp;&nbsp;
                                        <span> <input id="autoCoupon" name="coupon_type" type="radio" value="multiple"
                                                      @if(isset($coupon['coupon_type']) && $coupon['coupon_type']=="multiple") checked @endif > Multiple</span> &nbsp;
                                    </div>
                                    <div class="form-group">
                                        <label for="link"> Amount type : </label>&nbsp;
                                        <span> <input id="menuCoupon" name="amount_type" type="radio" value="percentage"
                                                      @if(isset($coupon['amount_type']) && $coupon['amount_type']=="percentage") checked @endif >  Percentage&nbsp;&nbsp; (%)</span> &nbsp;&nbsp;
                                        <span> <input id="autoCoupon" name="amount_type" type="radio" value="fixed"
                                                      @if(isset($coupon['amount_type']) && $coupon['amount_type']=="fixed") checked @endif >  Fixed &nbsp;&nbsp; (TK)</span> &nbsp;
                                    </div>
                                    <div class="form-group" >
                                        <label for="coupon_code">Amount</label>
                                        <input name="amount" placeholder="Enter category name" class="form-control" id="coupon_code" @if(!empty($coupon['amount']))
                                        value="{{$coupon['amount']}}" @else value="{{old('amount')}}" @endif >
                                    </div>
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        <select name="category[]"class="select2" data-placeholder="Select a Section" multiple style="width: 100%">
                                            @foreach($categories as $section)
                                                <optgroup label="{{$section['name']}}">{{$section['name']}} </optgroup>
                                                @foreach($section['categories'] as $category)
                                                    <option value="{{$category['id']}}"
                                                            @if(in_array($category['id'],$selCats)) selected=""
                                                        @endif>
                                                        &nbsp;&nbsp;&nbsp; -- &nbsp;&nbsp; {{$category['category_name']}} </option>
                                                    @foreach($category['subcategories'] as $subCats)
                                                        <option value="{{$subCats['id']}}"
                                                                @if(in_array($subCats['id'],$selCats)) selected=""
                                                            @endif>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- &nbsp;&nbsp;&nbsp;&nbsp; {{$subCats['category_name']}} </option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        <select name="user[]"class="select2" data-placeholder="Select a Section" multiple style="width: 100%">
                                            @foreach($users as $user)
                                                <option value="{{$user['email']}}"  @if(in_array($user['email'],$selUsers)) selected=""
                                                    @endif> {{$user['email']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="coupon_code">Expire Date</label>
                                        <input name="expire_date" type="date" class="form-control" id="coupon_code" @if(!empty($coupon['expire_date']))
                                        value="{{$coupon['expire_date']}}" @else value="{{old('expire_date')}}" @endif >
                                    </div>
                                </div>
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
