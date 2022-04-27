<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use App\Models\Forehead;
use App\Models\ForeheadCarousel;
use App\Models\Group;
use App\Services\CarouselService;
use App\Services\Utility;
use Illuminate\Support\Facades\DB;

class CarouselController extends Controller implements MyController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin/carousel', [
            'result' => resolve(CarouselService::class)->get(),
            'groups' => Group::all(),
        ]);
    }
    public function updateParent()
    {
        DB::beginTransaction();

        $req = request();
        $validator = validator($req->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = new Forehead();
        if ($req->id) {
            $data->id = $req->id;
        }

        $data->title = $req->title;
        $data->body = $req->body;
        $result = resolve(CarouselService::class)->updateOrCreateParent($data);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);

    }
    public function updateChild()
    {

        $request = request();
        //ddd($request);
        $validator = validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = new ForeheadCarousel();
        if ($request->id) {
            $data->id = $request->id;
        }

        $data->title = $request->title;
        $data->body = $request->body;
        $data->fk_group_id = $request->fk_group_id;

        if ($request->hasFile('image_url')) {
            $data->imageFile = $request->file('image_url');
            $data->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $data->imageFile->hashName();
        }
        $result = resolve(CarouselService::class)->updateOrCreateChild($data);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
    public function sortingCarousels()
    {
        DB::beginTransaction();
        $result = resolve(CarouselService::class)->reOrder(request());
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return response()->json($result);
    }
    public function deleteCarousel($id)
    {
        DB::beginTransaction();
        $result = resolve(CarouselService::class)->deleteCaroursel($id);
        if ($result->completeTransaction()) {
            $result->message = 'Deleted Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return response()->json($result);
    }
    public function create()
    {
        # code...
    }
    public function update($id)
    {
        # code...
    }
    public function delete($id)
    {
        # code...
    }
    public function all()
    {
        # code...
    }
    public function getById($id)
    {
        # code...
    }
}
