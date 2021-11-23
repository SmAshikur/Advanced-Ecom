<?php use App\Models\Product?>
@extends('layouts.userLayout.userDesign')
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active"> Thanks</li>
        </ul>

        <hr class="soft"/>
        @if(Session::has('fail'))
            <div class="alert alert-danger  " role="alert">
                {{Session::get('fail')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert  " role="alert">
                {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

       <h3>YOUR ORDER HAS BEEN PLEACED SUCCESSFULLY</h3>
        <p> Your order number is {{Session::get('order_id')}} And Grand total is
            {{Session::get('grand_total')}} </p>
    </div>
@endsection
<?php
    Session::forget('grand_total');
    Session::forget('order_id');
?>
