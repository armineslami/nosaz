<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logo extends Component
{
    public $width;
    public $height;
    public $primaryColor;
    public $secondaryColor;
    public $background;
    /**
     * Create a new component instance.
     */
    public function __construct($width = "64px", $height = "64px", $primaryColor = "#FFFFFF", $secondaryColor = "#48998B", $background = "#1D1E1F")
    {
        $this->width = $width;
        $this->height = $height;
        $this->primaryColor = $primaryColor;
        $this->secondaryColor = $secondaryColor;
        $this->background = $background;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.logo');
    }
}
