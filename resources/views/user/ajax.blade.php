<?php use App\Models\Product; ?>
<ul class="thumbnails">
    @foreach($catPro as $pro)

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
                    <?php $discountedPrice= Product::discount($pro['id']) ?>
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
<hr class="soft"/>
