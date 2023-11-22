<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function account(){
        $order = Order::get();
        $user = User::where('role','user')->get();
        return view('admin.account.users',compact('user','order'));
    }
    public function changeRole(Request $request){
        logger($request->all());
        $data = [
            'role'=> $request->userRole
        ];
        User::where('id',$request->userId)->update($data);
    }
}
