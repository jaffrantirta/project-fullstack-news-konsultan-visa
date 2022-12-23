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
                <span class="text-uppercase page-subtitle">Berita</span>
                <h3 class="page-title">List Semua Berita</h3>
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

            
            <div class="row">
              <div class="col">
                <div class="card card-small mb-4 table-responsive">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">{{$posts->total()}} Berita</h6>
                  </div>
                  <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">Judul</th>
                          <th scope="col" class="border-0">Pengarang</th>
                          <th scope="col" class="border-0">Dibaca</th>
                          <th scope="col" class="border-0">Dipublikasi pada</th>
                          <th scope="col" class="border-0">Status</th>
                          <th scope="col" class="border-0">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($posts as $data)
                              <tr>
                                  <td>{{ $data->title }}</td>
                                  <td>{{ $data->author }}</td>
                                  <td>x{{ $data->count_hit_count }}</td>
                                  <td>{{ date('l, d M Y H:m', strtotime($data->published_at)) }}</td>
                                  @if ($data->is_published)
                                  <td><p style="color: green">PUBLISHED</p></td>
                                  @else
                                  <td><p style="color: red">UNPUBLISH</p></td>
                                  @endif
                                  <td>
                                    <li class="nav-item dropdown">
                                      <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="d-none d-md-inline-block">Pilih aksi</span>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-small">
                                        @if ($data->is_published)
                                        <a class="dropdown-item" href="{{URL::to('post/unactive/'.$data->url)}}">Non-aktifkan</a>
                                        @else
                                        <a class="dropdown-item" href="{{URL::to('post/active/'.$data->url)}}">Aktifkan</a>
                                        @endif
                                        <a class="dropdown-item" href="{{URL::to('admin/post/edit/'.$data->id)}}">Edit</a>
                                        <a class="dropdown-item" href="{{URL::to('add_trending/top?post_id='.$data->id)}}">Jadikan Trending Top</a>
                                        <a class="dropdown-item" href="{{URL::to('add_trending/bottom?post_id='.$data->id)}}">Jadikan Trending Bottom</a>
                                      </div>
                                    </li>
                                      {{-- <a onclick="getData({{$data->id}}, '{{$data->title}}')" href="#edit-category" data-toggle="modal">Edit</a> | <a onclick="setID({{$data->id}})" style="color: red" href="#del-category" data-toggle="modal">Hapus</a> --}}
                                    </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
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
                        <h3 class="mb-4">Yakin Hapus Berita ini ?</h3>
                        <div class="d-flex col-12">
                          <div class="ml-auto">
                            <form class="col-12" action="/admin/post/delete" method="post">
                              {{ csrf_field() }}
                              <input type="text" name="post_id" id="post_id">
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

            {{ $posts->links('pagination::bootstrap-4') }}
          </div>

          <script>
            function setID(id){
              document.getElementById('post_id').value = id;
            }
          </script>

          @include('administrator.footer.footer')