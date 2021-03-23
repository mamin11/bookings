<?php

namespace App\Http\Livewire\Admin;

use App\Invoice;
use App\Message;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Sidenav extends Component
{
    public $unpaidInvoicesCount;

    public function mount() {
        $this->unpaidInvoicesCount = Invoice::where(['customer_id' => Auth::user()->user_id, 'paid' => 1])->count();
    }

    public function render()
    {
        return view('livewire.admin.sidenav');
    }
}
