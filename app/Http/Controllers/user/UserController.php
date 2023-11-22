<?php

namespace App\Http\Controllers\user;
use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Carts;
use App\Models\Order;
use App\Mail\TestMail;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use App\Models\Feedbacks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $history = Order::where('user_id',Auth::user()->id)->get();
        $products = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Carts::where('user_id',Auth::user()->id)->get();
        // $groupedProducts = Product::select('products.*','categories.name as category_name')
        // ->leftJoin('categories','products.category_id','categories.id')
        // ->groupBy('category_name')
        // ->orderBy('created_at','desc')
        // ->get();
        $trending = Product::orderBy('view_count','desc')->limit(10)->get();

        return view('user.main.home',compact('products','categories','cart','history','trending'));
    }

    //cart page
    public function cartList(){
        $cartList = Carts::select('carts.*','products.name as product_name','products.image as product_image','products.price as product_price')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('user_id',Auth::user()->id)
        ->get();
        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->product_price*$c->qty;
        }
        return view('user.cart.cart',compact('cartList','totalPrice'));
    }

    //password change page
    public function pwChange(){
        return view('user.password.change');
    }

    //password change function
        public function changePassword(Request $request){
            $this->passwordValidationCheck($request);
            $currentUserId = Auth::user()->id;

            $user = User::select('password')->where('id',$currentUserId)->first();
            $dbPassword = $user->password;

            if(Hash::check($request->oldPassword,$dbPassword)){
                $data = [
                    'password'=> Hash::make($request->newPassword)
                ];
                User::where('id',Auth::user()->id)->update($data);

                // Auth::logoutOtherDevices($data);

                // return redirect()->route('auth#loginPage');
                return back()->with(['matched'=>'The password has changed']);
            }
            return back()->with(['notMatched'=>'The old password is not correct!']);
        }
    //edit account
    public function info(){
        return view('user.profile.account');
    }
    //update account
    public function update($id,Request $request){
        $this->updateprofileValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage=$dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('user#home')->with(['updateSuccess'=>'Profile Updated']);
    }

    //category
    public function filter($categoryId){
        $history = Order::where('user_id',Auth::user()->id)->get();
        $products = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Carts::where('user_id',Auth::user()->id)->get();
        $trending = Product::orderBy('view_count','desc')->limit(10)->get();
        return view('user.main.home',compact('products','categories','cart','history','trending'));
    }

    //detail
    public function details($productId){
        $products = Product::where('id',$productId)->first();
        $feedback =  Feedbacks::orderBy('created_at','desc')->get();
        $productLists = Product::get();
        $cart = Carts::where('user_id',Auth::user()->id)->get();
        return view('user.main.details',compact('products','productLists','feedback','cart'));
    }
    //comment
    public function feedbacks(Request $request){
        $this->feedbackValidation($request);
        $data = $this->getFeedback($request);
        Feedbacks::create($data);
        return back();
    }
    //comment page
    public function write($productId){
        $comments = Feedbacks::orderBy('created_at','desc')->paginate(4);
        $list = Product::where('id',$productId)->first();
        $users = User::where('name')->first();
        return view('user.main.comment',compact('comments','list','users'));
    }
    //view count
    public function viewCount(Request $request){

        Product::where('id')->create($data);
    }

    //history
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.cart.history',compact('order'));
    }
    public function invoice($code){
        $order = Order::where('order_code',$code)->first();
        $each_order = OrderList::select('order_lists.*','products.image as p_image','products.price as p_price')
        ->leftJoin('products','products.id','order_lists.product_id')->where('order_code',$code)->get();
        return view('mail.testmail',compact('order','each_order'));
    }
    // send email
    public function sendMail($order){
       try{
        $mailOrder = Order::where('order_code',$order)->first();
        Mail::to(Auth::user()->email)->send(new TestMail($mailOrder));
        // dd(Auth::user()->email);
        return back()->with(['success'=> 'Invoice has been sent!']);

       }catch(\Exception $e){
         return back()->with(['fail'=> 'Something went wrong!']);
       }
    }
    //password validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:8',
            'newPassword'=>'required|min:8',
            'confirmPassword'=>'required|min:8|same:newPassword'
        ],[

        ])->validate();
    }
    private function updateprofileValidationCheck($request){
        Validator::make($request->all(),[
            'image'=>'mimes:jpg,bmp,png,jpeg,webp',
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',

        ])->validate();
    }

    private function feedbackValidation($request){
        Validator::make($request->all(),[
            'feedback'=>'required',
        ])->validate();
    }
    private function getFeedback($request){
        return [
            'feedback'=>$request->feedback,
            'product'=>$request->product,
            'user_name'=> $request->currentName
        ];
    }

    private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'updated_at'=>Carbon::now()
        ];
    }
}
