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
                <span class="text-uppercase page-subtitle">Tempat</span>
                {{-- <h3 class="page-title">List Data Point</h3> --}}
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
                      {{-- <h6 class="m-0">{{$point->total()}} Point Aktif</h6> --}}
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                      <table class="table mb-0">
                        <thead class="bg-light">
                          <tr>
                            <th scope="col" class="border-0">Nama</th>
                            <th scope="col" class="border-0">Ditambahkan pada</th>
                            <th scope="col" class="border-0">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @role('Super-Admin')
                            @foreach($point as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ date('l, d M Y H:m', strtotime($data->created_at)) }}</td>
                                    <td><a onclick="getData({{$data->id}}, '{{$data}}')" href="#edit-point" data-toggle="modal">Edit</a> | <a href="{{ URL::to('/admin'.'/'.$data->id.'/toilet') }}">Lihat Layanan</a></td>
                                </tr>
                            @endforeach
                          @endrole
                          @role('user-point')
                            @foreach($point as $data)
                                <tr>
                                    <td>{{ $data->building->name }}</td>
                                    <td>{{ date('l, d M Y H:m', strtotime($data->building->created_at)) }}</td>
                                    <td><a onclick="getData({{$data->building->id}}, '{{$data->building}}')" href="#edit-point" data-toggle="modal">Edit</a> | <a href="{{ URL::to('/admin'.'/'.$data->building->id.'/toilet') }}">Lihat Layanan</a></td>
                                </tr>
                            @endforeach
                          @endrole
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              {{ $point->links('pagination::bootstrap-4') }}
              <div class="row">
                <div class="col-12">
                  <button data-toggle="modal" data-target="#add-point" class="btn-lg btn-primary">Tambah</button>
                </div>
              </div>
          </div>

          <div class="modal fade" id="add-point" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Tambah tempat</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" action="/admin/point/add" method="post">
                          {{ csrf_field() }}
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nama point" name="name">
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan alamat point (opsional)" name="address">
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nomor telepon point (opsional)" name="phone">
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan deskripsi point (opsional)" name="description">
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

          <div class="modal fade" id="edit-point" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Edit </h3>
                      <div class="d-flex col-12">
                        <form class="col-12" id="form_edit" method="post">
                          {{ csrf_field() }}
                          <input id="point_name" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nama point" name="name">
                          <input id="point_adrress" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan alamat point (opsional)" name="address">
                          <input id="point_phone" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nomor telepon point (opsional)" name="phone">
                          <input id="point_description" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan deskripsi point (opsional)" name="description">
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

          <div class="modal fade" id="del-point" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Yakin hapus?</h3>
                      <div class="d-flex col-12">
                        <div class="ml-auto">
                          <form class="col-12" action="/admin/point/delete" method="post">
                            {{ csrf_field() }}
                            <input hidden type="text" name="point_id" id="point_id">
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
              document.getElementById('point_id').value = id;
            }
            function getData(id, data){
              console.log(data);
                var json = JSON.parse(data);
                document.getElementById("form_edit").action = '/admin/point/edit/'+id;
                document.getElementById('point_name').value = json.name;
                document.getElementById('point_adrress').value = json.address;
                document.getElementById('point_phone').value = json.phone;
                document.getElementById('point_description').value = json.description;
            }
          </script>

          @include('administrator.footer.footer')