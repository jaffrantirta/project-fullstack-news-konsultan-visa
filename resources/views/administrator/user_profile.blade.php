@include('administrator.header.header', $page)
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
            <!-- Main Navbar -->
            @include('administrator.navbar.navbar')
          </div>
          <!-- / .main-navbar -->

          @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show rounded-5" role="alert">
                  <strong>{{ $error }}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endforeach
            @endif


            @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show rounded-5" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
          


          <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Pengguna</span>
                <h3 class="page-title">Profil Pengguna</h3>
              </div>
            </div>
            <!-- End Page Header -->
            <!-- Default Light Table -->

            <div class="row">

              <div class="col-lg-4">
                <div class="card card-small mb-4 table-responsive pt-3">
                  <div class="card-header border-bottom text-center">
                    <div class="mb-3 mx-auto">
                      <img class="rounded-circle" src="{{ asset('res/assets_administrator/images/avatars/1.jpeg') }}" alt="{{$user->name}}" width="110"> </div>
                    <h4 class="mb-0">{{$user->name}}</h4>
                    <span class="text-muted d-block mb-2">{{Auth::user()->roles[0]['name']}} | ID: {{$user->existence_number}}</span>
                  </div>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="card card-small mb-4 table-responsive">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Detail Akun</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col">
                          <form method="post" action="{{URL::to('admin/profile/update')}}">
                            {{ csrf_field() }}
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="feFirstName">Nama</label>
                                <input name="name" type="text" class="form-control" placeholder="Nama" value="{{$user->name}}"> </div>
                              <div class="form-group col-md-6">
                                <label for="feLastName">Email</label>
                                <input name="email" type="email" class="form-control" placeholder="Email" value="{{$user->email}}"> </div>
                            </div>
                            
                            <button type="submit" class="btn btn-accent">Simpan Perubahan</button>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="card card-small mb-4 table-responsive">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Ganti Password</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col">
                          <form method="post" action="{{URL::to('admin/profile/update/password')}}">
                            {{ csrf_field() }}
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="feFirstName">Password Lama</label>
                                <input name="old_password" type="password" class="form-control" placeholder="Masukan Password Lama"> </div>
                              <div class="form-group col-md-12">
                                <label for="feLastName">Password Baru</label>
                                <input name="new_password" type="password" class="form-control" placeholder="Masukan Password Baru" > </div>
                              <div class="form-group col-md-12">
                                <label for="feLastName">Password Baru Konfirmasi</label>
                                <input name="new_password_confirm" type="password" class="form-control" placeholder="Masukan lagi Password Baru" > </div>
                            </div>
                            
                            <button type="submit" class="btn btn-accent">Ganti Password</button>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
            <!-- End Default Light Table -->
          </div>
          @include('administrator.footer.footer')