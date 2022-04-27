<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Services\QuotationService;
use App\Services\SystemService;
use App\Services\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    //
    public function index()
    {
        return view('contactus',[
            'info'=> resolve(SystemService::class)->getCompanyInfo()
        ]);
    }
    public function create(){
        $req = request();
        DB::beginTransaction();
        $validator = validator($req->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = new Quotation();
        $data->name = $req->name;
        $data->email = $req->email;
        $data->phone = $req->phone;
        $data->message = $req->message;
        $data->status = Utility::$QUOTE_STATUS['pending'];
        
        $result  = resolve(QuotationService::class)->create($data);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
}
