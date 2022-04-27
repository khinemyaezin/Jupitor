<?php

namespace App\Services;

use App\Exceptions\MinItemRequiredException;
use App\Models\Article;
use App\Models\Group;
use App\Models\ViewResult;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleService
{

    public function getAll()
    {
        $result = new ViewResult();
        $result->list = Article::orderBy('id', 'asc')->get();
        foreach ($result->list as $key => $value) {
            $value->image_url = str_replace('\\', '/', asset('storage/' . $value->image_url));
        }
        $result->success();
        return $result;
    }
    public function getById($id)
    {
        $result = new ViewResult();
        $result->data = Article::findOrFail($id);
        $result->data->theme;
        $result->data->image_url = str_replace('\\', '/', asset('storage/' . $result->data->image_url));
        $result->data->detail_image_url = str_replace('\\', '/', asset('storage/' . $result->data->detail_image_url));
        return $result;
    }
    public function create(Article $article): ViewResult
    {
        $result = new ViewResult();
        try {
            $maxNo = Article::where('fk_group_id', $article->fk_group_id)->max('order');
            if ($maxNo) {
                $article->order = $maxNo + 1;
            } else {
                $article->order = 1;
            }
            if (!$article->save()) {
                throw new \Exception("Error Processing Article", 500);
            }
            if ($article->imageFile != null) {
                if (!$article->imageFile->store(Utility::$IMAGE_PATH)) {
                    throw new \Exception("Error Storing Image", 500);
                }
            }
            if ($article->detailImageFile != null) {
                if (!$article->detailImageFile->store(Utility::$IMAGE_PATH)) {
                    throw new \Exception("Error Storing Image", 500);
                }
            }
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function update(Article $article): ViewResult
    {

        $result = new ViewResult();

        $old = Article::find($article->id);
        try {
            $cols = [
                'title' => $article->title,
                'detail' => $article->detail,
                'body' => $article->body,
                'detail_title' => $article->detail_title,
                'btn_detail' => $article->btn_detail,
                'fk_theme_id' => $article->fk_theme_id
            ];

            if ($old->image_url == null && $article->imageFile != null) {
                $cols['image_url'] = $article->image_url;
            } else if ($old->image_url !== null && $article->imageFile != null) {
                // $article->image_url = $old->image_url;
                Utility::deleteImage($old->image_url);
                $cols['image_url'] = $article->image_url;
            }
            if ($old->detail_image_url == null && $article->detailImageFile != null) {
                $cols['detail_image_url'] = $article->detail_image_url;
            } else if ($old->detail_image_url !== null && $article->detailImageFile != null) {
                $article->detail_image_url = $old->detail_image_url;
            }
            $article->where('id', $article->id)
                ->update($cols);

            if ($article->imageFile != null) {
                $imageName = explode(DIRECTORY_SEPARATOR, $article->image_url);
                if (!$article->imageFile->storeAs(Utility::$IMAGE_PATH, $imageName[1])) {
                    throw new \Exception("Error Storing Image", 500);
                }
            }
            if ($article->detailImageFile != null) {
                $imageName = explode(DIRECTORY_SEPARATOR, $article->detail_image_url);
                if (!$article->detailImageFile->storeAs(Utility::$IMAGE_PATH, $imageName[1])) {
                    throw new \Exception("Error Storing Image", 500);
                }
            }
            $result->success();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
            return $result;
        }
        return $result;
    }

    public function delete($groupId, $id)
    {
        $result = new ViewResult();
        try {
            if (Group::findOrFail($groupId)->articles->count() > 1) {
                Article::find($id)->delete();
                $result->success();
            } else {
                throw new MinItemRequiredException();
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
    public function applyThemeToSubheadings($groupId, $themeId)
    {
        return Article::where('fk_group_id', $groupId)->update([
            'fk_theme_id' => $themeId
        ]);
    }
}
