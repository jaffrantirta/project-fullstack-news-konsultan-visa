<?php
namespace App\Utils;
use App\Models\Setting;
use Illuminate\Http\Request;
class YoutubeUtil {
    public static function embed($url)
    {
        // $url = 'https://www.youtube.com/watch?v=CSdC3uUwkog';
        $substr = "=";
        if (strpos($url, $substr) !== false) {
            $url_arr  = explode("=", $url);
            $video_id = $url_arr[1];
        } else {
            $url_arr  = explode("/", $url);
            $video_id = $url_arr[3];
        }
        $embed_url = "https://www.youtube.com/embed/" . $video_id;
        return $embed_url;
    }
}