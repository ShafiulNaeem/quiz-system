<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Department;
use App\Models\Designation;
use App\Models\MealSetter;
use App\Models\Order;
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
        return view('dashboard', compact('data'));
    }


    public function home()
    {
        return view('home');
    }

}
