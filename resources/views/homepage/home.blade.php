@include('homepage.header.header', $system_info)

    <main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <div class="row">
                    <div class="col-lg-8">

                        <!-- Trending Top -->
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                @if ($trending_top != null)
                                <img src="{{URL::to($trending_top->post->picture)}}" alt="">
                                <div class="trend-top-cap">
                                    @foreach ($trending_top->post->post_categories as $item)
                                    <span>{{$item->category->category}}</span>
                                    @endforeach
                                    <h2><a href="{{URL::to('/read?news='.$trending_top->post->url)}}">
                                        <?php
                                            if(strlen($trending_top->post->title) > 50)
                                            {
                                                echo substr($trending_top->post->title, 0, 95).'...';
                                            }else{
                                                echo $trending_top->post->title;
                                            }
                                        ?>
                                    </a></h2>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                @foreach ($trending_bottom as $item)
                                @if ($item->post != null)
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <img style="object-fit: cover; width: 30em; height: 10em;" src="{{URL::to($item->post->picture)}}" alt="">
                                        </div>
                                        <div class="trend-bottom-cap">
                                            @foreach ($item->post->post_categories as $cat)
                                            <span class="color{{random_int(1, 4)}}">{{$cat->category->category}}</span>
                                            @endforeach
                                            <h4><a href="{{URL::to('/read?news='.$item->post->url)}}">
                                                <?php
                                                    if(strlen($item->post->title) > 50)
                                                    {
                                                        echo substr($item->post->title, 0, 45).'...';
                                                    }else{
                                                        echo $item->post->title;
                                                    }
                                                ?>
                                            </a></h4>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Riht content -->
                    <div class="col-lg-4">
                        @foreach ($right_content as $item)
                        <div class="row trand-right-single d-flex">
                            <div class="mb-2 col-12 trand-right-img">
                                <img class="col-12" style="object-fit: cover; width: 30em; height: 10em;" src="{{URL::to($item->picture)}}" alt="">
                            </div>
                            <div class="m-2 col-12 trand-right-cap">
                                @foreach ($item->post_categories as $cat)
                                <span class="color{{random_int(1, 4)}}">{{$cat->category->category}}</span>
                                @endforeach
                                <h4><a href="{{URL::to('/read?news='.$item->url)}}">
                                    <?php
                                        if(strlen($item->title) > 50)
                                        {
                                            echo substr($item->title, 0, 50).'...';
                                        }else{
                                            echo $item->title;
                                        }
                                    ?>
                                </a></h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->

    
   <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Berita Terbaru</h3>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="properties__button">
                            <!--Nav Button  -->                                            
                            <nav>                                                                     
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Semua</a>
                                    @foreach ($post_by_categories as $item)
                                    <a class="nav-item nav-link" id="nav-{{str_replace(" ", "-", $item->category)}}-tab" data-toggle="tab" href="#{{str_replace(" ", "-", $item->category)}}" role="tab" aria-controls="nav-{{str_replace(" ", "-", $item->category)}}" aria-selected="false">{{$item->category}}</a> 
                                    @endforeach
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Nav Card -->
                        <div class="tab-content" id="nav-tabContent">
                            <!-- card one -->
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">           
                                <div class="whats-news-caption">
                                    <div class="row">
                                    @foreach ($post_by_categories as $item)
                                        @foreach ($item->post_category_ as $post)
                                        @if ($post->post_ != null)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img style="object-fit: cover; width: 40em; height: 15em;" src="{{URL::to($post->post_->picture)}}" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="ml-2 color{{random_int(1, 4)}}">{{$item->category}}</span>
                                                    <h4 class="ml-2"><a href="{{URL::to('/read?news='.$post->post_->url)}}">
                                                        <?php
                                                            if(strlen($post->post_->title) > 50)
                                                            {
                                                                echo substr($post->post_->title, 0, 50).'...';
                                                            }else{
                                                                echo $post->post_->title;
                                                            }
                                                        ?>
                                                    </a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            @foreach ($post_by_categories as $item)
                            <div class="tab-pane fade show" id="{{str_replace(" ", "-", $item->category)}}" role="tabpanel" aria-labelledby="nav-{{str_replace(" ", "-", $item->category)}}-tab">           
                                <div class="whats-news-caption">
                                    <div class="row">
                                        @foreach ($item->post_category_ as $post)
                                        @if ($post->post_ != null)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img style="object-fit: cover; width: 40em; height: 15em;" src="{{URL::to($post->post_->picture)}}" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="ml-2 color{{random_int(1, 4)}}">{{$item->category}}</span>
                                                    <h4 class="ml-2"><a href="{{URL::to('/read?news='.$post->post_->url)}}">
                                                        <?php
                                                            if(strlen($post->post_->title) > 50)
                                                            {
                                                                echo substr($post->post_->title, 0, 50).'...';
                                                            }else{
                                                                echo $post->post_->title;
                                                            }
                                                        ?>
                                                    </a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    <!-- End Nav Card -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Section Tittle -->
                {{-- <div class="section-tittle mb-40">
                    <h3>Ikuti Sosial Media Kami</h3>
                </div>
                <!-- Flow Socail -->
                <div class="single-follow mb-45">
                    <div class="single-box">
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="res/assets/img/news/icon-fb.png" alt=""></a>
                            </div>
                            <div class="follow-count">  
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div> 
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="res/assets/img/news/icon-tw.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                            <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="res/assets/img/news/icon-ins.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="res/assets/img/news/icon-yo.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- New Poster -->
                <div class="news-poster d-none d-lg-block">
                    @if ($system_info['ads']['bottom'] != null)
                    <a href="{{$system_info['ads']['bottom']->url}}">
                        <img src="{{$system_info['ads']['bottom']->banner}}" alt="{{$system_info['ads']['bottom']->name}}">
                    </a>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->
   
    <!-- Start Youtube -->
    <div class="youtube-area video-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="video-items-active">
                        @foreach ($youtube as $item)
                        <div class="video-items text-center">
                            <iframe src="{{$item->link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="video-info">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="video-caption">
                            <div class="top-caption">
                            </div>
                            <div class="bottom-caption">
                                <h2>Mengenal Konsultan Visa</h2>
                                <p>Irure reprehenderit consectetur ut dolor nulla nisi qui est officia id ullamco nostrud deserunt aliquip. Esse nisi nulla sunt anim minim esse Lorem sint ipsum consectetur non dolore. Amet est cupidatat occaecat aute velit laborum non esse quis quis labore duis consequat ea.</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testmonial-nav text-center">
                            @foreach ($youtube as $item)
                            <div class="single-video">
                                <iframe  src="{{$item->link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <div class="video-intro">
                                    <h4>{{$item->name}}</h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Start youtube -->
   
    <!--Start pagination -->
    {{-- <div class="pagination-area pb-45 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                              <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                              <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                            </ul>
                          </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End pagination  -->
    </main>
    
    @include('homepage.footer.footer', $system_info)