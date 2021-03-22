<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Login;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginRegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function is_login_form_visible_test()
    {
        $response = $this->get('/login');

        $response->assertSeeLivewire('login');
        $response->assertStatus(200);
        $response->assertSee('login');
    }

    /**
     *
     * @test
     */
    public function is_register_form_visible_test()
    {
        Livewire::test(Login::class)
        ->set('register_active', true)
        ->call('toggleRegister')
        ->assertSee('Have an account? Login here');
    }

    /**
     *
     * @test
     */
    public function login_form_without_email_should_fail()
    {
        Livewire::test(Login::class)
            ->set('login_form.email', '')
            ->set('login_form.password', 'password')
            ->set('login_active', true)
            ->call('login')
            ->assertHasErrors('login_form.email'); 
            
    }

    /**
     *
     * @test
     */
    public function login_form_without_password_should_fail()
    {
        Livewire::test(Login::class)
            ->set('login_form.email', 'test@test.com')
            ->set('login_form.password', '')
            ->set('login_active', true)
            ->call('login')
            ->assertHasErrors('login_form.password'); 
            
    }

    /**
     *
     * @test
     */
    public function valid_login_should_work()
    {
        $user = factory(User::class)->create();

        Livewire::test(Login::class)
            ->set('login_form.email', $user->email)
            ->set('login_form.password', $user->password)
            ->set('login_active', true)
            ->call('login')
            ->assertHasNoErrors(['login_form.email', 'login_form.password']);
    }

        /**
     *
     * @test
     */
    public function registration_without_name_should_fail()
    {
        Livewire::test(Login::class)
            ->set('register_form.name', '')
            ->set('register_form.email', 'test@test.com')
            ->set('register_form.password', 'password')
            ->set('register_form.password_confirmation', 'password')
            ->set('register_active', true)
            ->call('register')
            ->assertHasErrors('register_form.name'); 
            
    }

        /**
     *
     * @test
     */
    public function registration_without_email_should_fail()
    {
        Livewire::test(Login::class)
            ->set('register_form.name', 'name')
            ->set('register_form.email', '')
            ->set('register_form.password', 'password')
            ->set('register_form.password_confirmation', 'password')
            ->set('register_active', true)
            ->call('register')
            ->assertHasErrors('register_form.email'); 
            
    }

        /**
     *
     * @test
     */
    public function registration_without_password_should_fail()
    {
        Livewire::test(Login::class)
            ->set('register_form.name', 'name')
            ->set('register_form.email', 'test@test.com')
            ->set('register_form.password', '')
            ->set('register_form.password_confirmation', 'password')
            ->set('register_active', true)
            ->call('register')
            ->assertHasErrors('register_form.password'); 
            
    }

        /**
     *
     * @test
     */
    public function registration_without_password_confirmation_should_fail()
    {
        Livewire::test(Login::class)
            ->set('register_form.name', 'name')
            ->set('register_form.email', 'test@test.com')
            ->set('register_form.password', 'password')
            ->set('register_form.password_confirmation', '')
            ->set('register_active', true)
            ->call('register')
            ->assertHasErrors('register_form.password_confirmation'); 
            
    }
}
