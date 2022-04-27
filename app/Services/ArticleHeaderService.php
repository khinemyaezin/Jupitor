<?php
namespace App\Services;

use App\Models\Article;
use App\Models\Group;
use App\Models\ViewResult;
use Illuminate\Http\Request;

class ArticleHeaderService
{
    public function getAll()
    {
    }
    public function getById($id)
    {

    }
    public function create(Request $request): ViewResult
    {
        $result = new ViewResult();
        try {
            $group = new Group();
            $group->title = $request->group_title;
            $group->highlight = $request->group_highlight;
            $group->fk_type_id = $request->group_fk_type_id;
            $group->fk_group_theme_id = $request->group_fk_group_theme_id;
            $group->on_navbar = $request->group_on_navbar ? true : false;
            $group->on_home = $request->group_on_home ? true : false;
            $group->dropdown_on_navbar = $request->group_dropdown_on_navbar ? true : false;
            $group->show_all = $request->show_all ? true : false;
            $group->has_title = $request->has_title ? true : false;
            $group->max_items = (int) $request->max_items;
            if ($request->hasFile('group_image_url')) {
                $group->imageFile = $request->file('group_image_url');
                $group->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $group->imageFile->hashName();
            }

            $groupResult = resolve(GroupService::class)->create($group);
            //ddd($groupResult);
            if ($groupResult->isSuccess()) {

                $article = new Article();
                $article->title = $request->article_title;
                $article->detail = $request->article_detail;
                $article->body = $request->article_body;
                $article->fk_group_id = $groupResult->data->id;
                $article->fk_theme_id = $request->article_theme_id;
                $article->detail_title = $request->detail_title;
                $article->btn_detail = $request->btn_detail ? true: false;

                if ($request->hasFile('article_image_url')) {
                    $article->imageFile = $request->file('article_image_url');
                    $article->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $article->imageFile->hashName();
                }
                if ($request->hasFile('article_detail_image_url')) {
                    $article->detailImageFile = $request->file('article_detail_image_url');
                    $article->detail_image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $article->detailImageFile->hashName();
                }
                $articleResult = resolve(ArticleService::class)->create($article);
                if (!$articleResult->isSuccess()) {
                    throw new \Exception("Error Processing Article", 500);
                }
            } else {
                throw new \Exception("Error Processing Group", 500);
            }
            $result->data = $groupResult->data; //insert group
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;

    }
    public function update(Request $request, $groupid, $articleid)
    {

        $result = new ViewResult();
        try {
            $group = new Group();
            $group->id = $groupid;
            $group->title = $request->group_title;
            $group->highlight = $request->group_highlight;
            $group->fk_type_id = $request->group_fk_type_id;
            $group->fk_group_theme_id = $request->group_fk_group_theme_id;
            $group->has_title = $request->has_title ? true : false;
            $group->on_navbar = $request->group_on_navbar ? true : false;
            $group->on_home = $request->group_on_home ? true : false;
            $group->dropdown_on_navbar = $request->group_dropdown_on_navbar ? true : false;
            $group->show_all = $request->show_all ? true : false;
            $group->max_items = (int) $request->max_items;

            if ($request->hasFile('group_image_url')) {
                $group->imageFile = $request->file('group_image_url');
                $group->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $group->imageFile->hashName();
            }
            //ddd($group);
            $groupResult = resolve(GroupService::class)->update($group);

            if ($groupResult->isSuccess()) {
                $applyThemeForAllSubheadings = false;

                $article = new Article();
                $article->id = $articleid;
                $article->title = $request->article_title;
                $article->detail = $request->article_detail;
                $article->body = $request->article_body;
                $article->fk_group_id = $groupid;
                $article->fk_theme_id = $request->article_theme_id;
                $article->detail_title = $request->detail_title;
                $article->btn_detail = $request->btn_detail ? true : false;
                $applyThemeForAllSubheadings = $request->applyto_all_theme ? true : false;

                if ($request->hasFile('article_image_url')) {
                    $article->imageFile = $request->file('article_image_url');
                    $article->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $article->imageFile->hashName();
                }
                if ($request->hasFile('article_detail_image_url')) {
                    $article->detailImageFile = $request->file('article_detail_image_url');
                    $article->detail_image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $article->detailImageFile->hashName();
                }
                $articleResult = resolve(ArticleService::class)->update($article);
                
                if( $applyThemeForAllSubheadings ) {
                    resolve(ArticleService::class)->applyThemeToSubheadings($article->fk_group_id,$article->fk_theme_id);
                }
                if (!$articleResult->isSuccess()) {
                    throw new \Exception("Error Processing Article", 500);
                }
            } else {
                throw new \Exception("Error Processing Group", 500);
            }
            $result->success();
        } catch (\Exception$e) {
            error_log($e->getMessage());
            $result->error($e);
        }
        return $result;
    }
}
