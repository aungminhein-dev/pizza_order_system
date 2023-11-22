<?php

namespace App\Http\Controllers;
use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function settings(){
        return view('admin.settings.mainSetting');
    }
    public function changePasswordPage(){
        return view('admin.account.change');
    }

    //change password
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
            return redirect()->route('admin#accountSettings')->with(['matched'=>'The password has changed']);
        }
        return redirect()->route('admin#accountSettings')->with(['notMatched'=>'The old password is not correct!']);
    }
    //Account Details route
    public function accountDetails(){
        $order = Order::get();
        return view('admin.account.details',compact('order'));
    }

    //account edit
    public function editAccount(){
        $order = Order::get();
        // $this->editprofileValidationCheck($request);
        return view('admin.account.edit',compact('order'));
    }
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
        return redirect()->route('admin#accountDetails')->with(['updateSuccess'=>'Profile Updated']);
    }
    //admin list
    public function list(){
        $admins = User::when(request('key'),function($query){
            $query->orwhere('name','like','%'. request('key').'%')
            ->orwhere('email','like','%'.request('key').'%');
        })
        ->orderBy('created_at')
        ->where('role','admin')
        ->paginate(5);
        $order = Order::get();

        return view('admin.account.admin-list',compact('admins','order'));
    }
    //delete account
    public function delete($id){
        User::where('id',$id)->delete();
        return back();
    }
    //role change page
    public function editRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.role-change',compact('account'));
    }
    //change role
    public function change($id,Request $request){
        $data = $this->requestUserRole($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }
    public function changeRole(Request $request){
        $data = [
            'role'=> $request->userRole
        ];
        User::where('id',$request->userId)->update($data);
    }
    private function requestUserRole($request){
        return [
            'role'=>$request->role
        ];
    }

    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:8',
            'newPassword'=>'required|min:8',
            'confirmPassword'=>'required|min:8|same:newPassword'
        ],[

        ])->validate();
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
    //profile update validation
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

}
