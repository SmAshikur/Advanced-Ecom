@extends('layouts.userLayout.userDesign')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
        <li class="active">Login</li>
    </ul>
    <h4>Account
        <a class="btn btn-large btn-primary pull-right m-2" href="{{url('cart')}}">  Go to Cart </a>
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
                <h5>CREATE YOUR ACCOUNT</h5><br/>
                Enter your e-mail address to create an account.<br/><br/><br/>
                <form action="{{url('update-account/'.$user['id'])}} " method="post" > @csrf
                    <div class="control-group">
                        <label class="control-label" for="inputName">Name</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="name" value="{{$user['name']}}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputName">Address</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="address" value="{{$user['address']}}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputName">City</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="city" value="{{$user['city']}}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputName">Country</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="country" value="{{$user['country']}}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputName">Zipcode</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="zipcode" value="{{$user['zipcode']}}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail0">E-mail address</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputEmail0" name="email" value="{{$user['email']}}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputMobile">Mobile</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputMobile" name="mobile" value="{{$user['mobile']}}">
                        </div>
                    </div>
                    <div class="controls">
                        <button type="submit" class="btn block">Update Account</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="span1"> &nbsp;</div>
        <div class="span4">
            <div class="well">
                <h5>Update Password</h5>
                <form action="{{url('update-user-pwd')}}" method="post">@csrf
                    <div class="control-group">
                        <label class="control-label" for="current_pwd">Current Password </label>
                        <div class="controls">
                            <input class="span3" name="current_pwd" type="password" id="current_pwd" placeholder="Enter Password">
                            <p> <span  id="chk_pwd"> </span></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="new_pwd"> New Password </label>
                        <div class="controls">
                            <input class="span3" name="new_pwd" type="password" id="new_pwd" placeholder="Enter New Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="confirm_pwd">Confirm Password </label>
                        <div class="controls">
                            <input class="span3" name="confirm_pwd" type="password" id="confirm_pwd" placeholder="Enter Confirm Password">
                            <p> <span  id="chk2_pwd"> </span></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">Sign in</button> update password
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
