<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Utility;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('admin');
            }else if(!Utility::checkFirstTime()){
                return redirect('/login')->withErrors([
                    'google' => [trans('auth.failed')]
                ]);
            }
            else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'image_url' => "".$user->avatar,
                    'password' => encrypt($user->id),
                    'google_token'=>$user->token,
                    'ismy_url'=> false,
                    
                ]);
                Auth::login($newUser);
                return redirect()->intended('admin');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
