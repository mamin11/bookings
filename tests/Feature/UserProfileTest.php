<?php

namespace Tests\Feature;

use App\User;
use App\Address;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Userprofile\View;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function user_can_view_my_account_page()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/account');

        $response->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function un_logged_in_user_can_view_my_account_page()
    {
        $response = $this->get('/account');

        $response->assertStatus(302);
    }
        
        /**
     *
     * @test
     */
    public function valid_update_profile_form_should_work()
    {
        $address = Address::create([
            'address' => 'address',
            'city' => 'city',
            'country' => 'country',
            'post_code' => 'post code'
        ]);
        
        $this->actingAs(factory(User::class)->create([
            'address_id' => $address->address_id
            ]));

        Livewire::test(View::class)
        ->set('form.address', 'New address')
        ->set('form.city', 'new city')
        ->set('form.country', 'new country')
        ->call('update')
        ->assertHasNoErrors([
        'form.address',
        'form.city',
        'form.country',
        ]);
    }
}
