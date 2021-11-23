@extends('layouts.userLayout.userDesign')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
        <li class="active">Login</li>
    </ul>
    <h4>{{$title}}
        <a class="btn btn-large btn-primary pull-right m-2" href="{{url('check-out')}}">  Back </a>
       <!-- <a href="{{url('account-update-pwd')}}" class="btn btn-large pull-right"> Update Password </a>  --> </h4>
    <hr class="soft"/>

    <div class="row">
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
        <div class="span4">
            <div class="well">
                <h5>{{$title}}</h5><br/>
                <form @if(empty($address['id'])) action="{{url('add-delivery')}} "
                      @else action="{{url('add-delivery/'.$address['id'])}} "@endif
                      method="post" > @csrf
                    <div class="control-group">
                        <label class="control-label" for="inputName">Name</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="name"  @if(!empty($address['name']))
                            value="{{$address['name']}}" @else value="{{old('name')}}" @endif  >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputName">Address</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="address" @if(!empty($address['address']))
                            value="{{$address['address']}}" @else value="{{old('address')}}" @endif  >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputName">City</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="city" @if(!empty($address['city']))
                            value="{{$address['city']}}" @else value="{{old('city')}}" @endif >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputName">Country</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="country" @if(!empty($address['country']))
                            value="{{$address['country']}}" @else value="{{old('country')}}" @endif  >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputMobile">Mobile</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputMobile" name="mobile" @if(!empty($address['mobile']))
                            value="{{$address['mobile']}}" @else value="{{old('mobile')}}" @endif  >
                        </div>
                    </div>
                    <div class="controls">
                        <button type="submit" class="btn block">Add Delivery Address</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="span1"> &nbsp;</div>

    </div>

</div>
@endsection
