<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\BookingComponent;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function booking_add_page_redirect_if_not_logged_in()
    {
        $response = $this->get('/bookings/add');

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function see_booking_add_page_if_logged_in()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('/bookings/add');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function booking_form_without_booking_details_should_fail()
    {
        $this->actingAs(factory(User::class)->create());

        Livewire::test(BookingComponent::class)
            ->set('bookingForm.service_id', '')
            ->set('bookingForm.staff_id', '')
            ->set('bookingForm.start_time', '')
            ->set('bookingForm.duration', '')
            ->set('bookingForm.customer_id', 1)
            ->set('bookingForm.notifyCustomer', 0)
            ->set('bookingForm.comments', '')
            ->call('createBooking')
            ->assertHasErrors([
            'bookingForm.service_id', 
            'bookingForm.staff_id', 
            'bookingForm.start_time', 
            'bookingForm.duration']);
    }

    /**
     * @test
     */
    public function booking_form_without_customer_details_should_fail()
    {
        $this->actingAs(factory(User::class)->create());

        Livewire::test(BookingComponent::class)
            ->set('bookingForm.service_id', 1)
            ->set('bookingForm.staff_id', 2)
            ->set('bookingForm.start_time', '2020-12-02 19:00')
            ->set('bookingForm.duration', 2)
            ->set('bookingForm.customer_id', '')
            ->set('bookingForm.notifyCustomer', 0)
            ->set('bookingForm.comments', '')
            ->call('createBooking')
            ->assertHasErrors([
            'bookingForm.customer_id', 
            ]);
    }

    /**
     * @test
     */
    public function booking_form_with_valid_details_should_work()
    {
        $this->actingAs(factory(User::class)->create());

        Livewire::test(BookingComponent::class)
            ->set('bookingForm.service_id', 1)
            ->set('bookingForm.staff_id', 2)
            ->set('bookingForm.start_time', '2021-05-12 08:00:00')
            ->set('bookingForm.end_time', '2021-05-12 10:00:00')
            ->set('bookingForm.duration', 2)
            ->set('bookingForm.customer_id', 1)
            ->set('bookingForm.notifyCustomer', 0)
            ->set('bookingForm.comments', '')
            ->call('createBooking')
            ->assertHasNoErrors([
                'bookingForm.service_id',
                'bookingForm.staff_id',
                'bookingForm.start_time',
                'bookingForm.end_time',
                'bookingForm.duration',
                'bookingForm.customer_id',
                'bookingForm.notifyCustomer',
                'bookingForm.comments'
            ]);
    }
}
