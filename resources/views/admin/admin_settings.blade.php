@extends('layouts.adminLayout.adminDesign')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-6 offset-3 ">
                      <!-- general form elements -->
                      <div class="card card-primary">
                          <div class="card-header">
                              <h3 class="card-title">Quick Example</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          @if(Session::has('fail'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  {{Session::get('fail')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                          @endif
                          @if(Session::has('success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  {{Session::get('success')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                          @endif
                          <form action="{{url('/admin/update-pwd')}}" method="post" name="passwordForm" id="passwordForm"> @csrf
                              <div class="card-body">
                                  <!--<div class="form-group">
                                      <label for="exampleInputEmail1">Name</label>
                                      <input readonly type="email" class="form-control" value="{{$adminDetails->name}} " placeholder="Enter Name....." id="adminName" name="adminName">
                                  </div> -->
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Email</label>
                                      <input type="email" class="form-control" value="{{$adminDetails->email}} " readonly>
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Role</label>
                                      <input type="email" class="form-control" value="{{$adminDetails->type}} " readonly>
                                  </div>
                                  <div class="form-group">
                                      <label for="current_pwd">Password</label>
                                      <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="Enter current Password" required>
                                      <span id="chkPwd" class="alert-warning"> </span>
                                      <span id="chkPwd1" class="alert-success"> </span>
                                  </div>
                                  <div class="form-group">
                                      <label for="new_pwd">Password</label>
                                      <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="Enter new Password" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="confirm_pwd">Password</label>
                                      <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder=" Confirm new Password" required>
                                  </div>
                                      <span id="conPwd" class="alert-warning"> </span>
                                      <span id="conPwd1" class="alert-success"> </span>
                              </div>
                              <!-- /.card-body -->

                              <div class="card-footer " >
                                  <div class="offset-5">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                      <!-- /.card -->

                      <!-- general form elements -->

                      <!-- /.card -->

                      <!-- Input addon -->

                      <!-- /.card -->
                      <!-- Horizontal Form -->

                      <!-- /.card -->

                  </div>
                  <!--/.col (left) -->
                  <!-- right column -->

                  <!--/.col (right) -->
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
