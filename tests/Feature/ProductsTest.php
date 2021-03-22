<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Products\Productslist;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function is_products_list_visible()
    {

        Livewire::test(Productslist::class)
        ->call('render')
        ->assertStatus(200);

    }
}
