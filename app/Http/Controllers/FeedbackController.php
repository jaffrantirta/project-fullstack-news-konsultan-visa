<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Rating;
use App\Models\Question;
use Illuminate\Http\Request;

use App\Exports\Report;
use Maatwebsite\Excel\Facades\Excel;

use App\Utils\Check;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $check = Check::valid($request, array(
            'feedback' => 'required',
            'star' => 'required|numeric',
            'comment' => 'nullable|string|max:255'
        ));
        if($check == null){
            DB::beginTransaction();
            try {
                $feedback = json_decode($request->feedback, true);
                $place_id = null;
                foreach($feedback['feedback'] as $fb){
                    $place_id = $fb['place_id'];
                    $feed_back = new Feedback();
                    $feed_back->question_id= $fb['question_id'];
                    $feed_back->answer_id = $fb['answer_id'];
                    $feed_back->place_id = $fb['place_id'];
                    $feed_back->save();
                }

                $rating = new Rating();
                $rating->place_id = $place_id;
                $rating->score = $request->star;
                $rating->comments = $request->comment;
                $rating->save();


                DB::commit();
                        
                $data = array(
                    'status' => true,
                    'message' => 'Terimakasih atas penilaian anda.'
                );
                return response()->json($data, 200);

            } catch (\Exception $e) {
                return $e;
                DB::rollback();
                $data = array(
                    'status' => false,
                    'message' => 'Gagal dalam penginputan data',
                    'data' => array('error_message'=>$e->errorInfo[2])
                );
                return response()->json($data, 500);
            }
        }else{
            return response()->json($check, 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }

    public function export() 
    {
        return Excel::download(new Report, 'report.xlsx');
    }

    public function test()
    {
        $questions = Question::where('is_active', true)->with('answer')->orderBy('sort', 'asc')->get();
        foreach ($questions as $x) {
            foreach ($x->answer as $y) {
                $data[$x->question][$y->answer] = Feedback::select(DB::raw('count(answer_id) as count'))->where('place_id', '1')->where('answer_id', $y->id)->first();   
            }
        }
        return $data;
    }

}
