<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Services\View;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServicesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function services_page_is_hidden_from_customers()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 3
        ]));
        $response = $this->get('/services');

        $response->assertStatus(302);
    }
    
    /**
     *
     * @test
     */
    public function services_page_is_visible_to_admin()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));
        $response = $this->get('/services');

        $response->assertStatus(200);
    }
    
    /**
     *
     * @test
     */
    public function services_page_is_visible_to_staff()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 2
        ]));
        $response = $this->get('/services');

        $response->assertStatus(200);
    }
    
    /**
     *
     * @test
     */
    public function invalid_service_form_should_fail()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));

        Livewire::test(View::class)
        ->set('serviceForm.name', '')
        ->set('serviceForm.price', '')
        ->call('addService')
        ->assertHasErrors([
        'serviceForm.name',
        'serviceForm.price',
        ]);
    }
    
    /**
     *
     * @test
     */
    public function service_form_without_name_should_fail()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));

        Livewire::test(View::class)
        ->set('serviceForm.name', '')
        ->set('serviceForm.price', 200)
        ->call('addService')
        ->assertHasErrors([
        'serviceForm.name',
        ]);
    }
    
    /**
     *
     * @test
     */
    public function service_form_without_price_should_fail()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));

        Livewire::test(View::class)
        ->set('serviceForm.name', 'name')
        ->set('serviceForm.price', '')
        ->call('addService')
        ->assertHasErrors([
        'serviceForm.price',
        ]);
    }
    
    /**
     *
     * @test
     */
    public function valid_service_form_should_work()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));

        Livewire::test(View::class)
        ->set('serviceForm.name', 'name')
        ->set('serviceForm.price', 200)
        ->call('addService')
        ->assertHasNoErrors([
        'serviceForm.name',
        'serviceForm.price',
        ]);
    }
}
