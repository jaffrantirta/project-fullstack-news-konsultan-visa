<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Utils\SystemSettings;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        $data['question'] = Question::where('is_active', true)->orderBy('sort', 'DESC')->paginate(5);
        $data['page'] = array(
            'title'=>'Pertanyaan',
            'system' => SystemSettings::getAll(),
            'socmed'=>SystemSettings::social_media()
        );
        return view('administrator.question', $data);
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
            'question' => 'required',
            'sort' => 'required'
        ]);
        $save = new Question();
        $save->question = $request->question;
        $save->sort = $request->sort;
        $save->is_active = 1;
        $save->save();

        return redirect('admin/question')->with('success', 'Pertanyaan Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'sort' => 'required'
        ]);
        $update = Question::find($id)->update($request->all()); 
        return redirect('admin/question')->with('success', 'Perubahan Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $update = Question::find($id)->update(array(
            'is_active' => false
        )); 
        return redirect('admin/question')->with('success', 'Pertanyaan Berhasil Dihapus.');
    }
}
