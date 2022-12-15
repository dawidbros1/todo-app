<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class Error extends Component
{
    public $name = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.error');
    }
}
