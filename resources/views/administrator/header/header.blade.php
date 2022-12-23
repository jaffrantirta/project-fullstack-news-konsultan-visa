<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$system['system_name']}} - {{$title}}</title>
    {{-- <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components."> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="{{ asset('res/assets_administrator/styles/shards-dashboards.1.1.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('res/assets_administrator/styles/extras.1.1.0.min.css') }}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <style>
      .btn-grey{
        background-color:#D8D8D8;
        color:#FFF;
      }
      .rating-block{
        background-color:#FAFAFA;
        border:1px solid #EFEFEF;
        padding:15px 15px 20px 15px;
        border-radius:3px;
      }
      .bold{
        font-weight:700;
      }
      .padding-bottom-7{
        padding-bottom:7px;
      }

      .review-block{
        background-color:#FAFAFA;
        border:1px solid #EFEFEF;
        padding:15px;
        border-radius:3px;
        margin-bottom:15px;
      }
      .review-block-name{
        font-size:12px;
        margin:10px 0;
      }
      .review-block-date{
        font-size:12px;
      }
      .review-block-rate{
        font-size:13px;
        margin-bottom:15px;
      }
      .review-block-title{
        font-size:15px;
        font-weight:700;
        margin-bottom:10px;
      }
      .review-block-description{
        font-size:13px;
      }
    </style>
  </head>
  <body class="h-100">
    {{-- <div class="color-switcher-toggle animated pulse infinite">
      <i class="material-icons">settings</i>
    </div> --}}
    <div class="container-fluid">
      <div class="row">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
          <div class="main-navbar">
            <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
              <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                  <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{URL::to('res/assets/logo/logo-full.jpeg')}}">
                  {{-- <span class="d-none d-md-inline ml-1">{{URL::to('public/assets/logo/logo-full.jpeg')}}</span> --}}
                </div>
              </a>
              <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
              </a>
            </nav>
          </div>
          <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
            <div class="input-group input-group-seamless ml-3">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-search"></i>
                </div>
              </div>
              <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
          </form>
          <div class="nav-wrapper">
            <ul class="nav flex-column">


              @role('Super-Admin|writer|user-point')
              @if ($title == 'Dashboard')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link" href="{{URL::to('/admin')}}">
                  <i class="material-icons">edit</i>
                  <span>Dashboard</span>
                </a>
              </li>
              @endrole

              @role('Super-Admin')
              @if ($title == 'Kategori')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/category')}}">
                  <i class="material-icons">category</i>
                  <span>Kategori</span>
                </a>
              </li>
              @endrole

              @role('Super-Admin|writer')
              @if ($title == 'Berita')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/post')}}">
                  <i class="material-icons">menu_book</i>
                  <span>Berita</span>
                </a>
              </li>
              @endrole


              @role('Super-Admin|writer')
              @if ($title == 'Buat Berita')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/post/add')}}">
                  <i class="material-icons">add</i>
                  <span>Buat Berita</span>
                </a>
              </li>
              @endrole

              @role('Super-Admin')
              @if ($title == 'Pengguna')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/users')}}">
                  <i class="material-icons">person</i>
                  <span>Pengguna</span>
                </a>
              </li>
              @endrole

              @role('Super-Admin|user-point')
              @if ($title == 'Point')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/point')}}">
                  <i class="material-icons">pin_drop</i>
                  <span>Point</span>
                </a>
              </li>
              @endrole

              @role('Super-Admin')
              @if ($title == 'Pertanyaan')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/question')}}">
                  <i class="material-icons">question_answer</i>
                  <span>Pertanyaan</span>
                </a>
              </li>
              @endrole

              @role('Super-Admin')
              @if ($title == 'Youtube')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/youtube')}}">
                  <i class="material-icons">video_settings</i>
                  <span>Youtube</span>
                </a>
              </li>
              @endrole

              @role('Super-Admin')
              @if ($title == 'Sosial Media')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/socmed')}}">
                  <i class="material-icons">share</i>
                  <span>Sosial Media</span>
                </a>
              </li>
              @endrole

              @role('Super-Admin')
              @if ($title == 'Premium')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/premium')}}">
                  <i class="material-icons">workspace_premium</i>
                  <span>Premium</span>
                </a>
              </li>
              @endrole

              @role('Super-Admin')
              @if ($title == 'Iklan')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/ads')}}">
                  <i class="material-icons">ads_click</i>
                  <span>Iklan</span>
                </a>
              </li>
              @endrole

              {{-- @if ($title == 'Toilet')
              <li class="nav-item active">
              @else
              <li class="nav-item">
              @endif
                <a class="nav-link " href="{{URL::to('/admin/toilet')}}">
                  <i class="material-icons">vertical_split</i>
                  <span>Toilet</span>
                </a>
              </li> --}}

              
            </ul>
          </div>
        </aside>

        <p hidden id="base_url">{{URL::to('/')}}</p>
        <p hidden id="csrf">{{ csrf_token() }}</p>
        