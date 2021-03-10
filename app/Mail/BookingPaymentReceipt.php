<?php

namespace App\Mail;

use App\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingPaymentReceipt extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;
    protected $attachment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $booking, $attachment)
    {
        $this->booking = $booking;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.bookings.bookingPaymentReceipt')
        ->with('booking', $this->booking)
        ->attach($this->attachment);
    }
}
