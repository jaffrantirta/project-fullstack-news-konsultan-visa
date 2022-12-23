<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\SystemSettings;
use Redirect;

class CategoriesController extends Controller
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
    public function index()
    {
        $categories = Categories::latest()->paginate(5);
        $page = array(
            'title'=>'Kategori',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.category', ['categories'=>$categories, 'page'=>$page]);
    }

    public function category_select($post_id)
    {
        $data['categories'] = Post_category::where('post_id', $post_id)->with('post_')->with('category')->latest()->paginate(5);
        $data['page'] = array(
            'title'=>'Kategori',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        // return $data;
        return view('administrator.category_post', $data);
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

        $request->validate([
            'category' => 'required'
        ]);

        $category = new Categories();
        $category->category = $request->category;
        $category->created_by = Auth::user()->name;
        $category->updated_by = Auth::user()->name;
        $category->save();

        return redirect('admin/category')->with('success', 'Kategori Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        return Categories::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required'
        ]);
        $categories = Categories::find($id)->update($request->all()); 
        return redirect('admin/category')->with('success', 'Perubahan Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Categories::where('id', $request->category_id)->delete();
        return redirect('admin/category')->with('success', 'Kategori Berhasil Dihapus.');
    }
}
