<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Headline extends Component
{
    public $group,$type,$article,$groupThemes,$themes,$sortable,$pageType;
    public function __construct($group,$type,$article,$groupThemes,$themes,$sortable,$pageType)
    {
        $this->group = $group;
        $this->type = $type;
        $this->article = $article;
        $this->sortable = $sortable;
        $this->groupThemes = $groupThemes;
        $this->themes = $themes;
        $this->pageType = $pageType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.headline');
    }
}
