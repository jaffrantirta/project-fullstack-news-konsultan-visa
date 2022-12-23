<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Place;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\SystemSettings;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Exports\Report;
use App\Exports\ToiletReport;
use Maatwebsite\Excel\Facades\Excel;

class RatingController extends Controller
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
    public function index($id)
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

        $data['page'] = array(
            'title'=>'Ulasan',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );

        $in = 0;
        foreach ($data['questions'] as $x) {
            $i = 0;
            foreach ($x['answer'] as $y) {
                $labels[$i] = $y->answer;
                $backgroundColor[$i] = $this->random_color();
                $datas[$i] = Feedback::select(DB::raw('count(answer_id) as count'))->where('place_id', $id)->where('answer_id', $y->id)->first()->count;
                $i++;
            }
            $data['report_js'][$in]['question_id'] = 'pie-chart-'.$x->id;
            $data['report_js'][$in]['datas'] = array(
                'type' => 'pie',
                'data' => array(
                    'labels' => $labels,
                    'datasets' => [
                        array(
                            'data' => $datas,
                            'backgroundColor' => $backgroundColor
                        )
                    ]
                ),
                'options' => array(
                    'title' => array(
                        'display' => true,
                        'text' => $x->question
                    )
                )
            );
            $in++;
        }

        // return $data;


        if($data['all'] != 0){
            $data['p_five'] = ($data['five_star'] / $data['all']) * 100;
            $data['p_four'] = ($data['four_star'] / $data['all']) * 100;
            $data['p_three'] = ($data['three_star'] / $data['all']) * 100;
            $data['p_two'] = ($data['two_star'] / $data['all']) * 100;
            $data['p_one'] = ($data['one_star'] / $data['all']) * 100;

            // return $data;
            return view('administrator.ratings', $data);
        }else{
            return view('administrator.error', $data);

        }
    }
    public function export(Request $request) 
    {
        $request->validate([
            'place_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'type_export' => 'required'
        ]);
        if($request->type_export == 'rating'){
            return (new ToiletReport($request->place_id, $request->date_start, $request->date_end))->download('report_score_'.$request->date_start.'_'.$request->date_end.'.xlsx');
        }else{
            return (new Report($request->place_id, $request->date_start, $request->date_end))->download('report_question_'.$request->date_start.'_'.$request->date_end.'.xlsx');
        }
    }
    public function export_feedback(Request $request) 
    {
        $request->validate([
            'place_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required'
        ]);
        return (new ToiletReport($request->place_id, $request->date_start, $request->date_end))->download('report_score_'.$request->date_start.'_'.$request->date_end.'.xlsx');
    }

    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    function random_color() {
        return '#'.$this->random_color_part() . $this->random_color_part() . $this->random_color_part();
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
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
