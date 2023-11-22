<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\confirmed;
use App\Models\OrderList;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function funPage(Request $request){

        $category = Category::count();
        $orderPending = Order::where('status',0)->get();
        $user = User::where('role','user')->count();
        $product = Product::count();
        $order = Order::get();

        $orderD = confirmed::get();
        $totalValue = 0;
        foreach ($orderD as $o){
            $totalValue += ($o->total_price);
        }

        $products = Product::select(
            DB::raw('categories.name as category_name'),
            DB::raw("COUNT(*) as count"),
        )
        ->leftJoin('categories','products.category_id','categories.id')
        ->groupBy('category_name')
        ->get();
        $catg = [];
        $pd = [];
        foreach($products as $p){
            $catg[] = $p['category_name'];
            $pd[] = $p['count'];
        }
        // $chartData = confirmed::select('total_price','created_at')->orderBy('created_at','asc')->get()->groupBy(function($chartData){
        //     return Carbon::parse($chartData->created_at)->format('M');
        // });
        // // dd($chartData->toArray());

        // $months = [];
        // $monthCount = [];
        // foreach($chartData as $month => $values){
        //    $months[] =  $month;
        //    $monthCount[] = count($values);
        // }
       $u = User::select(
        DB::raw("COUNT(*) as count"),
        DB::raw( "MONTHNAME(created_at) as monthName"),

        )
        ->where('role','user')
       ->whereYear("created_at",date('Y'))
       ->groupBy('monthName')
       ->orderBy('created_at','asc')

       ->get();
       $users= [];
       $monthsU = [];
       foreach($u as $b){
        $users[] = $b->count;
        $monthsU[] = $b->monthName;
       }

        $years = confirmed::select(
            DB::raw( "YEAR(created_at) as year"),
        )
        ->orderBy('created_at')
        ->groupBy('year')->get();

        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $test = confirmed::select(
            DB::raw("sum(total_price) as total"),
            DB::raw('DATE(created_at) as date')
        )
        ->groupBy('date')
        ->orderBy('created_at')
        ->get();
        $x_data = [];
        $y_data = [];
        foreach ($test as $te){
            $y_data[] = $te->total;
            $x_data[] = $te->date ;
        }

        return view('admin.category.fun-stuff',['months'=>$months,'x_data'=>$x_data,'y_data'=>$y_data,'','users'=>$users,'monthsU'=>$monthsU,'catg'=>$catg,'pd'=>$pd],compact('category','user','order','orderPending','product','totalValue','years'));
    }

    public function take(Request $request){
        $test = confirmed::select(
            DB::raw("sum(total_price) as total"),
            DB::raw( "MONTHNAME(created_at) as month_name"),
            DB::raw('YEAR(created_at) as yearName'),
            DB::raw('DATE(created_at) as date')
        )
        ->orderBy('created_at');
        $x_data = [];
        $y_data = [];
       if($request->periodic == 'month'){

        $test =$test->groupBy('month_name')->get();
        foreach ($test as $te){
            $y_data[] = $te->total;
            $x_data[] = $te->month_name ;
        }
       }elseif($request->periodic == 'day' ){

        $test = $test->groupBy('date')->get();
        foreach ($test as $te){
            $y_data[] = $te->total;
            $x_data[] = $te->date ;
        }
       }elseif($request->periodic == 'year'){

        $test = $test->groupBy('yearName')->get();
        foreach ($test as $te){
            $y_data[] = $te->total;
            $x_data[] = $te->yearName ;
        }
       }else{
        $test = $test->groupBy('date')->get();
        foreach ($test as $te){
            $y_data[] = $te->total;
            $x_data[] = $te->date ;
        }
       }
       return response()->json([
        'test' => $test,
        'x_data'=>$x_data,
        'y_data'=>$y_data
       ]);
    }
}
