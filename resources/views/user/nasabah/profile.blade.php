@extends('layouts.admin-lte')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href=" {{ route('user.index', 'nasabah') }} ">Data Nasabah</a></li>
            <li class="breadcrumb-item active">Profile Nasabah</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{ $user->profile_picture }}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ $user->name }}</h3>

              <p class="text-muted text-center">{{ ucwords($role) }}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Total Penyetoran Sampah</b> <br> <a class="float-right">{{ Str::decimalForm($tabungan->sum('berat')) ?? 0 }} Kg</a>
                </li>
                <li class="list-group-item">
                  <b>Total Debit</b> <br> <a class="float-right">{{ Str::decimalForm($tabungan->sum('debet') ?? 0, true) }}</a>
                </li>
                <li class="list-group-item">
                  <b>Total Kredit</b> <br> <a class="float-right">{{ Str::decimalForm($tabungan->sum('kredit') ?? 0, true) }}</a>
                </li>
                <li class="list-group-item">
                  <b>Saldo</b> <br> <a class="float-right">{{ Str::decimalForm($tabungan->last()->saldo ?? 0 , true) }}</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About Him</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
              
              <p class="text-muted">{{ $user->location }}</p>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> --}}
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                      <span class="username">
                        <a href="#">Jonathan Burke Jr.</a>
                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                      </span>
                      <span class="description">Shared publicly - 7:30 PM today</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      Lorem ipsum represents a long-held tradition for designers,
                      typographers and the like. Some people hate it and argue for
                      its demise, but others ignore the hate as they create awesome
                      tools to help create filler text for everyone from bacon lovers
                      to Charlie Sheen fans.
                    </p>

                    <p>
                      <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                      <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                      <span class="float-right">
                        <a href="#" class="link-black text-sm">
                          <i class="far fa-comments mr-1"></i> Comments (5)
                        </a>
                      </span>
                    </p>

                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                  </div>
                  <!-- /.post -->

                  <!-- Post -->
                  <div class="post clearfix">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                      <span class="username">
                        <a href="#">Sarah Ross</a>
                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                      </span>
                      <span class="description">Sent you a message - 3 days ago</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      Lorem ipsum represents a long-held tradition for designers,
                      typographers and the like. Some people hate it and argue for
                      its demise, but others ignore the hate as they create awesome
                      tools to help create filler text for everyone from bacon lovers
                      to Charlie Sheen fans.
                    </p>

                    <form class="form-horizontal">
                      <div class="input-group input-group-sm mb-0">
                        <input class="form-control form-control-sm" placeholder="Response">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-danger">Send</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.post -->

                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                      <span class="username">
                        <a href="#">Adam Jones</a>
                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                      </span>
                      <span class="description">Posted 5 photos - 5 days ago</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="row mb-3">
                      <div class="col-sm-6">
                        <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-6">
                        <div class="row">
                          <div class="col-sm-6">
                            <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                            <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-6">
                            <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                            <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <p>
                      <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                      <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                      <span class="float-right">
                        <a href="#" class="link-black text-sm">
                          <i class="far fa-comments mr-1"></i> Comments (5)
                        </a>
                      </span>
                    </p>

                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                  </div>
                  <!-- /.post -->
                </div>
                <!-- /.tab-pane -->
                

                <div class="tab-pane" id="settings">
                  <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{{ route('update.user') }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <input type="hidden" id="user_id" name="user_id">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" for="inputName2">Nama</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control @error('name', 'edit') is-invalid @enderror" value="{{ $user->name }}" name="name" id="inputName2" placeholder="Masukkan nama">
                              @error('name', 'edit')
                                <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" for="exampleInputEmail2">Alamat Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control @error('email', 'edit') is-invalid @enderror" value="{{ $user->email }}" name="email" id="exampleInputEmail2" placeholder="Masukkan email">
                              @error('email', 'edit')
                                <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                              @enderror  
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" for="exampleInputPassword2">Password</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control @error('password', 'edit') is-invalid @enderror" name="password" id="exampleInputPassword2" placeholder="Password">
                              @error('password', 'edit')
                                <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" for="inputNoTelephone2">No Telepon</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control @error('no_telephone', 'edit') is-invalid @enderror" value="{{ $user->no_telephone }}" name="no_telephone" id="inputNoTelephone2" placeholder="No Telepon">
                              @error('no_telephone', 'edit')
                                <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" for="inputLokasi2">Alamat</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control @error('location', 'edit') is-invalid @enderror" value="{{ $user->location }}" name="location" id="inputLokasi2" placeholder="Alamat">
                            @error('location', 'edit')
                              <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" for="exampleInputFile2">Profile Picture</label>
                          <div class="col-sm-10">
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="profile_picture" id="exampleInputFile2">
                                <label class="custom-file-label @error('profile_picture', 'edit') is-invalid @enderror" for="exampleInputFile2">Choose file</label>
                                  @error('location', 'edit')
                                    <strong class="error-message" style="color: hsl(218, 77%, 88%);">{{ $message }}</strong>
                                  @enderror
                              </div>  
                            </div>
                          </div>
                        </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="edit btn btn-danger">Simpan Perubahan</button>
                        </div>
                      </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection