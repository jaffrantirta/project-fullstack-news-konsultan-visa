<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{$system_info['system']['system_name']}} - {{$system_info['system']['slogan']}}</title> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="res/assets/img/favicon.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="res/assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="res/assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="res/assets/css/ticker-style.css">
            <link rel="stylesheet" href="res/assets/css/flaticon.css">
            <link rel="stylesheet" href="res/assets/css/slicknav.css">
            <link rel="stylesheet" href="res/assets/css/animate.min.css">
            <link rel="stylesheet" href="res/assets/css/magnific-popup.css">
            <link rel="stylesheet" href="res/assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="res/assets/css/themify-icons.css">
            <link rel="stylesheet" href="res/assets/css/slick.css">
            <link rel="stylesheet" href="res/assets/css/nice-select.css">
            <link rel="stylesheet" href="res/assets/css/style.css">
            <script src="https://cdn.tailwindcss.com"></script>

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
            <script src="jquery.zweatherfeed.min.js" type="text/javascript"></script>

            {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
            {{-- <link href="weather.css" rel="stylesheet" type="text/css" /> --}}
            <script type="text/javascript">
            $(document).ready(function () {
            $('#test').weatherfeed(['IDXX0022'], {
            forecast: true
            });
            });
            </script>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4314062205795872"
            crossorigin="anonymous"></script>
   </head>

   <body>
       
    <!-- Preloader Start -->
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="res/assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div> -->
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-right">
                                    <ul class="header-social">    
                                        @foreach ($system_info['socmed'] as $item)
                                        <li><a href="{{$item->url}}"><i class="{{$item->icon}}"></i></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 75px;" src="{{URL::to('res/assets/logo/logo-full.jpeg')}}">
                                    {{-- <a href="/"><strong style="color:black;">{{$system_info['system']['system_name']}}</strong></a> --}}
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right ">
                                    @if ($system_info['ads']['top'] != null)
                                    <a href="{{$system_info['ads']['top']->url}}">
                                        <img src="{{$system_info['ads']['top']->banner}}" alt="{{$system_info['ads']['top']->name}}">
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
               <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                    <div class="sticky-logo">
                                        <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 65px;" src="{{URL::to('res/assets/logo/logo-full.jpeg')}}">
                                        {{-- <a href="/">{{$system_info['system']['system_name']}}</a> --}}
                                    </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>                  
                                        <ul id="navigation">    
                                            <li><a href="/">Beranda</a></li>
                                            @foreach ($categories as $item)
                                                <li><a href="{{URL::to('/news?category='.$item->category)}}">{{$item->category}}</a></li>
                                            @endforeach
                                            {{-- <li><a href="about">Tentang Kami</a></li>
                                            <li><a href="latest-news">Berita Terbaru</a></li>
                                            <li><a href="contact">Kontak</a></li> --}}
                                            {{-- <li><a href="#">Pages</a>
                                                <ul class="submenu">
                                                    <li><a href="elements.html">Element</a></li>
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="single-blog.html">Blog Details</a></li>
                                                    <li><a href="details.html">Categori Details</a></li>
                                                </ul>
                                            </li> --}}
                                        </ul>
                                    </nav>
                                </div>
                            </div>             
                            <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form method="get" action="{{URL::to('/search')}}">
                                            <input type="text" name="keyword" placeholder="Search">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>

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