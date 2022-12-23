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
                <span class="text-uppercase page-subtitle">Youtube</span>
                <h3 class="page-title">List Data Link</h3>
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
                      <h6 class="m-0">{{$youtube->total()}} Link Aktif</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                      <table class="table mb-0">
                        <thead class="bg-light">
                          <tr>
                            <th scope="col" class="border-0">Nama</th>
                            <th scope="col" class="border-0">Link</th>
                            <th scope="col" class="border-0">Ditambahkan pada tanggal</th>
                            <th scope="col" class="border-0">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($youtube as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->link }}</td>
                                    <td>{{ date('l, d M Y H:m', strtotime($data->created_at)) }}</td>
                                    <td><a onclick="getData({{$data->id}}, '{{$data}}')" href="#edit-category" data-toggle="modal">Edit</a> | <a onclick="form_delete({{$data->id}})" style="color: red" href="#del-category" data-toggle="modal">Hapus</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              {{ $youtube->links('pagination::bootstrap-4') }}
              <div class="row">
                <div class="col-12">
                  <button data-toggle="modal" data-target="#add-category" class="btn-lg btn-primary">Tambah Link</button>
                </div>
              </div>
          </div>

          <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Tambah Link Youtube</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" action="/admin/youtube/add" method="post">
                          {{ csrf_field() }}
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nama link" name="name">
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan link" name="link">
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

          <div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Edit Link Youtube</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" id="form_edit" method="post">
                          {{ csrf_field() }}
                          <input id="link_name" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nama link" name="name">
                          <input id="link_url" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan link" name="link">
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

          <div class="modal fade" id="del-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Yakin Hapus Link Youtube ?</h3>
                      <div class="d-flex col-12">
                        <div class="ml-auto">
                          <form class="col-12" id="form_delete" method="get">
                            {{ csrf_field() }}
                            {{-- <input hidden type="text" name="category_id" id="category_id"> --}}
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
              document.getElementById('category_id').value = id;
            }
            function getData(id, data){
              var yt = JSON.parse(data);
              document.getElementById("form_edit").action = '/admin/youtube/edit/'+id;
              document.getElementById('link_name').value = yt.name;
              document.getElementById('link_url').value = yt.link;
            }
            function form_delete(id){
              document.getElementById("form_delete").action = '/admin/youtube/delete/'+id;
            }
          </script>

          @include('administrator.footer.footer')