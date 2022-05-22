<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
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

    public function question($title,$id){
        $data['page'] = 'exam_question';
        $data['page_title'] = 'Exam Question';
        $data['exam'] = Exam::where('id',$id)->first();
        $data['question'] = Question::with('exam','questionBodies')
            ->where('exam_id',$id)
            ->where('status','Active')
            ->get();

        return view('exam_question', compact('data'));
    }


    public function home()
    {
        return view('home');
    }

}
