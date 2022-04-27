<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ThemeGroup;
use App\Models\ViewResult;
use App\Services\ThemeService;
use Exception;
use Illuminate\Support\Facades\DB;

class ThemeGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin\theme_group', [
            'parents' => resolve(ThemeService::class)->getGroupThemes(),
            'children' => resolve(ThemeService::class)->getArticleThemes(),
        ]);
    }
    public function create()
    {
        DB::beginTransaction();
        $request = request();
        $result = new ViewResult();
        try {
            ThemeGroup::truncate();

            foreach ($request->list as $pid => $child) {
                foreach ($child as $child => $value) {
                    $data = new ThemeGroup();
                    $data->fk_ptheme_id = $pid;
                    $data->fk_ctheme_id = $value;
                    $result = resolve(ThemeService::class)->createThemeGroup($data);
                    if (!$result->isSuccess()) {
                        throw new Exception($result->error);
                    }
                }
            }
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }

        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {

        }
        return response()->json($result);
    }
}
