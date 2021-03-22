<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use App\Product_size;
use Livewire\Livewire;
use App\Product_category;
use App\Product_material;
use App\Http\Livewire\Products\Shop;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShopTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     *
     * @test
     */
    public function is_shop_page_visible()
    {
        $category = Product_category::create([
            'name' => 'category1',
            'extra_cost' => 2
        ]);
        
        $material = Product_material::create([
            'name' => 'material',
            'extra_price_on_product' => 2
        ]);
        
        $size = Product_size::create([
            'name' => 'size',
            'extra_price_on_product' => 2
        ]);

        $products = factory(Product::class)->create([
            'category_id' => $category->category_id,
            'material_id' => $material->material_id,
            'size_id' => $size->size_id
        ]);

        Livewire::test(Shop::class)
        ->call('render')
        ->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function show_product_when_category_is_selected_shop_page_visible()
    {
        $category = Product_category::create([
            'name' => 'category1',
            'extra_cost' => 2
        ]);
        $category2 = Product_category::create([
            'name' => 'category2',
            'extra_cost' => 1
        ]);
        
        $material = Product_material::create([
            'name' => 'material',
            'extra_price_on_product' => 2
        ]);
        
        $size = Product_size::create([
            'name' => 'size',
            'extra_price_on_product' => 2
        ]);

        $products = factory(Product::class)->create([
            'category_id' => $category->category_id,
            'material_id' => $material->material_id,
            'size_id' => $size->size_id
        ]);

        Livewire::test(Shop::class)
        ->set('category', $category2->category_id)
        ->call('render')
        ->assertSee('category2')
        ->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function product_page_when_material_is_selected()
    {
        $category = Product_category::create([
            'name' => 'category1',
            'extra_cost' => 2
        ]);
        
        $material = Product_material::create([
            'name' => 'material',
            'extra_price_on_product' => 2
        ]);
        
        $material2 = Product_material::create([
            'name' => 'material2',
            'extra_price_on_product' => 2
        ]);
        
        $size = Product_size::create([
            'name' => 'size',
            'extra_price_on_product' => 2
        ]);

        $products = factory(Product::class)->create([
            'category_id' => $category->category_id,
            'material_id' => $material2->material_id,
            'size_id' => $size->size_id
        ]);

        Livewire::test(Shop::class)
        ->set('material', $material2->material_id)
        ->call('render')
        ->assertSee('material2')
        ->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function product_page_when_size_is_selected()
    {
        $category = Product_category::create([
            'name' => 'category1',
            'extra_cost' => 2
        ]);
        
        $material = Product_material::create([
            'name' => 'material',
            'extra_price_on_product' => 2
        ]);
        
        $size = Product_size::create([
            'name' => 'size',
            'extra_price_on_product' => 2
        ]);
        
        $size2 = Product_size::create([
            'name' => 'size2',
            'extra_price_on_product' => 2
        ]);

        $products = factory(Product::class)->create([
            'category_id' => $category->category_id,
            'material_id' => $material->material_id,
            'size_id' => $size2->size_id
        ]);

        Livewire::test(Shop::class)
        ->set('size', $size2->size_id)
        ->call('render')
        ->assertSee('size2')
        ->assertStatus(200);
    }
}
