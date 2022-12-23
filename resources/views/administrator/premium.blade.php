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
                <span class="text-uppercase page-subtitle">Premium</span>
                <h3 class="page-title">List Data Pengguna Premium</h3>
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
                      <h6 class="m-0">{{$premium->total()}} Premium</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                      <table class="table mb-0">
                        <thead class="bg-light">
                          <tr>
                            <th scope="col" class="border-0">Nama</th>
                            <th scope="col" class="border-0">Tanggal Mulai</th>
                            <th scope="col" class="border-0">Tanggal Berakhir</th>
                            <th scope="col" class="border-0">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($premium as $data)
                                <tr>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ date('l, d M Y H:m', strtotime($data->created_at)) }}</td>
                                    <td>{{ date('l, d M Y H:m', strtotime($data->expire)) }}</td>
                                    <td>
                                      @if ($data->expire >= date('Y-m-d'))
                                          <strong style="color: green">AKTIF</strong>
                                      @else
                                        <strong style="color: red">BERAKHIR</strong>
                                      @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              {{ $premium->links('pagination::bootstrap-4') }}
              <div class="row">
                <div class="col-12">
                  <button data-toggle="modal" data-target="#add-premium" class="btn-lg btn-primary">Tambah Pengguna Premium</button>
                </div>
              </div>
          </div>

          <div class="modal fade" id="add-premium" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Tambah Pengguna Premium</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" action="/admin/premium/add" method="post">
                          {{ csrf_field() }}
                          <div class="form-inline">
                            <input id="user_id" class="form-control-lg col-8 mr-1" type="text" placeholder="masukan nomor identitas" name="user_id">
                            <a href="#" onclick="check()" class="btn btn-primary col-3">Cek</a>
                          </div>
                          <p id="user_name"></p><br>
                          <strong>Pilih jangka waktu premium</strong>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="expire" id="month" value="30">
                            <label class="form-check-label" for="month">
                              1 Bulan
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="expire" id="trimester" value="90">
                            <label class="form-check-label" for="trimester">
                              3 Bulan
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="expire" id="semester" value="180">
                            <label class="form-check-label" for="semester">
                              6 Bulan
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="expire" id="year" value="365">
                            <label class="form-check-label" for="year">
                              12 Bulan
                            </label>
                          </div>

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

          <div class="modal fade" id="edit-premium" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

          <div class="modal fade" id="del-premium" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            {{-- <input hidden type="text" name="premium_id" id="premium_id"> --}}
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
              document.getElementById('premium_id').value = id;
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
            function check()
            {
              var token = document.getElementById('csrf').innerHTML;
              var user_id = document.getElementById('user_id').value;
              $.ajax({
                url: document.getElementById('base_url').innerHTML+'/admin/users/check',
                type: 'post',
                data: {'_token':token, 'user_id':user_id},
                success: function(result){
                  if(result == false){
                    document.getElementById('user_name').innerHTML = '<p style="color: red">Pengguna tidak ditemukan</p>';
                  }else{
                    document.getElementById('user_name').innerHTML = 'Nama pengguna : '+result.name;
                  }
                }
              })
            }
          </script>

          @include('administrator.footer.footer')