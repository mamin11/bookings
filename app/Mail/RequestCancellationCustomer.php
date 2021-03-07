<?php

namespace App\Mail;

use App\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestCancellationCustomer extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;
    protected $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $booking, $message)
    {
        $this->booking = $booking;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.bookings.requestCancelCustomer')->with([
            'booking' => $this->booking,
            'message' => $this->message
        ]);
    }
}
