@extends('layouts.userLayout.userDesign')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
        <li class="active">Login</li>
    </ul>
    <h3> Login</h3>
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
                <form action="{{url('register')}} " method="post" id="userLogin"> @csrf
                    <div class="control-group">
                        <label class="control-label" for="inputName">Name</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputName" name="name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail0">E-mail address</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputEmail0" name="email">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inpuPassword">Password</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inpuPassword" name="password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputMobile">Mobile</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="inputMobile" name="mobile">
                        </div>
                    </div>
                    <div class="controls">
                        <button type="submit" class="btn block">Create Your Account</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="span1"> &nbsp;</div>
        <div class="span4">
            <div class="well">
                <h5>ALREADY REGISTERED ?</h5>
                <form action="{{url('login')}}" method="post">@csrf
                    <div class="control-group">
                        <label class="control-label" for="inputEmail1">Email</label>
                        <div class="controls">
                            <input class="span3" name="email" type="text" id="inputEmail1" placeholder="Email">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword1">Password</label>
                        <div class="controls">
                            <input type="password"  name="password" class="span3"  id="inputPassword1" placeholder="Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">Sign in</button> <a href="forgetpass.html">Forget password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
