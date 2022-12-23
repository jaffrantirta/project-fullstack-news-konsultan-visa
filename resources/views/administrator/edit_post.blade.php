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
                <h3 class="page-title">Edit Berita</h3>
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
              <script>
                localStorage.clear();
              </script>
              <div class="alert alert-success alert-dismissible fade show rounded-5" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif


            <!-- End Page Header -->
            <div class="row">
              <div class="col-lg-9 col-md-12">
                <!-- Add New Post Form -->
                <div class="card card-small mb-3">
                  <div class="card-body">
                    <form id="news_form" class="add-new-post" method="POST" enctype="multipart/form-data" action="{{URL::to('/post/edit/process/'.$post->id)}}">
                      @csrf
                      <input value="{{$post->title}}" id="title" name="title" class="form-control form-control-lg mb-3" type="text" placeholder="Judul Berita">
                      <input value="{{$post->author}}" id="author" name="author" class="form-control form-control-lg mb-3" type="text" placeholder="Pengarang (jika dikosongkan akan terisi nama yang login saat ini)">
                      <input id="picture" name="file" class="form-control form-control-lg mb-3" type="file">
                      <textarea name="content" id="content" placeholder="Konten" class="ckeditor" id="ckedtor">{{$post->content}}</textarea>

                  </div>
                </div>
                <!-- / Add New Post Form -->
              </div>
              <div class="col-lg-3 col-md-12">
                <!-- Post Overview -->
                <div class='card card-small mb-3'>
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Aksi</h6>
                  </div>
                  <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item p-3">
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">visibility</i>
                          <strong class="mr-1">Visibility:</strong>
                          <strong class="text-success">Public</strong>
                          <a class="ml-auto" href="#soon" data-toggle="modal">Edit</a>
                        </span>
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">calendar_today</i>
                          <strong class="mr-1">Schedule:</strong> Now
                          <a class="ml-auto" href="#soon" data-toggle="modal">Edit</a>
                        </span>
                      </li>
                      <li class="list-group-item d-flex px-3">
                        <div class="row p-2">
                          <a href="#" onclick="save()" class="mt-1 col-12 btn btn-sm btn-accent ml-auto">
                            <i class="fa fa-upload"></i> Simpan Perubahan</a>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- / Post Overview -->
                <!-- Post Overview -->
                <div class='card card-small mb-3'>
                  <div class="card-header border-bottom">
                    <h6 class="m-0"><a href="{{URL::to('/category/post/'.$post->id)}}"> Ubah Kategori</a></h6>
                  </div>
                  {{-- <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item px-3 pb-2">
                        @foreach ($categories as $data)
                          <div class="custom-control custom-checkbox mb-1">
                            <input value="{{$data->id}}" name="categories[]" type="checkbox" class="chk custom-control-input" id="category-{{$data->id}}">
                            <label class="custom-control-label" for="category-{{$data->id}}">{{$data->category}}</label>
                          </div>
                        @endforeach
                        
                      </li>

                    </form> --}}
                      {{-- <li class="list-group-item d-flex px-3">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="New category" aria-label="Add new category" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-white px-2" type="button">
                              <i class="material-icons">add</i>
                            </button>
                          </div>
                        </div>
                      </li> --}}
                    {{-- </ul>
                  </div> --}}
                </div>
                <!-- / Post Overview -->
              </div>
            </div>
          </div>
          <div class="modal fade" id="soon" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
              <div class="modal-content rounded-10">
                <div class="modal-body py-0">
                  <div class="d-block main-content">
                    <div class="content-text p-4">
                      <h3 class="text-center">Fitur ini akan segera hadir</h3>
                      <div class="d-flex col-12">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript" src="{{ URL::to('/res/assets_administrator/ckeditor/ckeditor.js')}}"></script>

          <script>
            // var formdata;
            $(document).ready(function() {
              // var title = localStorage.getItem('post-draf-title');
              // var author = localStorage.getItem('post-draf-author');
              var content = localStorage.getItem('post-draf-content');
              // document.getElementById('title').value = title;
              // document.getElementById('author').value = author;
              CKEDITOR.instances['content'].setData(content);
            });

            function save(){
              var title = $('#title').val();
              var author = $('#author').val();
              var content = CKEDITOR.instances['content'].getData();
              localStorage.setItem('post-draf-title', title);
              localStorage.setItem('post-draf-author', author);
              localStorage.setItem('post-draf-content', content.toString());
              document.getElementById("news_form").submit();
            }

            function save_local(){
              var title = $('#title').val();
              var author = $('#author').val();
              var content = CKEDITOR.instances['content'].getData();
              localStorage.setItem('post-draf-title', title);
              localStorage.setItem('post-draf-author', author);
              localStorage.setItem('post-draf-content', content.toString());
              Swal.fire({
                title: 'Draf berhasil tersimpan',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false
              });
              location.reload();
            }

            function delete_local(){
              localStorage.clear();
              Swal.fire({
                title: 'Draf berhasil terhapus',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false
              });
              location.reload();
            }

            // $('#picture').change(function(){    
            //     //on change event  
            //     formdata = new FormData();
            //     if($(this).prop('files').length > 0)
            //     {
            //         file =$(this).prop('files')[0];
            //         formdata.append("picture", file);
            //     }
            // });

            // function save_news(){
            //   var title = $('#title').val();
            //   var author = $('#author').val();
            //   var content = CKEDITOR.instances['content'].getData();
            //   var categories = checkbox_selected();
            //   var base_url = $('#base_url').html();
            //   var csrf = $('#csrf').html();

            //   Swal.fire({
            //     title: 'Harap tunggu...',
            //     allowOutsideClick: false,
            //     allowEscapeKey: false,
            //     showConfirmButton: false
            //   })
            //   $.ajax({
            //     url: base_url+'/post/add',
            //     type: 'post',
            //     data: formdata,
            //     // data: {"_token": csrf, 'picture':formdata, 'title':title, 'author':author, 'content':content, 'categories':categories, 'is_published':1},
            //     success: function(result){
            //       console.log(result);
            //       Swal.fire({
            //         icon: 'success',
            //         title: result.message
            //       }).then((result) => {
            //         if (result.isConfirmed) {
            //           location.reload();
            //         }
            //       })
            //       delete_local();
            //     },
            //     error: function(error, x, y){
            //       console.log(error);
            //       var err = JSON.parse(error.responseText);
            //       Swal.fire({
            //         icon: 'error',
            //         html: err.message,
            //       })
            //     }
            //   });
            // }

            // function loop(item, index) {
            //   text += index + ": " + item + "<br>"; 
            // }

            // function checkbox_selected(){
            //   var categories = [];
            //   $.each($("input[name='categories']:checked"), function(){
            //       categories.push($(this).val());
            //   });
            //   return categories;
            // }
          </script>
          @include('administrator.footer.footer', $page)