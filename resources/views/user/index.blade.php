<?php use App\Models\Product ?>
@extends('layouts.userLayout.userDesign')
@section('content')


    <div class="span9">
        <div class="well well-small" style="box-sizing: border-box">
            <h4>Featured Products <small class="pull-right">{{$featureCount}} featured products</small></h4>
            <div class="row-fluid">
                <div id="featured" @if($featureCount>4) class="carousel slide " @endif>
                    <div class="carousel-inner" >
                        @foreach($featureItemsChunk as $key => $featureItems)
                            <div class="item @if($key==0) active @endif">
                                <ul class="thumbnails">
                                    @foreach($featureItems as $item)
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <i class="tag"></i>
                                                <a href="{{url('/'.$item['product_name'].'/'.$item['product_code'].'/'.$item['id'])}}">
                                                    @if(!empty($item['main_image']) && file_exists("images/product_images/medium/".$item['main_image']))
                                                        <img  style="height: 240px"   src="{{asset('images/product_images/medium/'.$item['main_image'])}}">
                                                    @else
                                                        <img  style="height: 240px"   src="{{asset('images/dummy.png')}}">
                                                    @endif

                                                </a>
                                                <div class="caption">
                                                    <h5>{{$item['product_name']}}</h5>
                                                    <?php $discountedPrice= Product::discount($item['id']) ?>
                                                    <h4><a class="btn" href="{{url('/'.$item['product_name'].'/'.$item['product_code'].'/'.$item['id'])}}">VIEW</a>


                                                           <span class="pull-right">
                                                                <a class="btn btn-primary" >
                                                           @if($discountedPrice>0)
                                                                <del>{{$item['product_price']}}</del>
                                                            @else
                                                                {{$item['product_price']}}
                                                            @endif
                                                                </a>
                                                        </span>

                                                    </h4>
                                                    <h3 style="text-align:center ">


                                                            @if($discountedPrice>0)
                                                            <a class="btn btn-success  " style="padding: 5px 20px" href="#">
                                                                <b> Discount
                                                                    @if(isset($item['product_discount'])&& !empty($item['product_discount']))
                                                                    {{$item['product_discount']}}%
                                                                    @else
                                                                        {{$item['category']['category_discount']}}%
                                                                    @endif

                                                                    <br> <i class="icon-shopping-cart"></i></b>{{$discountedPrice}}
                                                            </a>
                                                                @else($discountedPrice>0)
                                                                    <a class="btn btn-secondary  " style="padding: 5px 30px " href="#">
                                                                    <b> No Discount<br> <i class="icon-shopping-cart"></i></b>
                                                                    </a>
                                                                @endif
                                                            </b>
                                                       </h3>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#featured" data-slide="next">›</a>
                </div>
            </div>
        </div>
        <h4>Latest Products </h4>
       <div class="card" style="box-sizing: border-box">
           <ul class="thumbnails">
               @foreach($newPro as $pro)
                   <li class="span3">
                       <div class="thumbnail">
                           <a  href="{{url('/'.$item['product_name'].'/'.$item['product_code'].'/'.$item['id'])}}">
                               @if(!empty($pro['main_image']) && file_exists("images/product_images/medium/".$pro['main_image']))
                                   <img style="height: 240px"  src="{{asset('images/product_images/medium/'.$pro['main_image'])}}" class="img-fluid rounded" >
                               @else
                                   <img style="height: 240px"  class="img-fluid rounded"   src="{{asset('images/dummy.png')}}">
                               @endif
                           </a>
                           <div class="caption">
                               <h5>{{$pro['product_name']}}</h5>
                               <p>
                                   {{$pro['description']}}
                               </p>

                               <?php $discountedPrice= Product::discount($item['id']) ?>
                               <h4 style="text-align:center"><a class="btn" href="{{url('/'.$pro['product_name'].'/'.$pro['product_code'].'/'.$pro['id'])}}"> <i class="icon-zoom-in"></i></a>
                                   <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a>
                                   <a class="btn btn-primary" href="#">
                                       @if($discountedPrice>0)
                                           <del>{{$pro['product_price']}}</del>
                                       @else
                                           {{$pro['product_price']}}
                                       @endif
                                   </a></h4>
                               <h3 style="text-align:center ">

                                   <a class="btn btn-success  " style="padding: 10px 20px" href="#">
                                       <b> Discounted Price <i class="icon-shopping-cart"></i>
                                           @if($discountedPrice>0)
                                               {{$discountedPrice}}
                                           @endif
                                       </b>
                                   </a></h3>
                           </div>
                       </div>
                   </li>
               @endforeach
           </ul>
       </div>
    </div>
@endsection
