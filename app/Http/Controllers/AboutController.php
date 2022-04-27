<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $group=resolve(GroupService::class)->getAbout();
        
        if(!$group->list){
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }
        return view('about',[
            'group'=>$group->list
        ]);
    }
}
