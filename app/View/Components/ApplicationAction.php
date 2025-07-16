<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ApplicationAction extends Component
{
    public $application;
    public $action;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $application
     * @return void
     */
    public function __construct($application,$action)
    {
        $this->application = $application;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.application-action');
    }
}
