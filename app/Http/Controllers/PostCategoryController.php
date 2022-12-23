<?php

namespace App\Http\Controllers;

use App\Models\Post_category;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data['post_categories'] = Post_category::where('post_id', $id)->get();
        $data['page'] = array(
            'title'=>'Kategori Berita',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.post_categories', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function show(Post_category $post_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Post_category $post_category)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post_category $post_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post_category $post_category)
    {
        //
    }
}
