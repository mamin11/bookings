<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Customers\View;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function customers_page_is_hidden_from_customers()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 3
        ]));
        $response = $this->get('/customers');

        $response->assertStatus(302);
    }

    /**
     *
     * @test
     */
    public function customers_page_is_visible_to_admin()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));
        $response = $this->get('/customers');

        $response->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function customers_page_is_visible_to_staff()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 2
        ]));
        $response = $this->get('/customers');

        $response->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function invalid_customer_form_should_fail()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));

        Livewire::test(View::class)
        ->set('customerForm.name', '')
        ->set('customerForm.email', '')
        ->set('customerForm.password', '')
        ->set('customerForm.date_of_birth', '')
        ->set('customerForm.role', '')
        ->set('customerForm.address', '')
        ->set('customerForm.city', '')
        ->set('customerForm.country', '')
        ->set('customerForm.post_code', '')
        ->call('addCustomer')
        ->assertHasErrors([
        'customerForm.name',
        'customerForm.email',
        'customerForm.password',
        'customerForm.date_of_birth',
        'customerForm.role',
        'customerForm.address',
        'customerForm.city',
        'customerForm.country',
        'customerForm.post_code',
        ]);
    }

    /**
     *
     * @test
     */
    public function valid_customer_form_should_work()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));

        Livewire::test(View::class)
        ->set('customerForm.name', 'test')
        ->set('customerForm.email', 'test@tets.com')
        ->set('customerForm.password', 'password')
        ->set('customerForm.date_of_birth', '09-12-1867')
        ->set('customerForm.role', 3)
        ->set('customerForm.address', 'Address')
        ->set('customerForm.city', 'Cisytuy')
        ->set('customerForm.country', 'Country United')
        ->set('customerForm.post_code', 'LJ4 FJ8')
        ->call('addCustomer')
        ->assertHasNoErrors([
        'customerForm.name',
        'customerForm.email',
        'customerForm.password',
        'customerForm.date_of_birth',
        'customerForm.role',
        'customerForm.address',
        'customerForm.city',
        'customerForm.country',
        'customerForm.post_code',
        ]);
    }
}
