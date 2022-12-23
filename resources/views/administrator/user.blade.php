@include('administrator.header.header', $page)
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
            <!-- Main Navbar -->
            @include('administrator.navbar.navbar')
          </div>
          <!-- / .main-navbar -->
          <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Pengguna</span>
                <h3 class="page-title">List Data Pengguna</h3>
              </div>
            </div>

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


            <!-- End Page Header -->
             <div class="row">
                <div class="col">
                  <div class="card card-small mb-4 table-responsive">
                    <div class="card-header border-bottom">
                      <h6 class="m-0">{{$users->total()}} Pengguna Aktif</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                      <table class="table mb-0">
                        <thead class="bg-light">
                          <tr>
                            <th scope="col" class="border-0">ID</th>
                            <th scope="col" class="border-0">Nama</th>
                            <th scope="col" class="border-0">Email</th>
                            <th scope="col" class="border-0">Role</th>
                            <th scope="col" class="border-0">Ditambahkan pada tanggal</th>
                            <th scope="col" class="border-0">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $data)
                                <tr>
                                    <td>{{ $data->existence_number }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                      @foreach ($data->roles as $role)
                                          {{$role->name}}
                                      @endforeach
                                    </td>
                                    <td>{{ date('l, d M Y H:m', strtotime($data->created_at)) }}</td>
                                    @if ($data->roles[0]['name'] === 'Super-Admin')
                                      <td><a onclick="getData({{$data->id}}, '{{$data->name}}', '{{$data->email}}')" href="#edit-user" data-toggle="modal">Edit</a></td>
                                    @else
                                      <td><a onclick="getData({{$data->id}}, '{{$data->name}}', '{{$data->email}}')" href="#edit-user" data-toggle="modal">Edit</a> | <a onclick="setID({{$data->id}})" style="color: red" href="#del-user" data-toggle="modal">Hapus</a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              {{ $users->links('pagination::bootstrap-4') }}
              <div class="row">
                <div class="col-12">
                  <button data-toggle="modal" data-target="#add-user" class="btn-lg btn-primary">Tambah Pengguna</button>
                </div>
              </div>
          </div>

          <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Tambah Pengguna</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" action="/admin/users/add" method="post">
                          {{ csrf_field() }}
                          <label for="cars">Pilih Role</label>
                          <select class="form-control mb-1" name="role" id="roles">
                            <option value="writer">Penulis</option>
                            <option value="user-point">User Point</option>
                          </select>
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nama pengguna" name="name">
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan email pengguna" name="email">
                          <input class="btn btn-primary" type="submit" value="Tambah">
                        </form>
                        <div class="ml-auto">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Edit Pengguna</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" id="form_edit" method="post">
                          {{ csrf_field() }}
                          <input id="user_name" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nama pengguna" name="name">
                          <input id="user_email" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan email pengguna" name="email">
                          <input class="btn btn-primary" type="submit" value="Simpan perubahan">
                        </form>
                        <div class="ml-auto">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="del-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Yakin Hapus Pengguna ?</h3>
                      <div class="d-flex col-12">
                        <div class="ml-auto">
                          <form class="col-12" action="/admin/users/delete" method="post">
                            {{ csrf_field() }}
                            <input hidden type="text" name="user_id" id="user_id">
                            <input class="btn btn-danger" type="submit" value="Hapus">
                            <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Tidak</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <script>
            function setID(id){
              document.getElementById('user_id').value = id;
            }
            function getData(id, name, email){
                document.getElementById("form_edit").action = '/admin/users/edit/'+id;
                document.getElementById('user_name').value = name;
                document.getElementById('user_email').value = email;
            }
          </script>

          @include('administrator.footer.footer')