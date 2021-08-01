<?php use App\Models\Product ?>
@extends('layouts.userLayout.userDesign')
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li><a href="{{url('/'.$proDetails['category']['url'])}}">{{$proDetails['category']['category_name']}}</a> <span class="divider">/</span></li>
            <li class="active">{{$proDetails['product_name']}}</li>
        </ul>
        <div class="row">
            <div id="gallery" class="span3">
                <a href="{{asset('images/product_images/medium/'.$proDetails['main_image'])}}" title="{{$proDetails['product_name']}}">
                    <img src="{{asset('images/product_images/medium/'.$proDetails['main_image'])}}" style="width:100%" alt="{{$proDetails['product_name']}}"/>
                </a>
                <div id="differentview" class="moreOptopm carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach($proDetails['attrs_img'] as $image)
                            <a href="{{asset('images/product_images/medium/'.$image['image'])}}">
                                <img style="width:29%" src="{{asset('images/product_images/medium/'.$image['image'])}}" alt=""/></a>
                            @endforeach
                        </div>

                    </div>
                    <!--
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                    -->
                </div>

                <div class="btn-toolbar">
                    <div class="btn-group">
                        <span class="btn"><i class="icon-envelope"></i></span>
                        <span class="btn" ><i class="icon-print"></i></span>
                        <span class="btn" ><i class="icon-zoom-in"></i></span>
                        <span class="btn" ><i class="icon-star"></i></span>
                        <span class="btn" ><i class=" icon-thumbs-up"></i></span>
                        <span class="btn" ><i class="icon-thumbs-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="span6">
                @if(Session::has('fail'))
                    <div class="alert alert-danger  " role="alert">
                        {{Session::get('fail')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success " role="alert">
                        {{Session::get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h3>{{$proDetails['product_name']}} </h3>
                <small>- {{$proDetails['brand']['name']}} </small>
                <hr class="soft"/>
                <small class="stock">{{$stock}} items in stock</small>
                <form action="{{url('/add-cart')}}" method="post" class="form-horizontal qtyFrm">@csrf
                    <input type="hidden" name="product_id" value="{{$proDetails['id']}}">
                    <div class="control-group">
                        <?php $discountedPrice= Product::discount($proDetails['id']) ?>
                            @if($discountedPrice>0)
                           <del><h4 class="price">Rs.{{$proDetails['product_price']}} </h4></del>
                            @else
                                <h4 class="price">Rs.{{$proDetails['product_price']}} </h4>
                            @endif
                            @if($discountedPrice>0)

                            @endif
                            <h4 class="disPrice">Rs.{{$discountedPrice}} </h4>
                        <select name="size" id="getPrice" product-id="{{$proDetails['id']}}" class="span2 pull-left" required>
                            <option id="hide" value="hide">Select Size</option>
                            @foreach($proDetails['attrs'] as $attr)
                            <option value="{{$attr['size']}}">{{$attr['size']}}</option>
                            @endforeach
                        </select>
                        <input type="number" name="quantity" class="span1" placeholder="Qty." required/>
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
                    </div>
                </form>
              </div>


            <hr class="soft clr"/>
            <p class="span6">
                {{$proDetails['description']}}
            </p>
            <a class="btn btn-small pull-right" href="#detail">More Details</a>
            <br class="clr"/>
            <a href="#" name="detail"></a>
            <hr class="soft"/>
        </div>

        <div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <h4>Product Information</h4>
                    <table class="table table-bordered">
                        <tbody>
                        <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
                        <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{$proDetails['brand']['name']}} </td></tr>
                        <tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{$proDetails['product_code']}} </td></tr>
                        <tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">{{$proDetails['product_color']}} </td></tr>
                        @if(!empty($proDetails['fabric'] ))
                        <tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{$proDetails['fabric']}} </td></tr>
                        @endif
                        @if(!empty($proDetails['sleeve'] ))
                            <tr class="techSpecRow"><td class="techSpecTD1">Sleeve:</td><td class="techSpecTD2">{{$proDetails['sleeve']}} </td></tr>
                        @endif
                        @if(!empty($proDetails['pattern'] ))
                            <tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{$proDetails['pattern']}} </td></tr>
                        @endif
                        @if(!empty($proDetails['fit'] ))
                            <tr class="techSpecRow"><td class="techSpecTD1">Fit:</td><td class="techSpecTD2">{{$proDetails['fit']}} </td></tr>
                        @endif
                        @if(!empty($proDetails['occasion'] ))
                            <tr class="techSpecRow"><td class="techSpecTD1">Occasion:</td><td class="techSpecTD2">{{$proDetails['occasion']}} </td></tr>
                        @endif
                        </tbody>
                    </table>

                    <h5>Washcare</h5>
                    <p>{{$proDetails['wash_care']}}</p>
                    <h5>Disclaimer</h5>
                    <p>
                        {{$proDetails['meta_description']}}
                    </p>
                </div>
                <div class="tab-pane fade" id="profile">
                    <div id="myTab" class="pull-right">
                        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
                        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
                    </div>
                    <br class="clr"/>
                    <hr class="soft"/>
                    <div class="tab-content">
                        <div class="tab-pane" id="listView">
                            @foreach($related as $pro)
                                <div class="row">
                                    <div class="span2">
                                        @if(!empty($pro['main_image']) && file_exists("images/product_images/medium/".$pro['main_image']))
                                            <img  style="height: 240px"   src="{{asset('images/product_images/medium/'.$pro['main_image'])}}">
                                        @else
                                            <img  style="height: 240px"   src="{{asset('images/dummy.png')}}">
                                        @endif
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
                            <ul class="thumbnails">
                                @foreach($related as $pro)
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a href="{{url('/'.$pro['product_name'].'/'.$pro['product_code'].'/'.$pro['id'])}}">
                                                @if(!empty($pro['main_image']) && file_exists("images/product_images/medium/".$pro['main_image']))
                                                    <img  style="height: 240px"   src="{{asset('images/product_images/medium/'.$pro['main_image'])}}">
                                                @else
                                                    <img  style="height: 240px"   src="{{asset('images/dummy.png')}}">
                                                @endif
                                            </a>
                                            <div class="caption">
                                                <h5>{{$pro['product_name']}}</h5>
                                                <p>
                                                    @if(!empty( $pro['brand']['name']))
                                                        {{$pro['brand']['name']}}
                                                    @endif
                                                </p>
                                                <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a>
                                                    <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a>
                                                    <a class="btn btn-primary" href="#">{{$pro['product_price']}}</a></h4>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <hr class="soft"/>
                        </div>
                    </div>
                    <br class="clr">
                </div>
            </div>
        </div>
    </div>
@endsection
