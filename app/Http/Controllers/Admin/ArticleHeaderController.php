<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArticleHeaderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ArticleHeaderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        $validator = validator($request->all(), [
            'group_title' => 'required',
            'group_highlight' => 'required',
            'group_fk_type_id' => 'required',

            'article_title' => 'required',
            'article_body' => 'required',
            'article_theme_id' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $service = resolve(ArticleHeaderService::class);
        $result = $service->create($request);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        if($result->success){
            return redirect()->route('admin.group.getById',[
                'groupid'=> $result->data->id
            ]);
        }else{
            return back()->with("result", $result);
        }
        
    }
    public function update($groupid, $articleid)
    {
        $request = request();
        DB::beginTransaction();
        $validator = validator($request->all(), [
            'group_title' => 'required',
            'group_highlight' => 'required',
            'group_fk_type_id' => 'required',

            'article_title' => 'required',
            'article_body' => 'required',
            'article_theme_id' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $result = resolve(ArticleHeaderService::class)->update($request, $groupid, $articleid);
        if ($result->completeTransaction()) {
            $result->message = 'Created Successfully!';
        } else {
            $result->message = 'Something went wrong!';
        }
        return Redirect::to(URL::previous() . "#article-tab")->with("result", $result);
    }
 

}
