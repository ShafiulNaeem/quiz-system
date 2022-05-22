<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionBody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['value'] = Question::with('createdByName','exam');

        if ($request->has('search')){
            $sort_search = $request->search;
            $data['value'] = $data['value']->where('title', 'like', '%'.$sort_search.'%');
        }
        $data['value'] = $data['value']->orderBy('id','DESC')->paginate(15);

        return view('question.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['exam'] = Exam::where('status','Active')->get();
        return view('question.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam_id' => 'required',
            'title' => 'required',
            'ans' => 'required',
            'marks' => 'required',
            'serial' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('question.create')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['status'] = 'Active';

        $options = [];

        if ($request->type == 1){
            $data['type'] = "Multiple Choice";
            $options = $data['options'];
        }else{
            $data['type'] = "Written";
        }

        unset($data['options']);
        $question = Question::create($data);

        // add option
        $question_body = [];
        if ($request->type == 1){
            foreach($options as $key=> $option){
                $question_body[$key]['exam_id'] = $data['exam_id'];
                $question_body[$key]['question_id'] = $question->id;
                $question_body[$key]['input_type'] = "radio";
                $question_body[$key]['level'] = $option;
                $question_body[$key]['input_name'] = $option;
                $question_body[$key]['created_by'] = $data['created_by'];
            }
        }else{
            $key = 0;
            $question_body[$key]['exam_id'] = $data['exam_id'];
            $question_body[$key]['question_id'] = $question->id;
            $question_body[$key]['input_type'] = "textarea";
            $question_body[$key]['created_by'] = $data['created_by'];
        }

        QuestionBody::insert($question_body);

        toastr()->success('Data insert successfully');
        return redirect()->route('question.index');

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
    public function edit($id)
    {
        $data['exam'] = Exam::where('status','Active')->get();
        $data['value'] = Question::with('questionBodies')->where('id',$id)->first();
        return view('question.edit',compact('data'));
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
        $validator = Validator::make($request->all(), [
            'exam_id' => 'required',
            'title' => 'required',
            'ans' => 'required',
            'marks' => 'required',
            'serial' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $options = [];

        if ($request->type == 1){
            $data['type'] = "Multiple Choice";
            $options = $data['options'];
        }else{
            $data['type'] = "Written";
        }

        unset($data['options']);
        unset($data['_token']);
        unset($data['_method']);

        $question = Question::where('id',$id)->update($data);
        QuestionBody::where('question_id',$id)->delete();

        // add option
        $question_body = [];
        if ($request->type == 1){
            foreach($options as $key=> $option){
                $question_body[$key]['exam_id'] = $data['exam_id'];
                $question_body[$key]['question_id'] = $id;
                $question_body[$key]['input_type'] = "radio";
                $question_body[$key]['level'] = $option;
                $question_body[$key]['input_name'] = $option;
                $question_body[$key]['created_by'] = Auth::id();
            }
        }else{
            $key = 0;
            $question_body[$key]['exam_id'] = $data['exam_id'];
            $question_body[$key]['question_id'] = $id;
            $question_body[$key]['input_type'] = "textarea";
            $question_body[$key]['created_by'] = Auth::id();
        }

        QuestionBody::insert($question_body);

        toastr()->success('Data Updated successfully');
        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    public function question_delete(Request $request){
        $data = Question::find($request->id);
        if ($data){
            QuestionBody::where('question_id',$request->id)->delete();
            $data->delete();
            return 1;
        }
        return 0;
    }

    public function update_status(Request $request) {
        $data = Question::findOrFail($request->id);
        $data->status = $request->status;
        if ($data->save()) {
            return 1;
        }
        return 0;
    }
}
