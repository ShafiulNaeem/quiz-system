<?php

namespace App\Helpers;

use App\Models\ConfigMealSite;
use App\Models\Department;
use App\Models\Designation;
//use App\Models\FoodMenu;
use App\Models\FoodMenu;
use App\Models\MealSetter;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PaidOrder;
use App\Models\Payment;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\Table;

class Helpers
{
    public function getSeenNotification(){
        $data = DB::table('notifications')->where('notifiable_id',Auth::id());
        $data = $data->orderBy('created_at','DESC')
            ->limit(10)
            ->get();

        $count = 0;
        foreach ($data as $datum){
            if ($datum->read_at == null){
                $count++;
            }
        }

        return $count;
    }

    public function getNotification(){
        $data = DB::table('notifications')->where('notifiable_id',Auth::id());
        $data = $data->orderBy('created_at','DESC')
            ->limit(10)->get();

        return $data;
    }

    public function getTomorrowTodayDelOrder($day){
        $order = Order::whereDate('order_delivery_date',$day)->where('status','!=','Canceled');
        $order = self::isAdmin($order,$column = 'user_id');
        $order = $order->count();

        return $order;

    }

    public function getThisMonthOrderValue($firstDate,$lastDate){
        $order = Order::whereDate('order_date' ,'>=',$firstDate)
            ->whereDate('order_date' ,'<=',$lastDate)
            ->where('status','!=','Canceled');
        $order = self::isAdmin($order,$column = 'user_id');
        $order = $order->sum('total');

        return $order;

    }

    public function getOrderLastTime(){
        $data = ConfigMealSite::where('key','Next day order last time')->select('value')->first();
        return $data->value;
    }

