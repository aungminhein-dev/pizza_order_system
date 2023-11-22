<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Order;
use App\Models\confirmed;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Models\ConfirmedOrders;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function order(){
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->when(request('key'),function($query){
            $query->where('order_code','like','%'.request('key').'%');
        })
        ->paginate(8);
        return view ('admin.order.order',compact('order'));
    }
    public function pending(){
        $pendings = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->where('status',0)->paginate(8);
        return view('admin.order.pendings',compact('pendings'));
    }
    public function statusSort(Request $request){
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc');

        if($request->status == null){
            $order = $order->paginate(8);
        }else{
            $order = $order->where('orders.status',$request->status)->paginate(8);
        }
      return view ('admin.order.order',compact('order'));
    }
    public function updateStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status'=>$request->newStatus
        ]);
    }
    public function orderDetail($code){
        $each_order = OrderList::select('order_lists.*','products.image as p_image','products.price as p_price')
        ->leftJoin('products','products.id','order_lists.product_id')->where('order_code',$code)->get();
        $user = OrderList::select('order_lists.*','users.name as user_name')
        ->leftJoin('users','users.id','order_lists.user_id')->where('order_code',$code)->first();
        $orderCode = Order::where('order_code',$code)->first();

        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->where('order_code',$code)
        ->first();

        return view('admin.order.order-detail',compact('each_order','user','order','orderCode','order'));
    }
    public function accept(Request $request){
        $confirmed = $this->confirm($request);
        confirmed::create($confirmed);

        $dt = $this->statusAccept($request);
        Order::where('id',$request->id)->update($dt);
        return back()->with(['ok'=> 'Accepted']);
    }

    public function deny($id,Request $request){
        $dt = $this->statusDeny($request);
        Order::where('id',$id)->update($dt);
        return back()->with(['notOk'=> 'Denied']);
    }



    private function confirm($request){
        return [
            'total_price'=>$request->totalPrice,
            'order_code' => $request->orderCode,
            'user_name' => $request->userName
        ];
    }
    private function statusDeny($request){
        return [
           'status'=>$request-> statusDeny
        ];
    }
    private function statusAccept($request){
        return [
           'status'=>$request-> statusAccept
        ];
    }

}
