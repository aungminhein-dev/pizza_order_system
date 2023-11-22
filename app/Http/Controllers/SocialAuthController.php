<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthController extends Controller
{
    // public function facebookRedirect(){
    //     return Socialite::driver('facebook')->redirect();
    // }
    // public function facebookLogin() {
    //   try {
    //     $facebookUser = Socialite::driver('facebook')->user();
    //     $exisistingUser = User::where('id',$facebookUser->id)->first();
    //     dd($facebookUser);
    //   }catch(Throwable $th){
    //     throw $th;
    //   }
    //   if($exisistingUser){
    //     Auth::login($exisistingUser);
    //     return redirect('/dashboard');
    // }else{
    //     $user = User::create([
    //         'id' => $facebookUser->id,
    //         'name' => $facebookUser->name,
    //         'email' => $facebookUser->email,
    //         'password'=>$facebookUser->password
    //     ]);
    //     Auth::login($exisistingUser);
    //     return redirect('/dashboard');
    // }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle(){
        try {
            $googleUser = Socialite::driver('google')->user();
            $exisistingUser = User::where('email',$googleUser->email)->first();

            if(!$exisistingUser){
                $newUser = User::create([
                    'name'=>$googleUser->name,
                    'email'=>$googleUser->email,
                ]);

                Auth::login($newUser);

                return redirect()->route('dashboard');
            }else {
                Auth::login($exisistingUser);
                return redirect()->route('dashboard');
            }

        }catch (\Throwable $th){
            dd('Something went wrong');
        }
    }

    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callBackFacebook()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            $exisistingUser = User::where('email',$facebookUser->email)->first();

            if(!$exisistingUser){
                $newUser = User::create([
                    'name'=>$facebookUser->name,
                    'email'=>$facebookUser->email,

                ]);

                Auth::login($newUser);
                return redirect()->route('dashboard');
            }else{
                Auth::login($exisistingUser);
                return redirect()->route('dashboard');
            }
        }catch (\Throwable $th){
           throw $th;
        }
    }
}

    