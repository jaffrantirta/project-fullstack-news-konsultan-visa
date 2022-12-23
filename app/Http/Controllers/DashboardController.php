<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Hit;
use App\Models\Rating;
use App\Models\Setting;
use App\Models\User_point;
use App\Models\Places_to_build;
use App\Models\Post_category;
use App\Models\User;
use App\Models\Posts;
use App\Models\Building;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Utils\SystemSettings;
use App\Utils\PremiumUser;
use App\Utils\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['page'] = array(
            'title'=>'Dashboard',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        if (Auth::user()->hasRole('Super-Admin')) {
            $data['dashboard'][0]['name'] = 'Pengguna';
            $data['dashboard'][0]['sum'] = User::count();
            $data['dashboard'][1]['name'] = 'Berita'; 
            $data['dashboard'][1]['sum'] = Posts::count(); 
            $data['dashboard'][2]['name'] = 'Point'; 
            $data['dashboard'][2]['sum'] = Building::count(); 
            $data['dashboard'][3]['name'] = 'Toilet'; 
            $data['dashboard'][3]['sum'] = Place::count(); 

            $data['statistic'] = $this->statistic();
            $data['pie'] = $this->news_per_category();
            $data['top_news'] = $this->top_news();
            $data['top_toilet'] = $this->top_toilet();
        }else if(Auth::user()->hasRole('writer')){
            $data['dashboard'][0]['name'] = 'Berita'; 
            $data['dashboard'][0]['sum'] = Posts::where('created_by', Auth::user()->id)->count(); 
        }else if(Auth::user()->hasRole('user-point')){
            if(PremiumUser::check(Auth::user()->id)){
                $data['user_detail']['greeting'] = $this->greeting().', '.Auth::user()->name;
                $data['user_detail']['status_user'] = 'PREMIUM USER';
                $data['user_detail']['description'] = 'Kamu bisa buat point dan toilet lebih dari 1 loh!';
                $data['user_detail']['btn_class'] = 'btn btn-primary';
                $data['user_detail']['link'] = Setting::where('name', 'link_premium_user')->first()->content;
                $data['user_detail']['btn_text'] = 'Pelajari Lebih Lanjut';
                $data['user_detail']['style'] = 'height: 300px; filter: brightness(50%);';

                $sum_point = User_point::where('user_id', Auth::user()->id)->count();
                $sum_toilet = User_point::join('buildings', 'buildings.id', 'user_points.building_id')
                ->join('places_to_builds', 'places_to_builds.building_id', 'buildings.id')
                ->where('user_id', Auth::user()->id)
                ->count();
            }else{
                $data['user_detail']['greeting'] = $this->greeting().', '.Auth::user()->name;
                $data['user_detail']['status_user'] = 'FREE USER';
                $data['user_detail']['description'] = 'Yuk upgrade premium untuk bisa buat lebih dari 1 point dan toilet. Upgrade sekarang!';
                $data['user_detail']['btn_class'] = 'btn btn-secondary';
                $data['user_detail']['link'] = Setting::where('name', 'link_free_user')->first()->content;
                $data['user_detail']['btn_text'] = 'Dapatkan Premium User';
                $data['user_detail']['style'] = 'height: 300px; filter: grayscale(100%);';

                if(User_point::where('user_id', Auth::user()->id)->count() >= 1){
                    $sum_point = 1;
                }else{
                    $sum_point = 0;
                }
                if(User_point::where('user_id', Auth::user()->id)->exists()){
                    $sum_toilet = 1;
                }else{
                    $sum_toilet = 0;
                }
            }
            $data['dashboard'][0]['name'] = 'Point'; 
            $data['dashboard'][0]['sum'] = $sum_point; 
            $data['dashboard'][1]['name'] = 'Toilet'; 
            $data['dashboard'][1]['sum'] = $sum_toilet;

            $data['ratings'] = $this->ratings_per_place('all');
            $data['statistic'] = $this->statistic_user_point();
        }
        // return $data;
        return view('administrator.home', $data);
    }
    public function greeting()
    {
        $Hour = date('G');

        if ( $Hour >= 5 && $Hour < 12 ) {
            return "Selamat Pagi";
        } else if ( $Hour >= 12 && $Hour < 15 ) {
            return "Selamat Siang";
        } else if ( $Hour >= 15 && $Hour < 18 ) {
            return "Selamat Sore";
        } else if ( $Hour >= 18 || $Hour <= 4 ) {
            return "Selamat Malam";
        }
    }
    public function ratings_per_place($date)
    {
        $data_place = User_point::join('buildings', 'buildings.id', 'user_points.building_id')
        ->join('places_to_builds', 'places_to_builds.building_id', 'buildings.id')
        ->join('places', 'places.id', 'places_to_builds.place_id')
        ->join(DB::raw('buildings b'), 'b.id', 'places_to_builds.building_id')
        ->select('places_to_builds.place_id', 'places.*', DB::raw('b.name as build_name'))
        ->where('user_id', Auth::user()->id)
        ->get();

        if(count($data_place) > 0){
            $i = 0;
            foreach ($data_place as $item) {
                $data[$i]['place_id'] = $item->place_id;
                $data[$i]['name'] = $item->name;
                $data[$i]['build_name'] = $item->build_name;
                if($date == 'all'){
                    $data[$i]['sum'] = Rating::where('place_id', $item->place_id)->avg('score');
                    $data[$i]['count'] = Rating::where('place_id', $item->place_id)->count();
                }else{
                    $data[$i]['sum'] = Rating::where('place_id', $item->place_id)->whereDate('created_at', '=', $date)->avg('score');
                    $data[$i]['count'] = Rating::where('place_id', $item->place_id)->whereDate('created_at', '=', $date)->count();
                }
                $i++;
            }
        }else{
            $data = null;
        }
        return $data;
    }
    public function top_news()
    {
        if(Auth::user()->hasRole('Super-Admin')){
            $news = Hit::select('post_id', DB::raw('count(post_id) as sum'))
            ->groupBy('post_id')
            ->orderBy('sum', 'DESC')
            ->with('post')
            ->limit(5)
            ->get();
            return $news;
        }else if(Auth::user()->hasRole('writer')){
            $news = Hit::select('post_id', DB::raw('count(post_id) as sum'))
            ->groupBy('post_id')
            ->orderBy('sum', 'DESC')
            ->with('post')
            ->join('posts', 'posts.id', 'hits.post_id')
            ->where('created_by', Auth::user()->id)
            ->limit(5)
            ->get();
            return $news;
        }
    }
    public function top_toilet()
    {
        $toilet = Rating::select('place_id', DB::raw('AVG(score) as rate'))
        ->with('place_to_build')
        ->with('place_to_build', 'place_to_build.build')
        ->groupBy('ratings.place_id')
        ->orderBy('rate', 'DESC')
        ->with('place')
        ->limit(5)
        ->get();
        return $toilet;
    }
    public function top_point()
    {
        $news = Rating::select('place_id', DB::raw('AVG(score) as rate'))
        ->groupBy('place_id')
        ->orderBy('rate', 'DESC')
        ->with('place')
        ->limit(5)
        ->get();
        return $news;
    }
    public function news_per_category()
    {
        if(Categories::exists()){
            $categories = Categories::all();
            $i = 0;
            foreach ($categories as $item) {
                $nc = Post_category::where('category_id', $item->id)->count();
                if($nc == null){
                    $category_value[$i] = 0;
                }else{
                    $category_value[$i] = $nc;
                }
                $category_color[$i] = $this->random_color();
                $category_name[$i] = $item->category;
                $i++;
            }

            $data['datasets'][0] = array(
                'hoverBorderColor' => '#ffffff',
                'data' => $category_value,
                'backgroundColor' => $category_color,
            );
            $data['labels'] = $category_name;
            return $data;
        }
    }
    public function statistic_user_point()
    {
        $in = 0;
        for($i=0;$i<=31;$i++){
            $tm = 0;
            $ratings = $this->ratings_per_place(Carbon::now()->format('Y-m').'-'.$i);
            if (is_array($ratings) || is_object($ratings)){
                foreach ($ratings as $item) {
                    $tm = $tm + $item['sum'];
                }
                if($tm == null){
                    $this_month[$in] = 0;
                }else{
                    $this_month[$in] = $tm;
                }
                $in++;
            }else{
                $this_month[$in] = 0;
            }
        }

        $ind = 0;
        for($id=0;$id<=31;$id++){
            $tm = 0;
            $ratings = $this->ratings_per_place(Carbon::now()->format('Y-m').'-'.$i);
            if (is_array($ratings) || is_object($ratings)){
                foreach ($ratings as $item) {
                    $tm = $tm + $item['sum'];
                }

                if($tm == null){
                    $pass_month[$ind] = 0;
                }else{
                    $pass_month[$ind] = $pm;
                }
                $ind++;
            }else{
                $pass_month[$in] = 0;
            }
        }

        $data['datasets'][0] = array(
            'label' => 'Bulan Ini',
            'fill' => 'start',
            'data' => $this_month,
            'backgroundColor' => 'rgba(0,123,255,0.1)',
            'borderColor' => 'rgba(0,123,255,1)',
            'pointBackgroundColor' => '#ffffff',
            'pointHoverBackgroundColor' => 'rgb(0,123,255)',
            'borderWidth' => 1.5,
            'pointRadius' => 0,
            'pointHoverRadius' => 3
        );
        $data['datasets'][1] = array(
            'label' => 'Bulan Lalu',
            'fill' => 'start',
            'data' => $pass_month,
            'backgroundColor' => 'rgba(255,65,105,0.1)',
            'borderColor' => 'rgba(255,65,105,1)',
            'pointBackgroundColor' => '#ffffff',
            'pointHoverBackgroundColor' => 'rgba(255,65,105,1)',
            'borderDash' => [3, 3],
            'borderWidth' => 1,
            'pointRadius' => 0,
            'pointHoverRadius' => 2,
            'pointBorderColor' => 'rgba(255,65,105,1)'
        );

        return $data;
    }
    public function statistic()
    {
        $in = 0;
        for($i=0;$i<=31;$i++){
            $tm = Hit::select(DB::raw('count(post_id) as sum'))
            ->whereDate('created_at', '=', Carbon::now()->format('Y-m').'-'.$i)
            ->first()->sum;

            if($tm == null){
                $this_month[$in] = 0;
            }else{
                $this_month[$in] = $tm;
            }
            $in++;
        }

        $ind = 0;
        for($id=0;$id<=31;$id++){
            $pm = Hit::select(DB::raw('count(post_id) as sum'))
            ->whereDate('created_at', '=', Carbon::now()->subMonth()->format('Y-m').'-'.$id)
            ->first()->sum;

            if($tm == null){
                $pass_month[$ind] = 0;
            }else{
                $pass_month[$ind] = $pm;
            }
            $ind++;
        }

        $data['datasets'][0] = array(
            'label' => 'Bulan Ini',
            'fill' => 'start',
            'data' => $this_month,
            'backgroundColor' => 'rgba(0,123,255,0.1)',
            'borderColor' => 'rgba(0,123,255,1)',
            'pointBackgroundColor' => '#ffffff',
            'pointHoverBackgroundColor' => 'rgb(0,123,255)',
            'borderWidth' => 1.5,
            'pointRadius' => 0,
            'pointHoverRadius' => 3
        );
        $data['datasets'][1] = array(
            'label' => 'Bulan Lalu',
            'fill' => 'start',
            'data' => $pass_month,
            'backgroundColor' => 'rgba(255,65,105,0.1)',
            'borderColor' => 'rgba(255,65,105,1)',
            'pointBackgroundColor' => '#ffffff',
            'pointHoverBackgroundColor' => 'rgba(255,65,105,1)',
            'borderDash' => [3, 3],
            'borderWidth' => 1,
            'pointRadius' => 0,
            'pointHoverRadius' => 2,
            'pointBorderColor' => 'rgba(255,65,105,1)'
        );

        return $data;
    }
    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    function random_color() {
        return '#'.$this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
}
