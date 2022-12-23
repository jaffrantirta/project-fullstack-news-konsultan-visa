<?php

namespace App\Http\Controllers;

use App\Models\Trending_bottom;
use Illuminate\Http\Request;

class TrendingBottomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add_to_trending(Request $request)
    {
        $request->validate([
            'post_id' => 'required'
        ]);

        $bottom = new Trending_bottom();
        $bottom->post_id = $request->post_id;
        $bottom->save();

        return redirect('admin/post')->with('success', 'Berita Ditambahkan Sebagai Trending Bottom.');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Trending_bottom  $trending_bottom
     * @return \Illuminate\Http\Response
     */
    public function show(Trending_bottom $trending_bottom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trending_bottom  $trending_bottom
     * @return \Illuminate\Http\Response
     */
    public function edit(Trending_bottom $trending_bottom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trending_bottom  $trending_bottom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trending_bottom $trending_bottom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trending_bottom  $trending_bottom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trending_bottom $trending_bottom)
    {
        //
    }
}
