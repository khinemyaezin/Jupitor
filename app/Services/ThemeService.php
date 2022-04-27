<?php
namespace App\Services;

use App\Models\Theme;
use App\Models\ThemeGroup;
use App\Models\ViewResult;

class ThemeService
{
    public function getThemeByParentId($id)
    {
        $result = new ViewResult();
        try {

            $result->list = Theme::find($id)->children;
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function all()
    {
        $result = new ViewResult();
        try {

            $result->list = Theme::orderBy('tree', 'asc')->orderBy('title', 'asc')->paginate(Utility::$PAGINATION_COUNT);
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function getGroupThemes()
    {
        $result = new ViewResult();
        try {
            $result->list = Theme::where('tree',1)->orderBy('id','asc')->get();
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function getArticleThemes()
    {
        $result = new ViewResult();
        try {
            $result->list = Theme::where('tree',2)->orderBy('id','asc')->get();
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function update($theme)
    {
        $result = new ViewResult();
        try {
            $result->success = Theme::where('id', $theme->id)->update([
                'title' => $theme->title,
                'body' => $theme->body,
                'max_articles' => $theme->max_articles,
                'tree' => $theme->tree,
                'image_type' => $theme->image_type,
            ]);
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function createThemeGroup(ThemeGroup $data)
    {
        $result = new ViewResult();
        try {
            $result->success = $data->save();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function create($theme)
    {
        $result = new ViewResult();
        try {
            $result->success = $theme->save();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function delete($id)
    {
        $result = new ViewResult();
        try {
            if (Theme::find($id)->delete()) {
                $result->success();
            } else {
                throw new \Exception("Error deleting group", 500);
            }
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);

        }
        return $result;
    }
}
