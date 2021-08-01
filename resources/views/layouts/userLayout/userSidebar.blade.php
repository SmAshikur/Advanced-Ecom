<?php
use App\Models\Section;
$sections=Section::sections();
//$section=json_decode(json_encode($section),true);
//echo "<pre>";print_r($sections);die();


?>

<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="themes/images/ico-cart.png" alt="cart">3 Items in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach($sections as $sec)
            @if(count($sec['categories'])>0)
                <li class="subMenu"><a>{{$sec['name']}}</a>
            <ul>
                @foreach($sec['categories'] as $cat)
                    <li><a href="{{url($cat['category_name'])}}"><i class="icon-chevron-right"></i><strong>{{$cat['category_name']}}</strong></a></li>
                        @foreach($cat['subcategories'] as $subCat)
                             <li><a href="{{url($subCat['category_name'])}}"><i class="icon-chevron-right"></i>{{$subCat['category_name']}}</a></li>
                        @endforeach
                @endforeach
            </ul>

        </li>
            @endif
        @endforeach

    </ul>
    <br/>
    @if(isset($page_name) && $page_name=="listing")
    <div class="well well-small">
        <h5 class="text-center"> Fabric </h5>
        @foreach($fabArry as $fab)
            <input class="fab" type="checkbox" name="fab[]" id="{{$fab}}" value="{{$fab}}" >&nbsp;&nbsp; {{$fab}}<br>
        @endforeach
        <h5 class="text-center"> Sleeve </h5>
        @foreach($sleeveArry as $fab)
            <input class="sleeve"  type="checkbox" name="fab[]" id="{{$fab}}" value="{{$fab}}" >&nbsp;&nbsp; {{$fab}}<br>
        @endforeach
        <h5 class="text-center"> Pattern</h5>
        @foreach($patternArry as $fab)
            <input class="pattern"  type="checkbox" name="fab[]" id="{{$fab}}" value="{{$fab}}" >&nbsp;&nbsp; {{$fab}}<br>
        @endforeach
        <h5 class="text-center"> Fit </h5>
        @foreach($fitArry as $fab)
            <input class="fit"  type="checkbox" name="fab[]" id="{{$fab}}" value="{{$fab}}" >&nbsp;&nbsp; {{$fab}}<br>
        @endforeach
        <h5 class="text-center"> Occasion </h5>
        @foreach($occasionArry as $fab)
            <input class="occasion"  type="checkbox" name="fab[]" id="{{$fab}}" value="{{$fab}}" >&nbsp;&nbsp; {{$fab}}<br>
        @endforeach
    </div>
    @endif
    <div class="thumbnail">
        <img src="themes/images/payment_methods.png" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
