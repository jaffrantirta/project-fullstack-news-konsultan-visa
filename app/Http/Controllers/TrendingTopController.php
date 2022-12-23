<?php

namespace App\Http\Controllers;

use App\Models\Trending_top;
use Illuminate\Http\Request;

class TrendingTopController extends Controller
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

        $top = new Trending_top();
        $top->post_id = $request->post_id;
        $top->save();

        return redirect('admin/post')->with('success', 'Berita Ditambahkan Sebagai Trending Top.');
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
     * @param  \App\Models\Trending_top  $trending_top
     * @return \Illuminate\Http\Response
     */
    public function show(Trending_top $trending_top)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trending_top  $trending_top
     * @return \Illuminate\Http\Response
     */
    public function edit(Trending_top $trending_top)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trending_top  $trending_top
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trending_top $trending_top)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trending_top  $trending_top
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trending_top $trending_top)
    {
        //
    }
}
