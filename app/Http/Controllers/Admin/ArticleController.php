<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ViewResult;
use App\Services\ArticleService;
use App\Services\GroupService;
use App\Services\MyController;
use App\Services\ThemeService;
use App\Services\TypeService;
use App\Services\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($groupid)
    {
        return view('admin\article', [
            'group' => resolve(GroupService::class)->getById($groupid),
            'type' => resolve(TypeService::class)->all(),
            'article' => new ViewResult(),
            'groupThemes' => resolve(ThemeService::class)->getGroupThemes(),
            'themes' => resolve(ThemeService::class)->getArticleThemes(),
        ]);
    }
    public function getById($groupid, $id)
    {
        return view('admin\article_detail', [
            'group' => resolve(GroupService::class)->getById($groupid),
            'type' => resolve(TypeService::class)->all(),
            'article' => resolve(ArticleService::class)->getById($id),
            'groupThemes' => resolve(ThemeService::class)->getGroupThemes(),
            'themes' => resolve(ThemeService::class)->getArticleThemes(),
        ], ['#article-tab']);
    }
    public function create($groupid)
    {

        $request = request();
        DB::beginTransaction();
        $validator = validator($request->all(), [
            'article_title' => 'required',
            'article_body' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $article = new Article();
        $article->title = $request->article_title;
        $article->detail = $request->article_detail;
        $article->body = $request->article_body;
        $article->fk_group_id = $groupid;
        $article->fk_theme_id = $request->article_theme_id;
        $article->detail_title = $request->detail_title;
        $article->btn_detail = $request->btn_detail ? true : false;


        if ($request->hasFile('article_image_url')) {
            $article->imageFile = $request->file('article_image_url');
            $article->image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $article->imageFile->hashName();
        }
        if ($request->hasFile('article_detail_image_url')) {
            $article->detailImageFile = $request->file('article_detail_image_url');
            $article->detail_image_url = Utility::$IMAGE_PATH . DIRECTORY_SEPARATOR . $article->detailImageFile->hashName();
        }
        $result = resolve(ArticleService::class)->create($article);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return back()->with("result", $result);
    }
    public function update($groupid, $id)
    {
    }
    public function delete($groupId, $articleId)
    {
        DB::beginTransaction();
        $result = resolve(ArticleService::class)->delete($groupId,$articleId);
        if ($result->completeTransaction()) {
            $result->message = 'Deleted Successfully!';
            return redirect()->route('admin.group.getById', [
                'groupid' => $groupId
            ]);
        } else {
            $result->message = 'Something went wrong!';
            return back()->with("result", $result);
        }
        
    }
}
