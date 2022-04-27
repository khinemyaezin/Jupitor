<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use App\Models\Group;
use App\Models\Theme;
use App\Models\ViewResult;
use App\Services\GroupService;
use App\Services\ThemeService;
use App\Services\TypeService;
use App\Services\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller implements MyController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin\headline', [
            'group' => new ViewResult(),
            'type' => resolve(TypeService::class)->all(),
            'article' => new ViewResult(),
            'groupThemes' => resolve(ThemeService::class)->getGroupThemes(),
            'themes' => resolve(ThemeService::class)->getArticleThemes(),
        ]);
    }
    public function getById($id)
    {
        $group = resolve(GroupService::class)->getById($id);
        $themes = new ViewResult();
        $themes->list = Theme::findOrFail($group->data?->fk_group_theme_id)->children;
        return view('admin\headline_detail', [
            'group' => $group,
            'type' => resolve(TypeService::class)->all(),
            'article' => new ViewResult(),
            'groupThemes' => resolve(ThemeService::class)->getGroupThemes(),
            'themes' => $themes
        ]);
    }
    public function create()
    {
        # code...
    }
    public function update($id)
    {
        $request = request();

        DB::beginTransaction();
        $validator = validator($request->all(), [
            'group_title' => 'required',
            'group_highlight' => 'required',
            'group_fk_type_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $group = new Group();
        $group->id = $id;
        $group->title = $request->group_title;
        $group->highlight = $request->group_highlight;
        $group->fk_type_id = $request->group_fk_type_id;
        $group->fk_group_theme_id = $request->group_fk_group_theme_id;
        $group->on_navbar = $request->group_on_navbar ? true : false;
        $group->on_home = $request->group_on_home ? true : false;
        $group->dropdown_on_navbar = $request->group_dropdown_on_navbar ? true : false;
        $group->show_all = $request->show_all ? true : false;
        $group->max_items = (int) $request->max_items;
        $group->has_title = $request->has_title ? true : false;


        if ($request->hasFile('group_image_url')) {
            $group->imageFile = $request->file('group_image_url');
            $group->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $group->imageFile->hashName();
        }
        $result = resolve(GroupService::class)->update($group);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
    public function all()
    {
        return view('admin\headlines', [
            'result' => resolve(GroupService::class)->getAll(),
        ]);
    }
    public function reOrder(Request $request)
    {
        DB::beginTransaction();
        $result = resolve(GroupService::class)->reOrder($request);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return response()->json($result);
    }
    public function checkSystemPageDuplicate()
    {
        $request = request();
        $validator = validator($request->all(), [
            'type_id' => 'required',
        ],
            [
                'code.required' => 'code is required',
            ]);
        if ($validator->fails()) {
            return response()->json(Utility::jsonError($validator));
        }

        $result = resolve(GroupService::class)->checkSystemPageDuplicate($request);
        return response()->json($result);

    }
    public function updateStatus($groupid)
    {
        DB::beginTransaction();
        $result = resolve(GroupService::class)->updateStatus(request(), $groupid);
        if ($result->completeTransaction()) {
            $result->message = 'Status changes Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return response()->json($result);
    }
    public function delete($id)
    {
        DB::beginTransaction();
        $result = resolve(GroupService::class)->delete($id);
        if ($result->completeTransaction()) {
            $result->message = 'Status changes Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return response()->json($result);
    }

}
