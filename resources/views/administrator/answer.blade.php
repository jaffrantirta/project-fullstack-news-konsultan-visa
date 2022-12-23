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
                <span class="text-uppercase page-subtitle">Jawaban</span>
                <h3 class="page-title">List Jawaban atas pertanyaan <b>"{{$question->question}}"</b></h3>
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
                      <h6 class="m-0">{{$answer->total()}} Jawaban Aktif</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                      <table class="table mb-0">
                        <thead class="bg-light">
                          <tr>
                            <th scope="col" class="border-0">Jawaban</th>
                            <th scope="col" class="border-0">Ditambahkan pada tanggal</th>
                            <th scope="col" class="border-0">Diubah pada tanggal</th>
                            <th scope="col" class="border-0">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($answer as $data)
                                <tr>
                                    <td>{{ $data->answer }}</td>
                                    <td>{{ date('l, d M Y H:m', strtotime($data->created_at)) }}</td>
                                    <td>{{ date('l, d M Y H:m', strtotime($data->updated_at)) }}</td>
                                    <td><a onclick="getData({{$data->id}}, '{{$data}}')" href="#edit-category" data-toggle="modal">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              {{ $answer->links('pagination::bootstrap-4') }}
              <div class="row">
                <div class="col-12">
                  <button data-toggle="modal" data-target="#add-category" class="btn-lg btn-primary">Tambah Jawaban</button>
                </div>
              </div>
          </div>

          <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="mb-4">Tambah Jawaban</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" action="/admin/answer/add" method="post">
                          {{ csrf_field() }}
                          <input class="form-control-lg col-12 mb-1" type="text" placeholder="masukan jawaban" name="answer">
                          <input class="form-control-lg col-12 mb-1" type="hidden" name="question_id" value="{{$question->id}}">
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
                      <h3 class="mb-4">Edit Jawaban</h3>
                      <div class="d-flex col-12">
                        <form class="col-12" id="form_edit" method="post">
                          {{ csrf_field() }}
                          <input id="answer" class="form-control-lg col-12 mb-1" type="text" placeholder="masukan jawaban" name="answer">
                          <input class="form-control-lg col-12 mb-1" type="hidden" name="question_id" value="{{$question->id}}">
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
              var dt = JSON.parse(data);
              document.getElementById("form_edit").action = '/admin/answer/edit/'+id;
              document.getElementById('answer').value = dt.answer;
            }
            function form_delete(id){
              document.getElementById("form_delete").action = '/admin/answer/delete/'+id;
            }
          </script>

          @include('administrator.footer.footer')