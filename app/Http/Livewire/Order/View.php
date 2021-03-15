<?php

namespace App\Http\Livewire\Order;

use App\Order;
use App\Address;
use App\Mail\OrderDone;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class View extends Component
{
    public $orders;
    public $completedOrders;
    public $uncompletedOrders;
    public $showingOrder;
    public $showingOrderCustomer;
    public $showingOrderCustomerAddress;
    public $reminderSent = false;
    public $confirmingID;
    public $confirmingDoneID;
    public $orderViewOptions = [
        'all' => true,
        'completed' => false,
        'uncomplete' => false
    ];

    public function mount() {
        $this->orders = Order::all();
        $this->completedOrders = Order::where('completed', 0)->get();
        $this->uncompletedOrders = Order::where('completed', 1)->get();
    }

    
    public function toggleOrderComponents($option) {

        if($option === 'all'){
            $this->orderViewOptions[$option] = true;
            
            $this->orderViewOptions['completed'] = false;
            $this->orderViewOptions['uncomplete'] = false;
        }
        else if($option === 'completed') {
            $this->orderViewOptions[$option] = true;
            
            $this->orderViewOptions['all'] = false;
            $this->orderViewOptions['uncomplete'] = false;

        }
        else if($option === 'uncomplete') {
            $this->orderViewOptions[$option] = true;
            
            $this->orderViewOptions['all'] = false;
            $this->orderViewOptions['completed'] = false;

        }
        //reset sure button to cancel when components change
        $this->confirmingDoneID = null;
        $this->reminderSent = false;
    }

    public function markDone($id) {
        // dd('mark done');
        $order = Order::where('order_id', $id)->first();
        $order->completed = 0;
        $order->save();

        //SEND MAIL
        Mail::to('mamindesigns@gmail.com')->send(new OrderDone($order));

        return redirect()->route('orders');
    }

    public function confirmMarkDone($id) {
        $this->confirmingDoneID = $id;
    }

    public function showSelectedOrder($id) {
        // dd('show selected');
        $this->showingOrder = Order::where('order_id', $id)->first();
        $this->showingOrderCustomer = $this->showingOrder->getCustomer();
        $this->showingOrderCustomerAddress = Address::where('address_id', $this->showingOrderCustomer->address_id)->first();
        // dd($this->showingOrderCustomerAddress);
    }

    public function render()
    {
        return view('livewire.order.view');
    }
}
