<?php

namespace App\Http\Controllers;

use App\Models\Premium;
use App\Models\User;
use App\Utils\SystemSettings;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PremiumController extends Controller
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
        $data['premium'] = Premium::with('user')->latest()->paginate(5);
        $data['page'] = array(
            'title'=>'Premium',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        // return $data;
        return view('administrator.premium', $data);
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
            'user_id' => 'required',
            'expire' => 'required'
        ]);

        if(User::where('existence_number', $request->user_id)->exists()){
            $user_id = User::where('existence_number', $request->user_id)->first()->id;
        }else if(User::where('id', $request->user_id)->exists()){
            $user_id = User::where('id', $request->user_id)->first()->id;
        }

        $current = Carbon::now();
        $expire_day = $current->addDays($request->expire);

        if(Premium::where('id', $user_id)->whereDate('expire', '>=', Carbon::today()->toDateString())->exists()){
            return redirect('admin/premium')->withErrors(['Oops! Sepertinya pengguna sudah premium.']);
        }else{
            $save = new Premium();
            $save->user_id = $user_id;
            $save->expire = $expire_day;
            $save->save();

            return redirect('admin/premium')->with('success', 'Pengguna Premium Ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Premium  $premium
     * @return \Illuminate\Http\Response
     */
    public function show(Premium $premium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premium  $premium
     * @return \Illuminate\Http\Response
     */
    public function edit(Premium $premium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Premium  $premium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Premium $premium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premium  $premium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Premium $premium)
    {
        //
    }
}
