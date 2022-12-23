<?php

namespace App\Http\Controllers;

use App\Models\Social_media;
use Illuminate\Http\Request;
use App\Utils\SystemSettings;

class SocialMediaController extends Controller
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
        $data['social_media'] = Social_media::paginate(5);
        $data['page'] = array(
            'title'=>'Sosial Media',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.social_media', $data);
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
            'username' => 'required',
            'url' => 'required|url',
            'icon' => 'required',
        ]);

        $save = new Social_media();
        $save->name = $request->name;
        $save->username = $request->username;
        $save->url = $request->url;
        $save->icon = $request->icon;
        $save->save();

        return redirect('admin/socmed')->with('success', 'Sosial Media Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Social_media  $social_media
     * @return \Illuminate\Http\Response
     */
    public function show(Social_media $social_media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Social_media  $social_media
     * @return \Illuminate\Http\Response
     */
    public function edit(Social_media $social_media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Social_media  $social_media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'url' => 'required|url',
            'icon' => 'required',
        ]);
        $update = Social_media::find($id)->update($request->all()); 
        return redirect('admin/socmed')->with('success', 'Perubahan Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Social_media  $social_media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Social_media::find($id)->delete();
        return redirect('admin/socmed')->with('success', 'Sosial Media Berhasil Dihapus.');
    }
}
