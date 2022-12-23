<?php
namespace App\Utils;
use App\Models\Premium;
use Carbon\Carbon;
use Illuminate\Http\Request;
class PremiumUser {
    public static function check($id)
    {
        if(Premium::where('user_id', $id)->whereDate('expire', '>=', Carbon::today()->toDateString())->exists()){
            return true;
        }else{
            return false;
        }
    }
}