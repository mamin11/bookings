<?php

namespace App\Mail;

use App\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestCancellation extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;
    protected $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $booking, $cancellationMessage)
    {
        $this->booking = $booking;
        $this->message = $cancellationMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.bookings.requestCancel')
        ->with([
            'booking' => $this->booking,
            'message' => $this->message
            ]);
    }
}
