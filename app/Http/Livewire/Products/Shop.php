<?php

namespace App\Http\Livewire\Products;

use App\Product;
use App\Product_size;
use Livewire\Component;
use App\Product_category;
use App\Product_material;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    
    private $products;
    public $search = '';
    public $price = '';
    public $category = '';
    public $material = '';
    public $size = '';

    public $categories;
    public $materials;
    public $sizes;
    public $maxPrice = 0;

    public function mount() {
        $this->categories = Product_category::all();
        $this->materials = Product_material::all();
        $this->sizes = Product_size::all();

        $allProds = Product::all();
        if($allProds->count() > 0) {
            $this->maxPrice = Product::orderBy('price', 'desc')->first()->price;
        }
    }
    
    public function render()
    {
    $this->products = Product::where('name', 'like', '%'.$this->search.'%')->paginate(16);

        if($this->category){
            $this->products = Product::where('name', 'like', '%'.$this->search.'%')->where('category_id', $this->category)->paginate(16);
        }
        if($this->material){
            $this->products = Product::where('name', 'like', '%'.$this->search.'%')->where('material_id', $this->material)->paginate(16);
        }
        if($this->size){
            $this->products = Product::where('name', 'like', '%'.$this->search.'%')->where('size_id', $this->size)->paginate(16);
        }
        if($this->price){
            $this->products = Product::where('name', 'like', '%'.$this->search.'%')->where('price', '<=', $this->price)->paginate(16);
        }

        return view('livewire.products.shop')->with([
            'products' => $this->products
            ]);
    }
}
