<?php
namespace App\Utils;
use App\Models\Setting;
use App\Models\Social_media;
use Illuminate\Http\Request;
class SystemSettings {
    public static function get($request)
    {
        for($i=0;$i<count($request);$i++){
            $data[$request[$i]] = Setting::where('name', $request[$i])->first()->content;
        }
        return $data;
    }
    public static function getAll()
    {
        $data['corporate_name'] = Setting::where('name', 'corporate_name')->first()->content;
        $data['system_name'] = Setting::where('name', 'system_name')->first()->content;
        $data['slogan'] = Setting::where('name', 'slogan')->first()->content;
        return $data;   
    }
    public static function social_media()
    {
        return Social_media::all();
    }
}