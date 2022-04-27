<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component
{
    public $info = null;
    public $services = [];
    public function __construct($info,$services)
    {
        $this->info = $info;
        $this->services = $services;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
