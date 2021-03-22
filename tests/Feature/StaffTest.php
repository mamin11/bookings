<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Staff\View;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffTest extends TestCase
{
    use RefreshDatabase;

        /**
     *
     * @test
     */
    public function staff_page_is_hidden_from_customers()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 3
        ]));
        $response = $this->get('/staff');

        $response->assertStatus(302);
    }
    
    /**
     *
     * @test
     */
    public function staff_page_is_visible_to_admin()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));
        $response = $this->get('/staff');

        $response->assertStatus(200);
    }
    
    /**
     *
     * @test
     */
    public function staff_page_is_visible_to_staff()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 2
        ]));
        $response = $this->get('/staff');

        $response->assertStatus(200);
    }
    
        /**
     *
     * @test
     */
    public function invalid_staff_form_should_fail()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));

        Livewire::test(View::class)
        ->set('staffForm.name', '')
        ->set('staffForm.email', '')
        ->set('staffForm.password', '')
        ->set('staffForm.date_of_birth', '')
        ->set('staffForm.role', '')
        ->set('staffForm.address', '')
        ->set('staffForm.city', '')
        ->set('staffForm.country', '')
        ->set('staffForm.post_code', '')
        ->call('addStaff')
        ->assertHasErrors([
        'staffForm.name',
        'staffForm.email',
        'staffForm.password',
        'staffForm.date_of_birth',
        'staffForm.role',
        'staffForm.address',
        'staffForm.city',
        'staffForm.country',
        'staffForm.post_code',
        ]);
    }

        /**
     *
     * @test
     */
    public function valid_staff_form_should_work()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => 1
        ]));

        Livewire::test(View::class)
        ->set('staffForm.name', 'name')
        ->set('staffForm.email', 'test@test.com')
        ->set('staffForm.password', 'password')
        ->set('staffForm.date_of_birth', '2020-12-02')
        ->set('staffForm.role', 3)
        ->set('staffForm.address', 'address')
        ->set('staffForm.city', 'city')
        ->set('staffForm.country', 'country')
        ->set('staffForm.post_code', 'LSH 67D')
        ->call('addStaff')
        ->assertHasNoErrors([
        'staffForm.name',
        'staffForm.email',
        'staffForm.password',
        'staffForm.date_of_birth',
        'staffForm.role',
        'staffForm.address',
        'staffForm.city',
        'staffForm.country',
        'staffForm.post_code',
        ]);
    }
}
