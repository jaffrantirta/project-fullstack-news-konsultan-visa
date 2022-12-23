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
                <span class="text-uppercase page-subtitle">Iklan</span>
                <h3 class="page-title">List Data Iklan</h3>
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
                      <h6 class="m-0">{{$ads->total()}} Iklan Aktif</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                      <table class="table mb-0">
                        <thead class="bg-light">
                          <tr>
                            <th scope="col" class="border-0">Nama</th>
                            <th scope="col" class="border-0">Posisi</th>
                            <th scope="col" class="border-0">Url</th>
                            <th scope="col" class="border-0">Banner</th>
                            <th scope="col" class="border-0">Ditambahkan pada tanggal</th>
                            <th scope="col" class="border-0">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($ads as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->position }}</td>
                                    <td>{{ $data->url }}</td>
                                    <td>
                                      <img class="col-5" src="{{URL::to($data->banner)}}">
                                    </td>
                                    <td>{{ date('l, d M Y H:m', strtotime($data->created_at)) }}</td>
                                    <td><a onclick="form_delete({{$data->id}})" style="color: red" href="#del-category" data-toggle="modal">Hapus</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              {{ $ads->links('pagination::bootstrap-4') }}
              <div class="row">
                <div class="col-12">
                  <button data-toggle="modal" data-target="#add-category" class="btn-lg btn-primary">Tambah Iklan</button>
                </div>
              </div>
          </div>

          <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Tambah Iklan</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" action="/admin/ads/add" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nama iklan" name="name">
                          <select class="form-control-lg col-12 mb-1" name="position">
                            <option value="top">Iklan Bagian Atas (2126 x 283 pixel)</option>
                            <option value="bottom">Iklan Bagian Bawah (500 x 1258 pixel)</option>
                          </select>
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan url iklan ketika diklik" name="url">
                          <p style="color: red">Perhatian, upload banner untuk iklan bagian atas HARUS berukuran 2126 x 283 pixel dan iklan bagian bawah HARUS berukuran 500 x 1258 pixel</p>
                          <input id="picture" name="file" class="form-control form-control-lg mb-3" type="file">
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
                      <h3 class="mb-4">Edit Iklan</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" id="form_edit" method="post">
                          {{ csrf_field() }}
                          <input id="ad_name" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan nama iklan" name="name">
                          <input id="ad_url" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan url ketika iklan diklik" name="url">
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
                      <h3 class="mb-4">Yakin Hapus Iklan ?</h3>
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
              document.getElementById("form_edit").action = '/admin/ads/edit/'+id;
              document.getElementById('ad_name').value = yt.name;
              document.getElementById('ad_url').value = yt.url;
              document.getElementById('ad_position').value = yt.position;
            }
            function form_delete(id){
              document.getElementById("form_delete").action = '/admin/ads/delete/'+id;
            }
          </script>

          @include('administrator.footer.footer')