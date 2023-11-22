<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function homePage(){
        return view('origin');
    }
    public function notipage(){
        $order= Order::where('status',0)->get();

        return response()->json([
            'order'=>$order
        ]);
    }
    //direct log in\\
    public function loginPage(){
        // $this->loginValidationCheck($request);
        return view('login');
    }
    public function registerPage(){
        return view('register');
    }
    //dashboard
    public function dashboard(){
        if(Auth::user()->role == 'admin'){

            return redirect()->route('admin#dashboard');
        }else{
            return redirect()->route('user#home');
        }

    }

    //change password page route


}

