<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactPageTest extends TestCase
{
    /**
     *
     * @test
     */
    public function is_contact_form_visible_test()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('Submit');
    }

    /**
     *
     * @test
     */
    public function form_without_message_should_fail_test() {
        $response = $this->post('/contact', [
            'name' => 'Amin',
            'email' => 'test@test.com',
            'message' => ''
        ]);

        $response->assertSessionHasErrors('message');
    }

    /**
     *
     * @test
     */
    public function form_without_name_should_fail_test() {
        $response = $this->post('/contact', [
            'name' => '',
            'email' => 'test@test.com',
            'message' => 'This is the message'
        ]);

        $response->assertSessionHasErrors('name');
    }

    /**
     *
     * @test
     */
    public function form_without_message_and_name_should_fail_test() {
        $response = $this->post('/contact', [
            'name' => '',
            'email' => 'test@test.com',
            'message' => ''
        ]);

        $response->assertSessionHasErrors('name', 'message');
    }

    /**
     *
     * @test
     */
    public function valid_form_submit_should_work_test() {
        $response = $this->post('/contact', [
            'name' => 'Amin',
            'email' => 'test@test.com',
            'message' => 'This is the message'
        ]);

        $response->assertSessionHas('message');
        $response->assertStatus(302);
    }

}
