<?php

namespace App\Http\Controllers\user;
use Storage;
use Carbon\Carbon;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //product sorting
    // public function pizzaList(Request $request){
    //     if($request->status == 'desc'){
    //         $data = Product::orderBy('created_at','desc')->get();
    //     }else{
    //         $data = Product::orderBy('created_at','asc')->get();
    //     }
    //     return $data;
    // }

    //adding to cart
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Carts::create($data);
        $response = [
            'message'=> 'Added to Cart',
            'status'=>'success'
        ];
        return response()->json($response,200);
    }
    public function viewC(Request $request){
        Product::where('id',$request->productId)->increment('view_count',1);

    }
    //ordering
    public function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
           $data =  OrderList::create([
            'user_id' =>$item['user_id'],
            'product_id' =>$item['product_id'],
            'qty' =>$item['qty'],
            'total' =>$item['total'],
            'order_code' =>$item['order_code']
        ]);

        $total += $data->total;
        }
        Carts::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=> $data->order_code,
            'total_price'=> $total
        ]);
        return response()->json(['status'=>'true',
        'message'=>'Order Success'],200);
    }
    //clear all in cart
    public function clearCart(){
        Carts::where('user_id',Auth::user()->id)->delete();
    }
    public function removeItem(Request $request){
        Carts::where('user_id',Auth::user()->id)
        ->where('product_id',$request->productId)
        ->where('id',$request->pId)
        ->delete();
    }
    public function orderDetail($code){
        $each_order = OrderList::select('order_lists.*','products.image as p_image','products.price as p_price')
        ->leftJoin('products','products.id','order_lists.product_id')->where('order_code',$code)->get();
        $order  = Order::where('order_code',$code)->get();
        $orderCode = Order::where('order_code',$code)->first();
        $user = OrderList::select('order_lists.*','users.name as user_name')
        ->leftJoin('users','users.id','order_lists.user_id')->where('order_code',$code)->first();
       return view('user.order.orders',compact('each_order','user','order','orderCode'));
    }
    //clear each in
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id'=>$request->productId,
            'qty'=>$request->count,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }
}
