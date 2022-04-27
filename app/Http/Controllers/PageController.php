<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Group;
use App\Models\Type;
use App\Models\ViewResult;
use App\Services\GroupService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function groupInfo($typeCode)
    {
        return view('group',[
            'type'=> Type::where('code',$typeCode)->get()->first(),
            'group'=>resolve(GroupService::class)->getForPage($typeCode)
        ]);
    }
    public function articleInfo($typeCode,$groupid,$articleId){
   
        return view('article',[
            'type'=> Type::where('code',$typeCode)->first(),
            'group'=>  Group::findOrFail($groupid),
            'article'=>  Article::where('btn_detail',true)->findOrFail($articleId)
        ]);
    }
}
