<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Theme extends Component
{
    public $theme = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($theme)
    {
        $this->theme = $theme;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.theme');
    }
}