    public function checkPaidOrders($user_id,$date){
        $paidOrder = PaidOrder::where('user_id',$user_id)->pluck('order_id');

        $order = Order::where('user_id',$user_id)->where('status','!=','Canceled');
        if ($date != ''){
            $date_range = explode('-',$date);

            $from =$date_range[0];
            $to =$date_range[1];
            $from = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $from)));
            $to = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $to)));

            $order = $order->whereDate('order_date' ,'>=',$from)
                ->whereDate('order_date' ,'<=',$to);
        }
        $order = $order->pluck('id');

        $paidOrder = $paidOrder->toArray();
        $order = $order->toArray();

        $result = array_diff($order,$paidOrder);

        if ($paidOrder != [] && $result == []){
            $value = 'paid';
            return 1;

        }else{
            $value = 0;
            if ($paidOrder != []){
                $value = Order::where('status','!=','Canceled')->whereIn('id',$paidOrder)->sum('total');
            }
            return $value;
        }
    }

    public function totalOrderValue($user_id){

        $data = Order::where([
            'user_id' => $user_id,
        ])->where('status','!=','Canceled')->sum('total');

        return $data;
    }

    public function getRandomUser($user_id){
        $data = User::with('designation')->where('id',$user_id)->first();
        return $data;
    }

    public function paymentCheck($user_id){
        $data = Payment::where('user_id',$user_id)->sum('amount');
        return $data;
    }

    public function getFutureActInActMeal($status){
        $tomorrow = Carbon::tomorrow();
        $tomorrow = $tomorrow->toDateString();
        $date = Carbon::now();
        $today = $date->toDateString();

        $data = MealSetter::leftJoin('meal_set_times','meal_setters.id' ,'=', 'meal_set_times.meal_setter_id')
            ->whereDate('meal_set_times.meal_start_date' ,'>=',$today)
            ->orWhereDate('meal_set_times.meal_end_date' ,'>=',$today)->get()->toArray();
        $key = array_search($status, array_column($data, 'status'));
        if (is_bool($key)){
            return 0;
        }else{
            $statusCount =  array_count_values(array_column($data, 'status'))[$status];
            return $statusCount;
        }

    }

    public function futureMeal($request){

        $date = Carbon::now();
        $today = $date->toDateString();
        $tomorrow = Carbon::tomorrow();
        $tomorrow = $tomorrow->toDateString();

        $data = MealSetter::with('mealDays.day')
            ->leftJoin('meal_set_times','meal_setters.id' ,'=', 'meal_set_times.meal_setter_id')
            ->leftJoin('food_menus','meal_setters.food_menu_id' ,'=', 'food_menus.id')
            ->select(
                'meal_setters.id',
                'meal_setters.food_menu_id',
                'meal_setters.unit_price',
                'meal_setters.cost_price',
                'meal_setters.stock',
                'meal_setters.delivery_start_time',
                'meal_setters.delivery_end_time',
                'meal_setters.status',
                'meal_setters.main_stock',
                'meal_setters.default_stock',
                'food_menus.title as food_title',
                'food_menus.image as food_image',
                'meal_set_times.id as meal_set_time_id',
                'meal_set_times.meal_setter_id as meal_setter_id',
                'meal_set_times.meal_start_date as meal_start_date',
                'meal_set_times.meal_end_date as meal_end_date',
            );

        if (isset($request->search) or isset($request->date)){
            $data = self::searchMeal($data,$request);
//            $data = $data->whereDate('meal_set_times.meal_start_date' ,'>=',$today);
            $data = $data->whereDate('meal_set_times.meal_end_date' ,'>=',$today);
        }
        else{
            $data = $data->whereDate('meal_set_times.meal_start_date' ,'>=',$today)
                ->orWhereDate('meal_set_times.meal_end_date' ,'>=',$today);
        }

        $data = $data->orderByRaw("IF(meal_set_times.meal_start_date = '{$tomorrow}',2,IF(meal_set_times.meal_start_date LIKE '{$tomorrow}%',1,0)) DESC");
        $data = $data->orderBy('meal_set_times.meal_start_date','DESC');
        return $data;

    }


    public function searchMeal($data,$request){
        if ($request->has('search')){
            $sort_search = $request->search;
            $data = $data->where('food_menus.title', 'like', '%'.$sort_search.'%');
        }

        if ($request->has('date')){
            $date_range = $request->date;
            $date_range = explode('-',$date_range);

            $from =$date_range[0];
            $to =$date_range[1];
            $from = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $from)));
            $to = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $to)));

            $data = $data->whereDate('meal_set_times.meal_end_date' ,'>=',$from)
                ->whereDate('meal_set_times.meal_end_date' ,'<=',$to);

        }

        return $data;

    }

    public function StatusOrderValue($user_id,$status){

        $data = Order::where([
            'user_id' => $user_id,
            'payment_status' => $status,
        ])->where('status','!=','Canceled')->sum('total');

        return $data;
    }

    public function isAdmin($data,$column){
        if (self::getRole()  != 'admin'){
            $data = $data->where($column,Auth::user()->id);
        }

        return $data;
    }

    public function getOrderDiscount(){
        $data = ConfigMealSite::where('key','order_discount')->first();
        return $data->value ?? 0;
    }

    public function getOrderTax(){
        $data = ConfigMealSite::where('key','order_tax')->first();
        return $data->value ?? 0;
    }

    public function getUsers(){
        $data = User::with('designation','department','role')
            ->whereHas('role', function($q){
                $q->where('name','!=','test');
            });
        $data = $data->where('status','Active')->get();
        return $data;
    }

    public function getRole(){
        $data = User::with('role')->where('id',Auth::user()->id)->first();
        return $data->role->name;
    }

    public function getParentDepartment($parent_id){
        $data = Department::where('id',$parent_id)->first();
        return $data->name;
    }

    public function getLoggedUserData(){
        $data = User::where('id',Auth::user()->id)->first();
        return $data;
    }

    public function getAdminRoleId(){
        $role = Role::where('name','admin')->first();
        $role_id = $role->id;
        return $role_id;
    }
    public function getRoleOrDeg($model,$search){
        $model = '\App\Models'.$model;
        $data = $model::orderBy('name','asc');
        if ($search !=''){
            $data = $data->where('name', 'like', '%'.$search.'%');
        }
        return $data;
    }

    public function getSettings($model,$search){
        $model = '\App\Models'.$model;
        $data = $model::orderBy('id','DESC');
        if ($search !=''){
            $data = $data->where('key', 'like', '%'.$search.'%');
        }
        return $data;
    }

    public function getDesignation($department_id){
        $designation = Designation::where('department_id',$department_id)->get()->toArray();
        return $designation;
    }
    public function countfood($status){
        $count = \App\Models\FoodMenu::where('status',$status)->count();
        return $count;
    }

    public function getActiveInActive($model,$status){
        $model = '\App\Models'.$model;
        $count = $model::where('status',$status)->count();
        return $count;
    }

    public static function imagePath()
    {
        return (env('APP_ENV') == 'live') ? 'uploads/foodmenu' : 'uploads/foodmenu';
    }

    public static function imageResizePath()
    {
        $imagePath = self::imagePath();
        return [
            'main_thumb' => $imagePath . '/',
            'details_thumb' => $imagePath . '/' . 'details_thumb/'
        ];
    }

    public static function imageResizeSize()
    {
        return [
            'main_thumb' => ['height' => '333', 'width' => '500'],
            'details_thumb' => ['height' => '666', 'width' => '1000']
        ];
    }


    public static function getAllFoodByOrderId($id){
        $data = Order::where('user_id',$id)->where('status', 'Accepted')->get()->pluck('id');
        $data = OrderDetails::whereIn('order_id',$data)->get()->groupBy('food_menu_id');

        $totalOrder = $data->count();

        $names = [];
        foreach ($data as $food){
            $total = $food->sum('quantity');
            $food_id = $food->first()->food_menu_id;

            $foodName = FoodMenu::where('id',$food_id)->first();

            $names[] = ($foodName->title ?? ' ') . ' O.Qty ( ' . $total . ' )';
        }

        return [implode(', ',$names), $totalOrder];
    }


    public static function userDesignations($user_id){
        $data = User::with('designation')->where('id',$user_id)->first();
        return $data->designation->name;
    }
}
