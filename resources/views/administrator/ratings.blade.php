<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Ulasan {{$place->name}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .checked {
        color: orange;
    }
    body {
     background-color: #f9f9fa
    }

    .flex {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto
    }

    @media (max-width:991.98px) {
        .padding {
            padding: 1.5rem
        }
    }

    @media (max-width:767.98px) {
        .padding {
            padding: 1rem
        }
    }

    .padding {
        padding: 5rem
    }

    .card {
        background: #fff;
        border-width: 0;
        border-radius: .25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
        margin-bottom: 1.5rem
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(19, 24, 44, .125);
        border-radius: .25rem
    }

    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(19, 24, 44, .03);
        border-bottom: 1px solid rgba(19, 24, 44, .125)
    }

    .card-header:first-child {
        border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
    }

    card-footer,
    .card-header {
        background-color: transparent;
        border-color: rgba(160, 175, 185, .15);
        background-clip: padding-box
    }
    </style>
</head>
<body>
<link rel="stylesheet" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css" integrity="sha384-jbCTJB16Q17718YM9U22iJkhuGbS0Gd2LjaWb4YJEZToOPmnKDjySVa323U+W7Fv" crossorigin="anonymous">
<div class="container">
<div class="col-md-12">
    <div class="offer-dedicated-body-left">
        <div class="tab-content" id="pills-tabContent">
            
            <div class="tab-pane fade active show" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                <div id="ratings-and-reviews" class="bg-white rounded shadow-sm p-4 mb-4 clearfix restaurant-detailed-star-rating">
                    <h5 class="mb-0 pt-1">Ulasan {{$place->name}}</h5>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>

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

                    <div>
                        <form action="{{URL::to('/admin/download/rating')}}" method="post">
                            {{ csrf_field() }}
                            <select class="form-control m-1" name="type_export">
                                <option value="rating">Ulasan Bintang</option>
                                <option value="question">Ulasan Pertanyaan</option>
                            </select>
                            <input class="form-control m-1" type="hidden" name="place_id" value="{{$place->id}}">
                            <input class="form-control  m-1" type="date" name="date_start" required>
                            <input class="form-control  m-1" type="date" name="date_end" required>
                            <input class="btn btn-primary  m-1" type="submit" value="download">
                        </form>
                    </div>
                    <div class="row">

                        <p hidden id="report_js">{{ json_encode($report_js) }}</p> 
                        <script>
                            var max_data = JSON.parse(document.getElementById('report_js').innerHTML).length;
                                var ind = 0;
                                $(document).ready(function() {
                                    start_chart();
                                });
                                function start_chart(){
                                if(ind <= 0){
                                    var ctx = $('#pie-chart');
                                    var myLineChart = new Chart(ctx, JSON.parse(document.getElementById('report_js').innerHTML)[ind]['datas']);
                                }
                                }
                                function next_chart(){
                                    // console.log('index sekarang : '+ind);
                                    if(ind < max_data){
                                        ind++;
                                        if(ind >= max_data){
                                            ind--;
                                        }
                                        var ctx = $('#pie-chart');
                                        var myLineChart = new Chart(ctx, JSON.parse(document.getElementById('report_js').innerHTML)[ind]['datas']);
                                        // console.log('index sekarang : '+ind);
                                    }else{
                                        alert('max');
                                    }
                                }
                                function prev_chart(){
                                    // console.log('index sekarang : '+ind);
                                    if(ind >= 0){
                                        ind--;
                                        if(ind < 0){
                                            ind++;
                                        }
                                        var ctx = $('#pie-chart');
                                        var myLineChart = new Chart(ctx, JSON.parse(document.getElementById('report_js').innerHTML)[ind]['datas']);
                                        // console.log('index sekarang : '+ind);
                                    }else{
                                        alert('min');
                                    }
                                }
                        </script>
                    
                    <div class="col-12 page-content page-container" id="page-content">
                        <div class="mt-2">
                            <div class="row">
                                <div class="container-fluid d-flex justify-content-center">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                    </div>
                                                </div> <canvas id="pie-chart" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary m-2" onclick="prev_chart()"><i class="fa fa-arrow-left"></i> Pertanyaan sebelumnya</button>
                        <button class="btn btn-primary m-2" onclick="next_chart()">Pertanyaan selanjutnya <i class="fa fa-arrow-right"></i></button>
                    </div>
                    </div>
                </div>
                <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                    <h5 class="mb-0 mb-4">Ulasan dan komentar</h5>
                    <div class="graph-star-rating-header">
                        <div class="star-rating">
                            @switch($rating)
                                @case($rating >= 0 && $rating < 2.0)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star"></span>
                                    @break
                                @case($rating >= 2.0 && $rating < 3.0)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star"></span>
                                    @break
                                @case($rating >= 3.0 && $rating < 4.0)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star"></span>
                                    @break
                                @case($rating >= 4.0 && $rating < 5.0)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    @break
                                @case($rating >= 5.0)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    @break     
                            @endswitch
                             <b class="text-black ml-2">{{$all}} ulasan</b>
                        </div>
                        <p class="text-black mb-4 mt-2">Rating {{number_format($rating, 1)}} dari 5</p>
                    </div>
                    <div class="graph-star-rating-body">
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                                5 <span class="fa fa-star checked"></span>
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width: {{$p_five}}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black">{{number_format($p_five,0)}}%</div>
                        </div>
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                                4 <span class="fa fa-star checked"></span>
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width: {{$p_four}}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black">{{number_format($p_four,0)}}%</div>
                        </div>
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                                3 <span class="fa fa-star checked"></span>
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width: {{$p_three}}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black">{{number_format($p_three,0)}}%</div>
                        </div>
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                                2 <span class="fa fa-star checked"></span>
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width: {{$p_two}}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black">{{number_format($p_two,0)}}%</div>
                        </div>
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                                1 <span class="fa fa-star checked"></span>
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width: {{$p_one}}%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black">{{number_format($p_one,0)}}%</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                    {{-- <a href="#" class="btn btn-outline-primary btn-sm float-right">Top Rated</a> --}}
                    <h5 class="mb-1">Semua Ulasan</h5>


                    @foreach ($reviews as $data)
                    <div class="reviews-members pt-4 pb-4">
                        <div class="media">
                            <a href="#"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar1.png" class="mr-3 rounded-pill"></a>
                            <div class="media-body">
                                <div class="reviews-members-header">
                                    <span class="star-rating float-right">
                                        
                                        @switch($data->score)
                                        @case($data->score == 1)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star"></span>
                                            @break
                                        @case($data->score == 2)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star"></span>
                                            @break
                                        @case($data->score == 3)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star"></span>
                                            @break
                                        @case($data->score == 4)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            @break
                                        @case($data->score == 5)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            @break     
                                    @endswitch
                                          </span>
                                    {{-- <h6 class="mb-1"><a class="text-black" href="#">Singh Osahan</a></h6> --}}
                                    <p class="text-gray">{{ date('l, d-M-Y H:m:s', strtotime($data->created_at))}}</p>
                                </div>
                                <div class="reviews-members-body">
                                    <p>{{$data->comments}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach


                    <div class="col-12 mt-3">
                    {{$reviews->links('pagination::bootstrap-4')}}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>

<style type="text/css">
body{
background:#dcdcdc;    
}
.total-like-user-main a {
    display: inline-block;
    margin: 0 -17px 0 0;
}
.total-like {
    border: 1px solid;
    border-radius: 50px;
    display: inline-block;
    font-weight: 500;
    height: 34px;
    line-height: 33px;
    padding: 0 13px;
    vertical-align: top;
}
.restaurant-detailed-ratings-and-reviews hr {
    margin: 0 -24px;
}
.graph-star-rating-header .star-rating {
    font-size: 17px;
}
.progress {
    background: #f2f4f8 none repeat scroll 0 0;
    border-radius: 0;
    height: 30px;
}
.rating-list {
    display: inline-flex;
    margin-bottom: 15px;
    width: 100%;
}
.rating-list-left {
    height: 16px;
    line-height: 29px;
    width: 10%;
}
.rating-list-center {
    width: 80%;
}
.rating-list-right {
    line-height: 29px;
    text-align: right;
    width: 10%;
}
.restaurant-slider-pics {
    bottom: 0;
    font-size: 12px;
    left: 0;
    z-index: 999;
    padding: 0 10px;
}
.restaurant-slider-view-all {
    bottom: 15px;
    right: 15px;
    z-index: 999;
}
.offer-dedicated-nav .nav-link.active,
.offer-dedicated-nav .nav-link:hover,
.offer-dedicated-nav .nav-link:focus {
    border-color: #3868fb;
    color: #3868fb;
}
.offer-dedicated-nav .nav-link {
    border-bottom: 2px solid #fff;
    color: #000000;
    padding: 16px 0;
    font-weight: 600;
}
.offer-dedicated-nav .nav-item {
    margin: 0 37px 0 0;
}
.restaurant-detailed-action-btn {
    margin-top: 12px;
}
.restaurant-detailed-header-right .btn-success {
    border-radius: 3px;
    height: 45px;
    margin: -18px 0 18px;
    min-width: 130px;
    padding: 7px;
}
.text-black {
    color: #000000;
}
.icon-overlap {
    bottom: -23px;
    font-size: 74px;
    opacity: 0.23;
    position: absolute;
    right: -32px;
}
.menu-list img {
    width: 41px;
    height: 41px;
    object-fit: cover;
}
.restaurant-detailed-header-left img {
    width: 88px;
    height: 88px;
    border-radius: 3px;
    object-fit: cover;
    box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075)!important;
}
.reviews-members .media .mr-3 {
    width: 56px;
    height: 56px;
    object-fit: cover;
}
.rounded-pill {
    border-radius: 50rem!important;
}
.total-like-user {
    border: 2px solid #fff;
    height: 34px;
    box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075)!important;
    width: 34px;
}
.total-like-user-main a {
    display: inline-block;
    margin: 0 -17px 0 0;
}
.total-like {
    border: 1px solid;
    border-radius: 50px;
    display: inline-block;
    font-weight: 500;
    height: 34px;
    line-height: 33px;
    padding: 0 13px;
    vertical-align: top;
}
.restaurant-detailed-ratings-and-reviews hr {
    margin: 0 -24px;
}
.graph-star-rating-header .star-rating {
    font-size: 17px;
}
.progress {
    background: #f2f4f8 none repeat scroll 0 0;
    border-radius: 0;
    height: 30px;
}
.rating-list {
    display: inline-flex;
    margin-bottom: 15px;
    width: 100%;
}
.rating-list-left {
    height: 16px;
    line-height: 29px;
    width: 10%;
}
.rating-list-center {
    width: 80%;
}
.rating-list-right {
    line-height: 29px;
    text-align: right;
    width: 10%;
}
.restaurant-slider-pics {
    bottom: 0;
    font-size: 12px;
    left: 0;
    z-index: 999;
    padding: 0 10px;
}
.restaurant-slider-view-all {
    bottom: 15px;
    right: 15px;
    z-index: 999;
}

.progress {
    background: #f2f4f8 none repeat scroll 0 0;
    border-radius: 0;
    height: 30px;
}




</style>

<script type="text/javascript">

</script>
</body>
</html>