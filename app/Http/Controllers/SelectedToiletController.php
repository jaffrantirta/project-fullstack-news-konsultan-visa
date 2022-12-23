<?php

namespace App\Http\Controllers;

use App\Models\Selected_toilet;
use Illuminate\Http\Request;

class SelectedToiletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data['place'] = Selected_toilet::where('place_id', $id)->latest()->first();
        $data['uuid'] = $id;
        if ($data['place'] === null) {
            return view('administrator.themes.theme1', $data);
        }else{
            return view('administrator.themes.theme1', $data);
        }
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
     * @param  \App\Models\Selected_toilet  $selected_toilet
     * @return \Illuminate\Http\Response
     */
    public function show(Selected_toilet $selected_toilet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Selected_toilet  $selected_toilet
     * @return \Illuminate\Http\Response
     */
    public function edit(Selected_toilet $selected_toilet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Selected_toilet  $selected_toilet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Selected_toilet $selected_toilet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Selected_toilet  $selected_toilet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Selected_toilet $selected_toilet)
    {
        //
    }
}
