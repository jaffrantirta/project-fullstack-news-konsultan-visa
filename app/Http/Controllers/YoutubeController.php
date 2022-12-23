<?php

namespace App\Http\Controllers;

use App\Models\Youtube;
use Illuminate\Http\Request;
use App\Utils\SystemSettings;
use App\Utils\YoutubeUtil;

class YoutubeController extends Controller
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
        $data['youtube'] = Youtube::latest()->paginate(5);
        $data['page'] = array(
            'title'=>'Youtube',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.youtube', $data);
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
            'name' => 'required',
            'link' => 'required|url'
        ]);
        $save = new Youtube();
        $save->name = $request->name;
        $save->link = YoutubeUtil::embed($request->link);
        $save->save();

        return redirect('admin/youtube')->with('success', 'Link Ditambahkan.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function show(Youtube $youtube)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function edit(Youtube $youtube)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'required|url'
        ]);
        $update = Youtube::find($id)->update(array(
            'name' => $request->name,
            'link' => YoutubeUtil::embed($request->link)
        )); 
        return redirect('admin/youtube')->with('success', 'Perubahan Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Youtube::find($id)->delete();
        return redirect('admin/youtube')->with('success', 'Link Berhasil Dihapus.');
    }
}
