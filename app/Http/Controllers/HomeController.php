<?php

namespace App\Http\Controllers;

use App\Models\Article as ModelsArticle;
use App\Services\Article;
use App\Services\ArticleGroupService;
use App\Services\ArticleHeaderService;
use App\Services\CarouselService;
use App\Services\GroupService;
use App\Services\Utility;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'groups' => resolve(GroupService::class)->getForHome(),
            'forehead'=>  resolve(CarouselService::class)->get(),
        ]);
    }
}
