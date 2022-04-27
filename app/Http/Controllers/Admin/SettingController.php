<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ViewResult;
use App\Services\MyController;
use App\Services\SystemService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin\setting',[
            'result'=>new ViewResult(),
            'info'=> resolve(SystemService::class)->getCompanyInfo(),
            'account'=> resolve(SystemService::class)->getAccountInfo()
        ]);
    }
}
