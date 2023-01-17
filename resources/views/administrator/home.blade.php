@include('administrator.header.header', $page)
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
            @include('administrator.navbar.navbar')
          </div>

          <div class="main-content-container container-fluid px-4">
            <div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title">Overview</h3>
              </div>
            </div>

            {{-- @role('user-point')
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">

                <div style="height: 300px" class="card text-white">
                  <img id="bg_user_point" style="{{$user_detail['style']}}" src="{{URL::to('res/assets/img/bg/user_point_bg.jpeg')}}" class="card-img">
                  <div class="card-img-overlay">
                    <h5 class="card-title">{{$user_detail['greeting']}}</h5>
                    <strong>{{$user_detail['status_user']}}</strong>
                    <p class="card-text">{{$user_detail['description']}}</p>
                    <a href="{{$user_detail['link']}}" class="{{$user_detail['btn_class']}}">{{$user_detail['btn_text']}}</a>
                  </div>
                </div>

              </div>
            </div>
            @endrole
            
            <div class="row">
              @foreach ($dashboard as $item)
              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">{{$item['name']}}</span>
                        @if ($item['sum'] != null)
                          <h6 class="stats-small__value count my-3">{{$item['sum']}}</h6>
                        @else
                        <h6 class="count my-3">Belum Dinilai</h6>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>

            @role('user-point')
            <p hidden id="datasets_read">{{json_encode($statistic)}}</p>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Penilain Seluruh Tempat Tiap Harinya</h6>
                  </div>
                  <div class="card-body pt-0">
                    <canvas height="130" style="max-width: 100% !important;" class="blog-overview-users"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <h6 class="stats-small__value count my-3">Rating Tiap Toilet</h6>
            <div class="row">
              @if ($ratings != null)
                @foreach ($ratings as $item)
                <div class="col-lg col-md-6 col-sm-6 mb-4">
                  <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                      <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                          <span class="stats-small__label text-uppercase">{{$item['name']}} - {{$item['build_name']}}</span>
                          @if ($item['sum'] != null)
                            <h6 class="stats-small__value count my-3">{{round($item['sum'], 1)}}</h6>
                          @else
                          <h6 class="count my-3">Belum Dinilai</h6>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              @endif
            </div>
            @endrole --}}


            @role('Super-Admin')

            <p hidden id="datasets_read">{{json_encode($statistic)}}</p>
            <div class="row">
              <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Seluruh Berita Terbaca</h6>
                  </div>
                  <div class="card-body pt-0">
                    <canvas height="130" style="max-width: 100% !important;" class="blog-overview-users"></canvas>
                  </div>
                </div>
              </div>

              
              <p hidden id="pie_data">{{json_encode($pie)}}</p>
              <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card card-small h-100">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Berita per Kategori</h6>
                  </div>
                  <div class="card-body d-flex py-0">
                    <canvas height="220" class="blog-users-by-device m-auto"></canvas>
                  </div>
                </div>
              </div>
              
              {{-- <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Top 5</h6>
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                      @foreach ($top_toilet as $item)
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{$item->place->name}} - {{$item->place_to_build->build->name}}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray">{{round($item->rate, 1)}}</span>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div> --}}

              @endrole

              @role('Super-Admin|writer')
              
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Top 5 News</h6>
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                      @foreach ($top_news ?? '' as $item)
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">{{$item->post->title}}</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray">{{$item->sum}}</span>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>

              @endrole
              
            </div>
          </div>
          @include('administrator.footer.footer', $page)