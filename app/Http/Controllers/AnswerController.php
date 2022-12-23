<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Utils\SystemSettings;

class AnswerController extends Controller
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
    public function index($question_id)
    {
        $data['question'] = Question::find($question_id);
        $data['answer'] = Answer::where('question_id', $question_id)->latest()->paginate(5);
        $data['page'] = array(
            'title'=>'Jawaban dari pertanyaan '.$data['question']->question,
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.answer', $data);
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
            'answer' => 'required',
            'question_id' => 'required'
        ]);
        $save = new Answer();
        $save->answer = $request->answer;
        $save->question_id = $request->question_id;
        $save->save();

        return redirect('admin/answer/'.$request->question_id)->with('success', 'Jawaban Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required',
            'question_id' => 'required'
        ]);
        $update = Answer::find($id)->update($request->all()); 
        return redirect('admin/answer/'.$request->question_id)->with('success', 'Perubahan Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
