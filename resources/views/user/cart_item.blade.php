<?php use App\Models\Product?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Product</th>
        <th colspan="2">Description</th>
        <th>Quantity/Update</th>
        <th>Price</th>
        <th>Discount</th>

        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <?php $totalPrice=0;$totalDis=0; ?>
    @foreach($userCart as $key)
        <?php $getPrice =Product::attrDiscount($key['product_id'],$key['size']); ?>
        <tr>
            <td> <img width="60" src="{{asset('images/product_images/small/'.$key['product']['main_image'])}}" alt=""/></td>
            <td colspan="2">{{$key['product']['product_name']}}<br/>Color :{{$key['product']['product_color']}}</td>
            <td>
                <div class="input-append">
                    <input class="span1" style="max-width:34px"  value="{{$key['quantity']}}" id="appendedInputButtons" size="16" type="text">
                    <button class="btn updateItem qMinus" data-cartid="{{$key['id']}}" type="button"><i class="icon-minus"></i></button>
                    <button class="btn updateItem qPlus" data-cartid="{{$key['id']}}" type="button"><i class="icon-plus"></i></button>
                    <button class="btn btn-danger deleteItem" data-cartid="{{$key['id']}}" type="button"><i class="icon-remove icon-white"></i></button>
                </div>
            </td>
            <td>Rs.{{$getPrice['product_price']}} BDT</td>
            <td>Rs.{{$getPrice['discount']}} BDT</td>

            <td>Rs.{{$getPrice['discounted_price']*$key['quantity']}} BDT </td>
        </tr>
        <?php $totalPrice= $totalPrice+ ($getPrice['discounted_price']*$key['quantity'])  ; ?>
    @endforeach

    <tr>
        <td colspan="6" style="text-align:right">Total Price: 	</td>
        <td>{{$totalPrice}} BDT</td>
    </tr>
    <tr>
        <td colspan="6" style="text-align:right">Coupon Discount:	</td>
        <?php  ?>
        <td  class="cop" >
            @if(Session::has('copAmount'))
                {{Session::get('copAmount')}} BDT
            @else
                00 BDT
            @endif
        </td>
    </tr>

    <tr>
        <td colspan="6" style="text-align:right"><strong>TOTAL ({{$totalPrice}} BDT -<span class="cop"> @if(Session::has('copAmount'))
                        {{Session::get('copAmount')}} BDT @else 00 BDT @endif</span>)  =</strong></td>
        <td class="label label-important" style="display:block"> <strong class="grand"> {{$totalPrice-Session::get('copAmount')}} BDT </strong></td>
    </tr>
    </tbody>
</table>
