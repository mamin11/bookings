<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

class Images extends Component
{
    public $images;
    public $selected;
    public $currentIndex;

    public function mount($images) {
        $this->images = $images;
        $this->selectImage(0);
    }

    public function selectImage($img) {
        $i = 0;
        foreach ($this->images as $image) {
            if($i == $img) {
                $this->selected = $image;
                $this->currentIndex = $this->selected;
            }
            $i++;
        }
    }
    

    public function render()
    {
        return view('livewire.products.images')->with(['images' => $this->images]);
    }
}
