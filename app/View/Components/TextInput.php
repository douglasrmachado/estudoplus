<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextInput extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('components.text-input');
    }

    public function formatDateTime($value)
    {
        if (!$value) return null;
        
        $date = \Carbon\Carbon::parse($value);
        return $date->format('Y-m-d\TH:i');
    }
} 