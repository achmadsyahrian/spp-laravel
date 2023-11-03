<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonDelete extends Component
{
    /**
     * Create a new component instance.
     */
    public $idForm;
    public function __construct($idForm)
    {
        $this->idForm .= $idForm;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.button-delete');
    }
}
