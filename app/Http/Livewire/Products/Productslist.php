<?php

namespace App\Http\Livewire\Products;

use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Productslist extends Component
{
    use WithPagination;

    public $search = '';
    public $paginateNum = '';

    public function updateResult() {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.products.productslist', [
            'products' => Product::where('name', 'like', '%'.$this->search.'%')->paginate($this->paginateNum),
        ]);
    }
}
