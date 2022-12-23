<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\SystemSettings;
use Redirect;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $users = User::with('roles')->latest()->paginate(5);
        $page = array(
            'title'=>'Pengguna',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        // return $users;
        return view('administrator.user', ['users'=>$users, 'page'=>$page]);
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
            'email' => 'required|unique:users',
            'role' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('12345678');
        $user->existence_number = $this->generateExistenceNumber();
        $user->assignRole($request->role);
        $user->save();

        return redirect('admin/users')->with('success', 'Pengguna Ditambahkan.');
    }

    function generateExistenceNumber() {
        $number = mt_rand(1000000000, 9999999999);
        if ($this->existenceNumberExists($number)) {
            return $this->generateExistenceNumber();
        }
        return $number;
    }
    
    function existenceNumberExists($number) {
        return User::where('existence_number', $number)->exists();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $user = User::find($id)->update($request->all()); 
        return redirect('admin/users')->with('success', 'Perubahan Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::where('id', $request->user_id)->delete();
        return redirect('admin/users')->with('success', 'Pengguna Berhasil Dihapus.');
    }
    public function check(Request $request)
    {
        if(User::where('existence_number', $request->user_id)->exists()){
            return User::where('existence_number', $request->user_id)->first();
        }else if(User::where('id', $request->user_id)->exists()){
            return User::where('id', $request->user_id)->first();
        }else{
            return false;
        }
    }
    public function profile()
    {
        $data['user'] = User::find(Auth::user()->id);
        $data['page'] = array(
            'title'=>'Point',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.user_profile', $data);
    }
    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $update = User::find(Auth::user()->id)->update($request->all()); 
        return redirect('admin/profile')->with('success', 'Perubahan Berhasil.');
    }
    public function change_password(Request $request)
    {
        // return $request->all();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'min:8|required',
            'new_password_confirm' => 'same:new_password'
        ]);
        if(Hash::check($request->old_password, Auth::user()->password)){
            $update = User::find(Auth::user()->id)->update(array(
                'password' => Hash::make($request->new_password)
            )); 
            return redirect('admin/profile')->with('success', 'Password Berhasil Diubah.');
        }else{
            return redirect('admin/profile')->withErrors(['Oops! Password lama salah']);
        }
    }
}
