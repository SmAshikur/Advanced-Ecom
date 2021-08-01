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
                              <h3 class="card-title">Update Admin Details</h3>
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
                          @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                          <form action="{{url('/admin/update-admin')}}" method="post" name="passwordForm" id="passwordForm" enctype="multipart/form-data"> @csrf
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Name</label>
                                      <input type="text" class="form-control" value="{{$adminDetails->name}} " placeholder="Enter Name....." id="adminName" name="adminName">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Email</label>
                                      <input type="email" class="form-control" value="{{$adminDetails->email}} " readonly>
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Role</label>
                                      <input type="email" class="form-control" value="{{$adminDetails->type}} " readonly>
                                  </div>
                                  <div class="form-group">
                                      <label for="current_pwd">Mobile</label>
                                      <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile" value="{{$adminDetails->mobile}}" >
                                  </div>
                                  <div class="form-group">
                                      <label for="new_pwd">image</label>
                                      <input type="file" class="form-control" id="image" name="image" placeholder="upload your image" >
                                      @if(!empty($adminDetails->image))
                                          <a target="_blank" href="{{url('images/admin/'.$adminDetails->image)}}"> view image </a>
                                          <input type="hidden" name="current_img" value="{{$adminDetails->image}}">
                                      @endif
                                  </div>

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
