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
        $data['page_title'] = 'Dashboard';
        return view('dashboard',compact('data'));
    }

    public function total_order_chart(){
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $year = Carbon::now();
        $year = $year->year;

        $order = Order::whereYear('order_date', $year);
        $order = Helpers::isAdmin($order,$column = 'user_id');

        $order = $order->select(
            DB::raw("(COUNT(id)) as total_order"),
            DB::raw("(MONTH(order_date)) as month"))

            ->orderBy('order_date')

            ->groupBy(DB::raw("MONTH(order_date)"))

            ->get()->toArray();


        $month = [];
        $total_order = [];
        foreach ($order as $key=> $item){
            $dateObj   = \DateTime::createFromFormat('!m', $item['month']);
            $month[] = $dateObj->format('F');
            $total_order[] = $item['total_order'];

        }

        $data['year'] = $year;
        $data['month'] = $month;
        $data['total_order'] = $total_order;

        return $data;
    }


    public function total_order_value_chart(){
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $year = Carbon::now();
        $year = $year->year;

        $order = Order::whereYear('order_date', $year);
        $order = Helpers::isAdmin($order,$column = 'user_id');

        $order = $order->where('status','!=','Canceled')
            ->select(
                DB::raw("(SUM(total)) as total_value"),
                DB::raw("(MONTH(order_date)) as month"))

            ->orderBy('order_date')

            ->groupBy(DB::raw("MONTH(order_date)"))

            ->get()->toArray();


        $month = [];
        $total_order = [];
        foreach ($order as $key=> $item){
            $dateObj   = \DateTime::createFromFormat('!m', $item['month']);
            $month[] = $dateObj->format('F');
            $total_order[] = $item['total_value'];

        }

        $data['year'] = $year;
        $data['month'] = $month;
        $data['total_value'] = $total_order;

        return $data;
    }

    public function week_chart(){
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $start = Carbon::now()->startOfWeek();
        $start = $start->toDateString();
        $end = Carbon::now()->endOfWeek();
        $end = $end->toDateString();

        $order = Order::whereDate('order_date','>=',$start)
            ->whereDate('order_date','<=',$end)
            ->where('status','!=','Canceled');

        $order = Helpers::isAdmin($order,$column = 'user_id');

        $order = $order->select(
            DB::raw('DATE(order_date) as date'),
            DB::raw("(SUM(total)) as total_value"))
            ->orderBy('order_date','asc')
            ->groupBy(DB::raw("DATE(order_date)"))
            ->get()->toArray();

        $day = [];
        $total_order = [];
        foreach ($order as $key=> $item){
            $day[] = Carbon::parse($item['date'])->format('l');
            $total_order[] = $item['total_value'];

        }

        $data['start'] = $start;
        $data['end'] = $end;
        $data['day'] = $day;
        $data['total_value'] = $total_order;

        return $data;

    }


    public function home(){
        return view('home');
    }

    public function profile(){
        $data['page'] = 'profile';
        $data['page_title'] = 'Profile';
        $data['value'] = User::with('designation','department','role')
            ->where('id',Auth::user()->id)->first();

        $departments = Department::all();
        $parent_ids = [];
        $result = [];
        foreach ($departments as $key=>$department){
            if ($department->parent_id == 0){
                $parent_ids[$key] = $department->id;
            }
        }
        foreach ($parent_ids as $key=> $parent_id){
            foreach ($departments as $key=>$department){
                if ($parent_id == $department->parent_id or $parent_id == $department->id){
                    $result[$parent_id][$key] = $department;
                }
            }
        }

        $data['department'] = $result;
        $data['designation'] = Designation::orderBy('name','ASC')->get();

        return view('profile',compact('data'));
    }

    public function profile_update(Request $request){

        $data = $request->all();
        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'email' => ['required',Rule::unique('users')->ignore($user->id)],
        ]);

        if ($validator->fails()) {
            toastr()->error('This email already exist!.please enter another email.');
            return redirect()->back();
        }

        if ($user){
            $data['image'] = $user->image ?? '';
            if ($files = $request->file('image')) {
                File::delete($user->image);

                $path = 'uploads/image/user/';
                $fileName = $files->getClientOriginalName();
                $fileName = Str::random(6) . time() . Str::random(4).$fileName;
                $dbName = $path . '' . $fileName;
                $files->move($path, $fileName);
                $data['image'] = $dbName;
            }

            $user->update($data);
            toastr()->success('Profile updated successfully.');
            return redirect()->route('profile');
        }

        toastr()->success('Something went to wrong.');
        return redirect()->route('profile');
    }

    public function email_update(Request $request){
        $data = $request->all();
        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'email' => ['required',Rule::unique('users')->ignore($user->id)],
        ]);

        if ($validator->fails()) {
            toastr()->error('This email already exist!.please enter another email.');
            return redirect()->back();
        }

        if ($user){
            $data['password'] = $request->password?? '';

            if (Hash::check($data['password'], $user->password)) {
                $user->update([
                    'email'=>$request->email
                ]);
                toastr()->success('Email updated successfully.');
            }
            else{
                toastr()->warning('Please enter correct password.');
            }
            return redirect()->route('profile');
        }

        toastr()->error('Something went to wrong.');
        return redirect()->route('profile');
    }

    public function reset_password(Request $request){
        $data = $request->all();
        $user = User::find(Auth::user()->id);

        if ($user){
            $data['password'] = $request->current_password?? '';

            if ( Hash::check($data['password'], $user->password)) {
                $user->update([
                    'password'=>Hash::make($request->new_password)
                ]);
                toastr()->success('Password updated successfully.');
            }
            else{
                toastr()->warning('Please enter correct password.');
            }
            return redirect()->route('profile');
        }

        toastr()->error('Something went to wrong.');
        return redirect()->route('profile');
    }

    public function cron_order_meal_update(){

        $date = Carbon::now();
        $today = $date->toDateString();
        $tomorrow = Carbon::tomorrow();
        $tomorrow = $tomorrow->toDateString();
        $tomorrowDay = Carbon::tomorrow()->format('l');

//        Log::debug('An informational message = '.$date);

        $data = MealSetter::with('mealDays.day')
            ->leftJoin('meal_set_times','meal_setters.id' ,'=', 'meal_set_times.meal_setter_id')
            ->select(
                'meal_setters.id',
                'meal_setters.main_stock',
                'meal_setters.default_stock',
                'meal_set_times.id as meal_set_time_id',
                'meal_set_times.meal_setter_id as meal_setter_id',
                'meal_set_times.meal_start_date as meal_start_date',
                'meal_set_times.meal_end_date as meal_end_date'
            );

        $data = $data->whereDate('meal_set_times.meal_end_date' ,'>=',$tomorrow);
        $data = $data->whereDate('meal_set_times.meal_start_date' ,'<=',$tomorrow)->get();

//        $data = $data->whereHas('mealDays.day', function($q) use ($tomorrowDay){
//            $q->where('name',$tomorrowDay);
//        })->get();

        foreach ($data as $key=> $datum){
            MealSetter::find($datum->id)->update([
                'main_stock' => $datum->default_stock
            ]);
        }

        // order status delivered
        $order = Order::whereDate('order_delivery_date',$today)
            ->where('status','Accepted')
            ->update(['status'=> 'Delivered']);

        return 'ok';

    }

    public function new(){
        return view('new_invoice');
    }
}
