<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use App\Models\Information;
use App\Services\SystemService;
use App\Services\Utility;
use Illuminate\Support\Facades\DB;

class CompanyInfoController extends Controller implements MyController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    }
    public function create()
    {

        $req = request();
        DB::beginTransaction();
        $validator = validator($req->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        };
        $data = new Information();
        $data->name = $req->name;
        $data->email = $req->email;
        $data->phone = $req->phone;
        $data->address = $req->address;
        $data->linkin = $req->linkin;
        $data->facebook = $req->facebook;
        $data->instagram = $req->instagram;

        $data->weekdays = $req->sun ? '1' : '0';
        $data->weekdays .= $req->mon ? '1' : '0';
        $data->weekdays .= $req->tue ? '1' : '0';
        $data->weekdays .= $req->wed ? '1' : '0';
        $data->weekdays .= $req->thu ? '1' : '0';
        $data->weekdays .= $req->fri ? '1' : '0';
        $data->weekdays .= $req->sat ? '1' : '0';

        $data->office_start_time = $req->office_start_time;
        $data->office_end_time = $req->office_end_time;

        if ($req->hasFile('image_url')) {
            $data->imageFile = $req->file('image_url');
            $data->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $data->imageFile->hashName();
        }

        $result  = resolve(SystemService::class)->createCompanyInfo($data);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
    public function update($id = -1)
    {
        $req = request();
        //ddd($req);
        DB::beginTransaction();
        $validator = validator($req->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        };
        $data = new Information();
        $data->name = $req->name;
        $data->email = $req->email;
        $data->phone = $req->phone;
        $data->address = $req->address;
        $data->linkin = $req->linkin;
        $data->facebook = $req->facebook;
        $data->instagram = $req->instagram;

        $data->weekdays = $req->sun ? '1' : '0';
        $data->weekdays .= $req->mon ? '1' : '0';
        $data->weekdays .= $req->tue ? '1' : '0';
        $data->weekdays .= $req->wed ? '1' : '0';
        $data->weekdays .= $req->thu ? '1' : '0';
        $data->weekdays .= $req->fri ? '1' : '0';
        $data->weekdays .= $req->sat ? '1' : '0';

        $data->office_start_time = $req->office_start_time;
        $data->office_end_time = $req->office_end_time;

        if ($req->hasFile('image_url')) {
            $data->imageFile = $req->file('image_url');
            $data->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $data->imageFile->hashName();
        }
        $result  = resolve(SystemService::class)->updateCompanyInfo($data);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
    public function all()
    {
        # code...
    }
    public function delete($id)
    {
        # code...
    }
    public function getById($id)
    {
        # code...
    }
}
