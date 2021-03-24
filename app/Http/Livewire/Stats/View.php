<?php

namespace App\Http\Livewire\Stats;

use App\User;
use App\Invoice;
use App\Appointment;
use Livewire\Component;

class View extends Component
{
    public $profit;
    public $upcomingBookings;
    public $cancelledBookings;
    public $customersCount;

    public function mount() {
        $this->customersCount = $this->getCustomerCount();
        $this->upcomingBookings = $this->getUpcomingBooking();
        $this->cancelledBookings = $this->getCancelledBookings();
        $this->profit = $this->calcProfit();
    }

    public function calcProfit() {
        // getTotalPrice
        $total = 0;
        $paidInvoices = Invoice::where('paid', 0)->get();
        foreach ($paidInvoices as $inv) {
            if($inv->getBooking()) {
                $total += $inv->getBooking()->getTotalPrice();
            }
        }

        return '£'.number_format($total).'';
        // return $paidInvoices->count();
    }

    public function getUpcomingBooking() {
        $date = date("Y-m-d H:i:s");
        return Appointment::where('start_at', '>=', $date)->where(['cancelled' => 1, 'status' => 1])->count();
    }

    public function getCancelledBookings() {
        return Appointment::where('cancelled', 0)->count();
    }

    public function getCustomerCount() {
        return User::where('role_id', 3)->count();
    }

    public function render()
    {
        return view('livewire.stats.view');
    }
}
