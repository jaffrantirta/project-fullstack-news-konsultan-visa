@include('homepage.header.header')
<!--================Blog Area =================-->
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 mb-5 mb-lg-0">
                <h4 class="mb-5">{{$text_title}}</h4>
                <div class="blog_left_sidebar">

                    @if ($is_search)
                        @foreach ($result as $item)
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{$item->picture}}" alt="">
                                @foreach ($item->post_categories as $cat)
                                <span class="row blog_item_date">
                                    <p>{{$cat->category->category}}</p>
                                </span>
                                @endforeach
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{URL::to('/read?news='.$item->url)}}">
                                    <h2>{{$item->title}}</h2>
                                </a>
                                {{-- <p>
                                    <?php
                                        if(strlen($item->content) > 200)
                                        {
                                            echo substr($item->content, 0, 200).'...';
                                        }else{
                                            echo $item->content;
                                        }
                                    ?>
                                </p> --}}
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-calendar"></i>{{date('l, d-M-Y', strtotime($item->created_at))}}</a></li>
                                    {{-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> --}}
                                </ul>
                            </div>
                        </article>
                        @endforeach
                    @else
                        @foreach ($result as $item)
                            @foreach ($item->post_category_ as $post)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    {{-- <p>{{$post->post_['id']}}</p> --}}
                                    <img class="card-img rounded-0" src="{{$post->post_->picture}}" alt="">
                                    <span class="row blog_item_date">
                                        <p>{{$item->category}}</p>
                                    </span>
                                </div>
    
                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{URL::to('/read?news='.$post->post_->url)}}">
                                        <h2>{{$post->post_->title}}</h2>
                                    </a>
                                    <p>
                                        <?php
                                            if(strlen($post->post_->content) > 50)
                                            {
                                                echo substr($post->post_->content, 0, 50).'...';
                                            }else{
                                                echo $post->post_->content;
                                            }
                                        ?>
                                    </p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-calendar"></i>{{date('l, d-M-Y', strtotime($post->post_->created_at))}}</a></li>
                                        {{-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> --}}
                                    ?
                            </article>
                            @endforeach
                        @endforeach
                    @endif

                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            {{ $result->links('pagination::bootstrap-4') }}
                            {{-- <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li> --}}
                        </ul>
                    </nav>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form method="get" action="{{URL::to('/search')}}">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input name="keyword" type="text" class="form-control" placeholder='Pencarian...'
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Pencarian'">
                                    {{-- <div class="input-group-append">
                                        <button class="btns" type="button"><i class="ti-search"></i></button>
                                    </div> --}}
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Cari</button>
                        </form>
                    </aside>

                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Kategori</h4>
                        <ul class="list cat-list">
                            @foreach ($categories_sum as $item)
                            <li>
                                <a href="{{URL::to('/news?category='.$item->category->category)}}" class="d-flex">
                                    <p>{{$item->category->category}}</p>
                                    <p>({{$item->sum}})</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </aside>

                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Berita Terbaru</h3>

                        @foreach ($latest_news as $item)
                        <div class="row media post_item">
                            <img class="col-12" src="{{URL::to($item->picture)}}" alt="post">
                            <div class="col-12 media-body">
                                <a href="single-blog.html">
                                    <h3>
                                    <?php
                                        if(strlen($item->title) > 50)
                                        {
                                            echo substr($item->title, 0, 50).'...';
                                        }else{
                                            echo $item->title;
                                        }
                                    ?>
                                    </h3>
                                </a>
                                <p>{{date('l, d-M-Y', strtotime($item->created_at))}}</p>
                            </div>
                        </div>
                        @endforeach
                    </aside>


                    <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Notofikasi Berita Tiap Hari</h4>

                        <form action="#">
                            <div class="form-group">
                                <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Langganan</button>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->

@include('homepage.footer.footer')