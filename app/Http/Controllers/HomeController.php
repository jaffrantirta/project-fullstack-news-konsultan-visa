<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use App\Models\Setting;
use App\Models\Hit;
use App\Models\Ad;
use App\Models\Youtube;
use App\Models\Trending_top;
use App\Models\Trending_bottom;
use App\Models\Posts;
use App\Models\Post_category;
use App\Models\Subscribers;
use Illuminate\Http\Request;
use App\Utils\SystemSettings;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Redirect;

class HomeController extends Controller
{
    public function index()
    {
        
    }
    public function homepage()
    {
        $data['trending_top'] = Trending_top::with('post')->with('post', 'post.post_categories')->with('post', 'post.post_categories.category')->latest()->first();
        $data['trending_bottom'] = Trending_bottom::with('post')->with('post', 'post.post_categories')->with('post', 'post.post_categories.category')->latest()->limit(3)->get();
        $data['right_content'] = Posts::with('post_categories')->with('post_categories', 'post_categories.category')->where('is_published', true)->latest()->limit(2)->get();
        $data['trending_weekly'] = Hit::select('post_id', DB::raw('COUNT(hits.post_id) as sum'))->with('post')->with('post', 'post.post_categories')->with('post', 'post.post_categories.category')->groupBy('post_id')->orderBy('post_id', 'desc')->limit(4)->get();
        $data['post_by_categories'] = Categories::inRandomOrder()->with(['post_category_' => function($query) {
            $query->with('post_')->limit(5);
        }])->limit(5)->get();
        // $category = Categories::inRandomOrder()->first();
        if(Categories::inRandomOrder()->exists()){
            $category_id = Categories::inRandomOrder()->first()->id;
        }else{
            $category_id = 0;
        }
        $data['category_selected'] = Categories::with('post_category_')->with('post_category_', 'post_category_.post_')->where('id', $category_id)->first();
        $data['reacent_articles'] = Posts::with('post_categories')->with('post_categories', 'post_categories.category')->where('is_published', true)->limit(10)->get();
        $data['system_info'] = array(
            'system' => SystemSettings::getAll(),
            'socmed' => SystemSettings::social_media(),
            'ads' => array(
                'top' => Ad::where('position', 'top')->inRandomOrder()->first(),
                'bottom' => Ad::where('position', 'bottom')->inRandomOrder()->first(),
            ),
        );
        $data['categories'] = Categories::all();
        $data['youtube'] = Youtube::inRandomOrder()->get();
        // return $data;
        return view('homepage.home', $data);
    }
    public function search(Request $request)
    {
        $data['is_search'] = true;
        $keyword = $request->keyword;
        $data['text_title'] = 'Hasil pencarian "'.$keyword.'"';
        $data['latest_news'] = Posts::with('post_categories')->with('post_categories', 'post_categories.category')->latest()->limit(4)->get();
        $data['result'] = Posts::with('post_categories')->with('post_categories', 'post_categories.category')->where('title','LIKE','%'.$keyword.'%')->latest()->paginate(5);
        $data['system_info'] = array(
            'system' => SystemSettings::getAll(),
            'socmed' => SystemSettings::social_media(),
            'ads' => array(
                'top' => Ad::where('position', 'top')->inRandomOrder()->first(),
                'bottom' => Ad::where('position', 'bottom')->inRandomOrder()->first(),
            ),
        );
        $data['categories'] = Categories::all();
        $data['categories_sum'] = Post_category::select('category_id', DB::raw('COUNT(post_id)as sum'))->groupBy('category_id')->with('category')->get();
        // return $data;
        return view('homepage.list_news', $data);
    }
    public function category(Request $request)
    {
        $data['is_search'] = false;
        $category = 'Menampilkan berita kategori '.$request->category;
        $data['text_title'] = $category;
        $data['latest_news'] = Posts::with('post_categories')->with('post_categories', 'post_categories.category')->latest()->limit(4)->get();
        $data['result'] = Categories::with('post_category_')->with('post_category_', 'post_category_.post_')->where('category', $request->category)->latest()->paginate(5);
        $data['system_info'] = array(
            'system' => SystemSettings::getAll(),
            'socmed' => SystemSettings::social_media(),
            'ads' => array(
                'top' => Ad::where('position', 'top')->inRandomOrder()->first(),
                'bottom' => Ad::where('position', 'bottom')->inRandomOrder()->first(),
            ),
        );
        $data['categories'] = Categories::all();
        $data['categories_sum'] = Post_category::select('category_id', DB::raw('COUNT(post_id)as sum'))->groupBy('category_id')->with('category')->get();
        // return $data;
        return view('homepage.list_news', $data);
    }
    public function set_subs(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:subscribers'
        ]);
        $subs = new Subscribers();
        $subs->email = $request->email;
        $subs->is_active = 1;
        $subs->save();
        return redirect('/')->with('success', 'Anda berhasil berlangganan berita.');
    }
    public function show(Request $request)
    {
        $url = $request->news;
        $hit = new Hit();
        $hit->post_id = Posts::where('url', $url)->first()->id;
        $hit->save();
        $data['trending_bottom'] = Trending_bottom::with('post')->with('post', 'post.post_categories')->with('post', 'post.post_categories.category')->latest()->limit(3)->get();
        $data['news'] = Posts::with('post_categories')->with('post_categories', 'post_categories.category')->where('url', $url)->first();
        $data['system_info'] = array(
            'system' => array(
                'slogan' => Setting::where('name', 'system_name')->first()->content,
                'system_name' => $data['news']->title,
                'corporate_name' => Setting::where('name', 'corporate_name')->first()->content
            ),
            'socmed' => SystemSettings::social_media(),
            'ads' => array(
                'top' => Ad::where('position', 'top')->inRandomOrder()->first(),
                'bottom' => Ad::where('position', 'bottom')->inRandomOrder()->first(),
            ),
        );
        $data['categories'] = Categories::all();
        $data['categories_sum'] = Post_category::select('category_id', DB::raw('COUNT(post_id)as sum'))->groupBy('category_id')->with('category')->get();
        // return $data;
        return view('homepage.details', $data);
    }

    public function show_news_in_app()
    {
        // $data = Trending_bottom::join('posts', 'posts.id', 'trending_bottoms.post_id')
        // ->select(
        //     'posts.id', 
        //     'posts.title', 
        //     'posts.content',
        //     'posts.picture',
        //     'posts.author',
        //     'posts.url',
        //     'posts.created_at')
        // ->with('categories')
        // ->latest()
        // ->get();

        $data = Posts::with('categories')
        ->latest()
        ->limit(20)
        ->get()
        ->makeHidden(['id', 'content', 'url', 'picture', 'created_by', 'updated_by', 'created_at', 'updated_at', 'is_published']);
        return $data;
    }
}
