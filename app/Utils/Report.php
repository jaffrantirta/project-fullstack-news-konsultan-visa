<?php
namespace App\Utils;
use App\Models\Rating;
use App\Models\Place;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User_point;
use App\Models\Places_to_build;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Report {
    public static function get($id)
    {
        $data['rating'] = Rating::where('place_id', $id)->avg('score');
        $data['five_star'] = Rating::where('place_id', $id)->where('score', 5)->count();
        $data['four_star'] = Rating::where('place_id', $id)->where('score', 4)->count();
        $data['three_star'] = Rating::where('place_id', $id)->where('score', 3)->count();
        $data['two_star'] = Rating::where('place_id', $id)->where('score', 2)->count();
        $data['one_star'] = Rating::where('place_id', $id)->where('score', 1)->count();

        $data['all'] = $data['five_star'] + $data['four_star'] + $data['three_star'] + $data['two_star'] + $data['one_star'];

        $data['place'] = Place::find($id);

        $data['reviews'] = Rating::where('place_id', $id)->latest()->paginate(5);

        $data['questions'] = Question::where('is_active', true)->with('answer')->orderBy('sort', 'asc')->get();

        $data['answers'] = Answer::all();

        foreach ($data['questions'] as $x) {
            $i = 0;
            foreach ($x['answer'] as $y) {
                $data['score'][$x->question][$y->answer] = Feedback::select(DB::raw('count(answer_id) as count'))->where('place_id', '1')->where('answer_id', $y->id)->first();   
                $i++;
            }
        }

        // return $data;

        if($data['all'] != 0){
            $data['star']['p_five'] = ($data['five_star'] / $data['all']) * 100;
            $data['star']['p_four'] = ($data['four_star'] / $data['all']) * 100;
            $data['star']['p_three'] = ($data['three_star'] / $data['all']) * 100;
            $data['star']['p_two'] = ($data['two_star'] / $data['all']) * 100;
            $data['star']['p_one'] = ($data['one_star'] / $data['all']) * 100;
            $data['status'] = true;

            return $data;
        }else{
            return $data['status'] = false;;

        }
    }
    public function all($user_id)
    {
        // $building = User_point::where('user_id', $user_id)->get();
        // $i=0;
        // foreach ($building as $item) {
        //     $place[$i]['building_id'] = $item->building_id;
        //     $get_place = Places_to_build::where('building_id', $item->building_id)->get();
        //     // $in = 0;
        //     foreach ($get_place as $key) {
        //         $score[] = Rating::select('place_id', 'score', DB::raw('count(score) as sum'))->where('place_id', $key->place_id)->where('score', 5)->first();
        //         // $in++;
        //     }
        //     $i++;
        // }
        // return $score;
    }
}