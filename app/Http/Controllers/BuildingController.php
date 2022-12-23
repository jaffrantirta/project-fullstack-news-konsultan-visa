<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\User;
use App\Models\User_point;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\SystemSettings;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Utils\PremiumUser;

class BuildingController extends Controller
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
        $role = Auth::user()->roles[0]->name;
        if($role == 'Super-Admin'){
            $data['point'] = Building::latest()->paginate(5);
        }else{
            if(PremiumUser::check(Auth::user()->id)){
                $data['point'] = User_point::with('building')->where('user_id', Auth::user()->id)->latest()->paginate(5);
            }else{
                if(User_point::where('user_id', Auth::user()->id)->exists()){
                    $build_id = User_point::where('user_id', Auth::user()->id)->latest()->first()->building_id;
                    $data['point'] = User_point::with('building')->where('building_id', $build_id)->latest()->paginate(1);
                }else{
                    $data['point'] = User_point::with('building')->where('user_id', 0)->latest()->paginate(1);
                }
            }
        }
        $data['page'] = array(
            'title'=>'Point',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.point', $data);
        // return $data;
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
            'name' => 'required'
        ]);

        if(PremiumUser::check(Auth::user()->id)){
            return $this->add_point($request);
        }else{
            if(User_point::where('user_id', Auth::user()->id)->count() >= Setting::where('name', 'limit_toilet_free_user')->first()->content ){
                return redirect('admin/point')->withErrors(['Oops! Akun free hanya bisa memasukan 1 point/toilet, silahkan upgrade PREMIUM.']);
            }else{
                return $this->add_point($request);
            }
        }
    }
    function add_point($request)
    {
        DB::beginTransaction();
            try {
                $building = new Building();
                $building->name = $request->name;
                $building->address = $request->address;
                $building->lat = $request->lat;
                $building->lng = $request->lng;
                $building->phone = $request->phone;
                $building->description = $request->description;
                $building->save();
                $building_id = $building->id;

                $user_point = new User_point();
                $user_point->user_id = Auth::user()->id;
                $user_point->building_id = $building_id;
                $user_point->save();

                DB::commit();
      
                return redirect('admin/point')->with('success', 'Point Ditambahkan.');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('admin/point')->withErrors(['message', 'Oops! Sepertinya ada kesalahan.']);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $building = Building::find($id)->update($request->all()); 
        return redirect('admin/point')->with('success', 'Perubahan Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Building::where('id', $request->point_id)->delete();
        return redirect('admin/point')->with('success', 'Point Berhasil Dihapus');
    }
}
