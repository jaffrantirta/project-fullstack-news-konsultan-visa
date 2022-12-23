<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Utils\SystemSettings;
use Illuminate\Http\Request;

class AdController extends Controller
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
        $data['ads'] = Ad::latest()->paginate(5);
        $data['page'] = array(
            'title'=>'Iklan',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.ads', $data);
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
        if($request->position == 'top'){
            $request->validate([
                'name' => 'required',
                'position' => 'required',
                'url' => 'required|url',
                'file' => 'required|max:2048|dimensions:width=2126,height=283'
            ]);
        }else{
            $request->validate([
                'name' => 'required',
                'position' => 'required',
                'url' => 'required|url',
                'file' => 'required|max:2048|dimensions:width=500,height=1258'
            ]);
        }
        
        $file = $request->file('file');
        $file_path = 'res/assets_files/ads/';
        $file_rm_char = preg_replace("/[^a-zA-Z]/", "", $file->getClientOriginalName());
        $file_name = time().$file_rm_char.'.'.$file->extension();

        $save = new Ad();
        $save->name = $request->name;
        $save->position = $request->position;
        $save->url = $request->url;
        $save->banner = $file_path.$file_name;
        $save->save();
        $file->move($file_path,$file_name);

        return redirect('admin/ads')->with('success', 'Iklan Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'url' => 'required|url',
            'file' => 'required'
        ]);
        $update = Ad::find($id)->update($request->all()); 
        return redirect('admin/ads')->with('success', 'Perubahan Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ad::find($id)->delete();
        return redirect('admin/ads')->with('success', 'Iklan Berhasil Dihapus.');
    }
}
