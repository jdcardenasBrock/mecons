<?php

namespace App\Http\Livewire\Lists;

use Livewire\Component;

class Line extends Component
{
    public $items;

    public function mount($items)
    {
        $this->items = $items;
    }
    
    public function render()
    {
        return view('livewire.lists.line');
    }
}
