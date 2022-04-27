<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use App\Models\Type;
use App\Services\TypeService;
use App\Services\Utility;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller implements MyController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin\type', [
            'result' => resolve(TypeService::class)->all(5),
            'data' => new Type(),
        ]);
    }
    public function all()
    {
        return view('admin\types', [
            'result' => resolve(TypeService::class)->all(Utility::$PAGINATION_COUNT),
            'data' => null,
        ]);
    }

    public function getById($id)
    {
        return view('admin\type', [
            'result' => resolve(TypeService::class)->nearestTypesById($id),
            'data' => Type::findOrFail($id),
        ]);
    }
    public function jsonAll()
    {
        $result = resolve(TypeService::class)->all();
        return response()->json($result);
    }
    public function create()
    {
        $request = request();
        $validator = validator($request->all(), [
            'code' => 'required',
            'title' => 'required',
        ], [
            'required' => 'The :attribute is required.',
            'required' => 'The :attribute is required.',
        ], [
            'code' => 'ID',
            'title' => 'title',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        DB::beginTransaction();
        $type = new Type();
        $type->code = $request->code;
        $type->title = $request->title;
        $type->body = $request->body;
        $type->allow_detail = $request->allow_detail ? true : false;
        $type->allow_body = $request->allow_body ? true : false;
        $type->is_unique = $request->is_unique ? true : false;
        $type->allow_pagination = $request->allow_pagination ? true : false;

        $result = resolve(TypeService::class)->create($type);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
    public function update($id)
    {
        $request = request();
        $validator = validator($request->all(), [
            'code' => 'required',
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        DB::beginTransaction();

        $type = new Type();
        $type->id = $id;
        $type->code = $request->code;
        $type->title = $request->title;
        $type->body = $request->body;
        $type->allow_detail = $request->allow_detail ? true : false;
        $type->allow_body = $request->allow_body ? true : false;
        $type->is_unique = $request->is_unique ? true : false;
        $type->allow_pagination = $request->allow_pagination ? true : false;

        $result = resolve(TypeService::class)->update($type);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
    public function delete($id)
    {
        DB::beginTransaction();
        $result = resolve(TypeService::class)->delete($id);
        if ($result->completeTransaction()) {
            $result->message = 'Deleted Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
}
