<?php

namespace App\Http\Livewire\Productdata;

use App\Product_size;
use Livewire\Component;
use App\Product_category;
use App\Product_material;

class View extends Component
{
    public $productCategories;
    public $productMaterials;
    public $productSizes;

    public $categoryConfirmingID;
    public $materialConfirmingID;
    public $sizeConfirmingID;

    public $categoryForm = [
        'name' => '',
        'extra_cost' => ''
    ];

    public $materialForm = [
        'name' => '',
        'extra_price_on_product' => ''
    ];

    public $sizeForm = [
        'name' => '',
        'extra_price_on_product' => ''
    ];

    //custom validation messages
    private $customMessages = [
        'required' => 'Please enter a value',
        'unique' => 'This already exists in the database',
        'string' => 'This needs to be a string',
        'integer' => 'This needs to be a number',
        'max' => 'The number exceeds the maximum (:max) allowed',
        'numeric' => 'Please enter a number value',
    ];
    

    public function mount() {
        $this->productCategories = Product_category::all();
        $this->productMaterials = Product_material::all();
        $this->productSizes = Product_size::all();
    }

    //add  function start
    public function addCategory() {
        //rules
        $rules = [
            'categoryForm.name' => 'required|String|unique:product_categories,name',
            'categoryForm.extra_cost' => 'required|numeric|max:9'
        ];

        //validate
        $validatedData = $this->validate($rules, $this->customMessages);

        //add to db
        Product_category::create([
            'name' => $this->categoryForm['name'],
            'extra_cost' => $this->categoryForm['extra_cost']
        ]);

        //redirect to refresh
        return redirect()->route('productdata');
    }

    public function addMaterial() {
        //rules
        $rules = [
            'materialForm.name' => 'required|String|unique:product_materials,name',
            'materialForm.extra_price_on_product' => 'required|numeric|max:9'
        ];

        //validate
        $validatedData = $this->validate($rules, $this->customMessages);

        //add to db
        Product_material::create([
            'name' => $this->materialForm['name'],
            'extra_price_on_product' => $this->materialForm['extra_price_on_product']
        ]);

        //redirect to refresh
        return redirect()->route('productdata');
    }

    public function addSize() {
        //rules
        $rules = [
            'sizeForm.name' => 'required|String|unique:product_sizes,name',
            'sizeForm.extra_price_on_product' => 'required|numeric|max:9'
        ];

        //validate
        $validatedData = $this->validate($rules, $this->customMessages);

        //add to db
        Product_size::create([
            'name' => $this->sizeForm['name'],
            'extra_price_on_product' => $this->sizeForm['extra_price_on_product']
        ]);

        //redirect to refresh
        return redirect()->route('productdata');
    }
    //add function end

    //update functions start
    public function updateCategory($id) {

    }
    public function updateMaterial($id) {

    }
    public function updateSize($id) {

    }
    //update functions end

    //confirm delete function start
    public function confirmDelete($id) {
        $this->categoryConfirmingID = $id;
    }

    public function confirmDeleteMaterial($id) {
        $this->materialConfirmingID = $id;
    }

    public function confirmDeleteSize($id) {
        $this->sizeConfirmingID = $id;
    }
    //confirm delete function

    //delete functions start here
    public function deleteCategory($id) {
        Product_category::destroy($id);
        return redirect()->route('productdata');
    }

    public function deleteMaterial($id) {
        Product_material::destroy($id);
        return redirect()->route('productdata');
    }

    public function deleteSize($id) {
        Product_size::destroy($id);
        return redirect()->route('productdata');
    }
    //delete functions end here

    public function render()
    {
        return view('livewire.productdata.view');
    }
}
