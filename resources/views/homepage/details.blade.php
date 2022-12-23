@include('homepage.header.header');
<main>
    <!-- About US Start -->
    <div class="about-area">
        <div class="container">
                <!-- Hot Aimated News Tittle-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>Trending now</strong>
                            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    @foreach ($trending_bottom as $item)
                                    <li class="news-item">{{$item->post->title}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Tittle -->
                        <div class="about-right mb-90">
                            <div class="about-img">
                                <img src="{{URL::to($news->picture)}}" alt="">
                            </div>
                            <div class="section-tittle mb-30 pt-30">
                                <h3>{{$news->title}}</h3>
                            </div>
                            <div class="about-prea">
                                <strong>{{date('l, d-M-Y', strtotime($news->created_at))}}</strong>
                                <?php echo $news->content ?>
                            </div> 
                            <div class="social-share pt-30">
                                <div class="section-tittle">
                                    <h3 class="mr-20">Share:</h3>
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{URL::to('/read?news='.$news->url)}}"><img style="height: 2em; width: 2em;" src="res/assets/img/news/icon-fb.png" alt=""></a></li>
                                        <li><a href="https://twitter.com/share?url={{URL::to('/read?news='.$news->url)}}&text=Baca berita {{$news->title}}, selengkapnya"><img style="height: 2em; width: 2em;" src="res/assets/img/news/icon-tw.png" alt=""></a></li>
                                        <li><a href="whatsapp://send?text={{URL::to('/read?news='.$news->url)}}"><img style="height: 2em; width: 2em;" src="res/assets/img/news/icon-wa.png" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-40">
                            <h3>Follow Kami</h3>
                        </div>
                        <!-- Flow Socail -->
                        <div class="single-follow mb-45">
                            <div class="single-box">

                                @foreach ($system_info['socmed'] as $item)
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <i class="{{$item->icon}}"></i>
                                    </div>
                                    <div class="follow-count">  
                                        <a href="{{$item->url}}"><span>{{$item->username}}</span></a>
                                        <p>{{$item->name}}</p>
                                    </div>
                                </div> 
                                @endforeach
                                

                            </div>
                        </div>
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
    </div>
    <!-- About US End -->
</main>

@include('homepage.footer.footer')