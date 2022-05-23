<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\AnswerSheet;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Exam;
use App\Models\MealSetter;
use App\Models\Order;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $data['page'] = 'dashboard';
        $data['page_title'] = 'Quiz';

        $data['value'] = Exam::with(['questions' => function($query) {
                $query->where('status','Active');
            }])->where('status','Active')->get();

        return view('dashboard', compact('data'));
    }

    public function question($id){
        $data['page'] = 'exam_question';
        $data['page_title'] = 'Exam Question';

        $data['participation_number'] = AnswerSheet::max('participation_number');


        if ($data['participation_number'] == null){
            $data['participation_number'] = 1;
        }else{
            $data['participation_number'] = $data['participation_number']+1;
        }

        $data['exam'] = Exam::where('id',$id)->first();
        $data['question'] = Question::with('exam','questionBodies')
            ->where('exam_id',$id)
            ->where('status','Active')
            ->get();

        return view('exam_question', compact('data'));
    }

    public function question_ans(Request $request) {
        $answer = $request->all();
        unset($answer['_token']);
        $answer['user_id'] = Auth::id();
        $data = AnswerSheet::create($answer);
        if ($data) {
            return 1;
        }
        return 0;
    }

    public function result($participation_number){
        $data['page'] = 'result';
        $data['page_title'] = 'Result';

        $data['value'] = AnswerSheet::join('questions','questions.id' ,'=', 'answer_sheets.question_id')
            ->leftJoin('exams','exams.id' ,'=', 'answer_sheets.exam_id')
            ->where([
                'answer_sheets.participation_number'=> $participation_number,
                'answer_sheets.user_id'=> Auth::id(),
            ])
            ->select(
                'answer_sheets.id',
                'exams.title as exam_title',
                'exams.exam_time',
                'exams.time_specification',
                'questions.title as question_title',
                'questions.marks',
                'questions.type',
                'questions.ans as question_ans',
                'answer_sheets.ans as get_ans'
            )->get();

        $total_point = 0;
        $total_marks = 0;
        $total_correct_ans = 0;
        $total_incorrect_ans = 0;
        $exam_name = '';
        $exam_time = '';

        foreach ($data['value'] as $key => $datum){
            $exam_name = $datum->exam_title;
            $exam_time = $datum->exam_time.' '.$datum->time_specification;
            $total_point = $total_point + $datum->marks;

            if ($datum->question_ans == $datum->get_ans){
                $total_marks = $total_marks + $datum->marks;
                $total_correct_ans = $total_correct_ans + 1;
            }else{
                $total_incorrect_ans = $total_incorrect_ans + 1;
            }
        }

        $data['result'] = [
            "total_point" => $total_point,
            "total_marks" => $total_marks,
            "total_correct_ans" => $total_correct_ans,
            "total_incorrect_ans" => $total_incorrect_ans,
            "exam_name" => $exam_name,
            "exam_time" => $exam_time,
            ];


        return view('result', compact('data'));
    }


    public function home()
    {
        return view('home');
    }

}
