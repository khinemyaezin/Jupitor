<?php

namespace App\Http\Controllers\auth;

use App\Exceptions\InvalidRequest;
use App\Http\Controllers\Controller;
use App\Models\ViewResult;
use App\Services\SystemService;
use App\Services\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function resetAccount()
    {
        DB::beginTransaction();
        $result = resolve(SystemService::class)->resetAccount();
        if ($result->completeTransaction()) {
            $result->message = 'Reset Successfully!';
            return redirect()->route('login');
        } else {
            $result->message = 'Something went wrong!';
            return back()->with($result);
        }
    }
    public function updateAccount()
    {
        $request = request();
        $validator = validator($request->all(), [
            'email' => 'required|string',
            'name' => 'required|string'

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        DB::beginTransaction();
        $user = Auth::user();
        if (!$user->google_id) {

            $result = resolve(SystemService::class)->updateAccount($request);
            if ($result->completeTransaction()) {
                $result->message = 'Reset Successfully!';
                return redirect()->route('login');
            } else {
                $result->message = 'Something went wrong!';
                return back()->with($result);
            }
        }
    }
    public function changePassword()
    {
        DB::beginTransaction();
        $req = request();
        $validator = validator($req->all(), [
            'password' => 'required',
            'new_password' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#account-tab")->withErrors($validator);
        }
        $result = resolve(SystemService::class)->changePassword($req->password,$req->new_password);
        if ($result->completeTransaction()) {
            $result->message = 'Password changed Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return Redirect::to(URL::previous() . "#account-tab")->with("result", $result);
    }
}
