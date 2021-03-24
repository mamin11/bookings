<?php

namespace App\Http\Livewire\Stats;

use Livewire\Component;

class Card extends Component
{
    public $data;
    public $title;

    public function mount($data, $title) {
        $this->data = $data;
        $this->title = $title;
    }
    public function render()
    {
        return view('livewire.stats.card');
    }
}
