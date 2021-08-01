<?php use App\Models\Product ?>
@extends('layouts.userLayout.userDesign')
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $categoryDetails['breads'];?></li>
        </ul>
        <h3> {{$categoryDetails['catDetails']['category_name']}}<small class="pull-right"> {{count($catPro)-1}}++ Product are Available </small></h3>
        <hr class="soft"/>
        <p>
            {{$categoryDetails['catDetails']['description']}}
        </p>
        <hr class="soft"/>
        <form name="proSort" id="proSort" class="form-horizontal span6">
            <input type="hidden" name="url" id="url" value="{{$url}}">
            <div class="control-group">
                <label class="control-label alignL ">Sort By </label>
                <select name="sort" id="sort">
                    <option >Select</option>
                    <option value="latest" @if(isset($_GET['sort']) && ($_GET['sort'])=="latest") selected="" @endif>Product Latest</option>
                    <option value="a_z" @if(isset($_GET['sort']) && ($_GET['sort'])=="a_z") selected="" @endif>Product name A - Z</option>
                    <option value="z_a" @if(isset($_GET['sort']) && ($_GET['sort'])=="z_a") selected="" @endif>Product name Z - A</option>
                    <option value="high" @if(isset($_GET['sort']) && ($_GET['sort'])=="high") selected="" @endif>Price Highest first</option>
                    <option value="low" @if(isset($_GET['sort']) && ($_GET['sort'])=="low") selected="" @endif>Price Lowest first</option>
                </select>
            </div>
        </form>

        <div id="myTab" class="pull-right">
            <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
            <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
        </div>
        <br class="clr"/>
        <div class="tab-content">
            <div class="tab-pane" id="listView">
                @foreach($catPro as $pro)
                <div class="row">
                    <div class="span2">
                        <a href="{{url('/'.$pro['product_name'].'/'.$pro['product_code'].'/'.$pro['id'])}}">
                        @if(!empty($pro['main_image']) && file_exists("images/product_images/medium/".$pro['main_image']))
                            <img  style="height: 240px"   src="{{asset('images/product_images/medium/'.$pro['main_image'])}}">
                        @else
                            <img  style="height: 240px"   src="{{asset('images/dummy.png')}}">
                        @endif
                    </a>
                    </div>
                    <div class="span4">
                        <h3>  @if(!empty( $pro['brand']['name']))
                                {{$pro['brand']['name']}}
                            @endif</h3>
                        <hr class="soft"/>
                        <h5> {{$pro['product_name']}}</h5>
                        <p>
                            {{$pro['description']}}
                        </p>
                        <a class="btn btn-small pull-right" href="{{url('/'.$pro['product_name'].'/'.$pro['product_code'].'/'.$pro['id'])}}">View Details</a>
                        <br class="clr"/>
                    </div>
                    <div class="span3 alignR">
                        <form class="form-horizontal qtyFrm">
                            <h3> $140.00</h3>
                            <label class="checkbox">
                                <input type="checkbox">  Adds product to compair
                            </label><br/>

                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>

                        </form>
                    </div>
                </div>
                    <hr class="soft"/>
                @endforeach



            </div>
            <div class="tab-pane filter_pro active" id="blockView">
               @include('user.ajax');
            </div>
        </div>
        <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
        <div class="pagination row  m-auto">
            {{ $catPro->links() }}
        </div>
        <br class="clr"/>
    </div>
@endsection
