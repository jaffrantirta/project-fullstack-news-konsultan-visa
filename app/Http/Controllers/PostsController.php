<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Categories;
use App\Models\Post_category;
use Illuminate\Http\Request;
use App\Utils\SystemSettings;
use App\Utils\Check;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function unactive($url)
    {
        Posts::where('url', $url)->update(array('is_published' => false));
        return redirect('admin/post')->with('success', 'Berita telah non-aktif.');

    }
    public function active($url)
    {
        Posts::where('url', $url)->update(array('is_published' => true));
        return redirect('admin/post')->with('success', 'Berita telah aktif.');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->roles[0]->name;
        if($role == 'Super-Admin'){
            $data['posts'] = Posts::withCount('count_hit')->latest()->paginate(5);
        }else{
            $data['posts'] = Posts::withCount('count_hit')->where('created_by', Auth::user()->id)->latest()->paginate(5);
        }
        $data['page'] = array(
            'title'=>'Berita',
            'system'=>SystemSettings::get(array('corporate_name', 'system_name', 'slogan')),
            'socmed'=>SystemSettings::social_media()
        );
        // return $data;
        return view('administrator.post', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'is_published' => 'required',
            'categories' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);
            DB::beginTransaction();
            try {
                if($request->author == null){
                    $author = Auth::user()->name;
                }else{
                    $author = $request->author;
                }
                $file = $request->file('file');
                $file_path = 'res/assets_files/posts/';
                $file_rm_char = preg_replace("/[^a-zA-Z]/", "", $file->getClientOriginalName());
                $file_name = time().$file_rm_char.'.'.$file->extension();

                $post = new Posts();
                $post->title = $request->title;
                $post->content = $request->content;
                $post->author = $author;
                $post->is_published = $request->is_published;
                $post->published_at = Carbon::now()->toDateTimeString();
                $post->created_by = Auth::user()->id;
                $post->updated_by = Auth::user()->id;
                $post->picture = $file_path.$file_name;
                $post->url = preg_replace("/[^a-zA-Z]/", "-", $request->title);
                $post->save();
                $post_id = $post->id;
                $file->move($file_path,$file_name);

                foreach($request->categories as $data){
                    $post_category = new Post_category();
                    $post_category->post_id = $post_id;
                    $post_category->category_id = $data;
                    $post_category->save();
                }

                DB::commit();
                if($request->is_published){
                    return redirect('admin/post/add')->with('success', 'Berita telah ditambahkan dan telah publish.');
                }else{
                    return redirect('admin/post/add')->with('success', 'Berita telah ditambahkan dan akan publish sesuai tanggal ditentukan.');
                }
            } catch (\Exception $e) {
                DB::rollback();
                return $e;
            } catch (\Throwable $th) {
                DB::rollback();
                return $th;
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        $categories = Categories::all();
        $page = array(
            'title'=>'Buat Berita',
            'system'=>SystemSettings::get(array('corporate_name', 'system_name', 'slogan')),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.add_new_post', ['categories'=>$categories, 'page'=>$page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['post'] = Posts::find($id);
        $data['page'] = array(
            'title'=>'Edit Berita',
            'system'=>SystemSettings::get(array('corporate_name', 'system_name', 'slogan')),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.edit_post', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'file' => 'mimes:jpg,jpeg,png|max:2048'
        ]);

        Posts::find($id)->update(
            array(
                'title'=>$request->title,
                'content'=>$request->content,
                'update_by'=>Auth::user()->id
            )
        );
        return redirect('admin/post/add')->with('success', 'Berita telah diperbaharui dan telah publish.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Posts::where('id', $request->post_id)->delete();
        return redirect('admin/post')->with('success', 'Berita Berhasil Dihapus.');
    }
}
