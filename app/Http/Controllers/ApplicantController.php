<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\BroadcastApplicant;

class ApplicantController extends Controller
{
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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'service' => 'required',
            'file' => 'required|mimes:pdf|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cv = $request->file('file');
        $path = $cv->store('public');

        $save = new Applicant();
        $save->name = $request->name;
        $save->email = $request->email;
        $save->phone = $request->phone;
        $save->cv = Storage::url($path);
        $save->country = $request->name;
        $save->service = $request->service;
        $save->position = $request->position;
        $save->save();

        Mail::to('franartika@gmail.com')->send(new BroadcastApplicant([
            'subject' => 'New applicant : '.$request->name.' - '.$request->country.' - '.$request->service.' - '.$request->position,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cv' => url(Storage::url($path)),
            'country' => $request->country,
            'service' => $request->service,
            'position' => $request->position,
        ]));

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
