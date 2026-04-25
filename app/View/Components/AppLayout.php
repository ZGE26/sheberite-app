<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $backUrl;

    public $fullWidth;

    public function __construct($backUrl = null, $fullWidth = false)
    {
        $this->backUrl = $backUrl;
        $this->fullWidth = $fullWidth;
    }
    
    public function render(): View
    {
        return view('layouts.app');
    }
}