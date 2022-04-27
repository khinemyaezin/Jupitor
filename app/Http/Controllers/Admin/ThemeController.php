<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Services\ThemeService;
use App\Services\Utility;
use Illuminate\Support\Facades\DB;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getById($id)
    {
        return view('admin\theme', [
            'result' => resolve(ThemeService::class)->all(),
            'data' => Theme::findOrFail($id),
        ]);
    }
    public function jsonAll()
    {
        $result = resolve(ThemeService::class)->all();
        return response()->json($result);
    }
    public function all()
    {
        return view('admin/themes', [
            'result' => resolve(ThemeService::class)->all(),
            'data' => null
        ]);
    }
    public function index()
    {
        return view('admin/theme', [
            'data' => null
        ]);
    }
    public function update($id)
    {
        DB::beginTransaction();
        $request = request();
        $theme = new Theme();
        $theme->id = $id;
        $theme->title = $request->title;
        $theme->body = $request->theme_body;
        $theme->max_articles = (int) $request->max_articles;
        $theme->tree = $request->tree ? 1 : 2;
        $theme->image_type = $request->image_type_bg ? 'background-image' : 'src';

        $result = resolve(ThemeService::class)->update($theme);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);

    }

    public function allByParentId($pid)
    {
        return response()->json(resolve(ThemeService::class)->getThemeByParentId($pid));
    }
    public function create()
    {
        DB::beginTransaction();
        $request = request();
        $validator = validator($request->all(), [
            'title' => 'required',
            'theme_body' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data = new Theme();
        $data->id= Theme::max('id')+1;
        $data->status = Utility::$BIZ_STATUS['active'];
        $data->title = $request->title;
        $data->body = $request->theme_body;
        $data->max_articles = (int) $request->max_articles;
        $data->tree = $request->tree ? 1 : 2;
        $data->image_type = $request->image_type_bg ? 'background-image' : 'src';
        $result = resolve(ThemeService::class)->create($data);
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
        $result = resolve(ThemeService::class)->delete($id);
        if ($result->completeTransaction()) {
            $result->message = 'Deleted Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
}
