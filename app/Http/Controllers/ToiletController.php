<?php

namespace App\Http\Controllers;
use App\Models\Places_to_build;
use App\Models\Building;
use App\Models\Setting;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\SystemSettings;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Utils\PremiumUser;

class ToiletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $role = Auth::user()->roles[0]->name;
        if($role == 'Super-Admin'){
            $data['toilet'] = Places_to_build::where('building_id', $id)->with('place')->latest()->paginate(5);
        }else{
            if(PremiumUser::check(Auth::user()->id)){
                $data['toilet'] = Places_to_build::where('building_id', $id)->with('place')->latest()->paginate(5);
            }else{
                if(Places_to_build::where('building_id', $id)->exists()){
                    $latest_toilet = Places_to_build::where('building_id', $id)->latest()->first()->place_id;
                    $data['toilet'] = Places_to_build::where('place_id', $latest_toilet)->with('place')->latest()->paginate(1);
                }else{
                    $data['toilet'] = Places_to_build::where('building_id', $id)->with('place')->latest()->paginate(5);
                }
            }
        }
        
        $data['building'] = Building::find($id);
        $data['page'] = array(
            'title'=>'Toilet',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        // return $data;
        return view('administrator.toilet', $data);
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if(PremiumUser::check(Auth::user()->id)){
            return $this->add_toilet($request, $id);
        }else{
            if(Places_to_build::where('building_id', $id)->count() >= Setting::where('name', 'limit_toilet_free_user')->first()->content ){
                return redirect('admin/'.$id.'/toilet')->withErrors(['Oops! Akun free hanya bisa memasukan 1 point/toilet, silahkan upgrade PREMIUM.']);
            }else{
                return $this->add_toilet($request, $id);
            }
        }
    }
    public function add_toilet($request, $id)
    {
        DB::beginTransaction();
            try {
                $place = new Place();
                $place->name = $request->name;
                $place->is_active = 1;
                $place->uuid = Str::uuid();
                $place->save();
                $place_id = $place->id;

                $place_to_build = new Places_to_build();
                $place_to_build->building_id = $id;
                $place_to_build->place_id = $place_id;
                $place_to_build->save();

                DB::commit();
      
                return redirect('admin/'.$id.'/toilet')->with('success', 'Toilet Ditambahkan.');

            } catch (\Exception $e) {
                DB::rollback();
                return redirect('admin/'.$id.'/toilet')->withErrors(['message', 'Oops! Sepertinya ada kesalahan.']);
            }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $building = Place::find($id)->update($request->all()); 
        return redirect('admin/'.$id.'/toilet')->with('success', 'Perubahan Berhasil.');
    }
    public function destroy(Request $request)
    {
        Place::where('id', $request->point_id)->delete();
        return redirect('admin/'.$id.'/toilet')->with('success', 'Point Berhasil Dihapus.');
    }
}
