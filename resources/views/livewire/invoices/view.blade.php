<div>
    <div>
        <div id="mySidenavRight" class="sidenavRight shadow-lg">
    
            <div class="booking-left-center-container container-fluid" style="">
                <div class="booking-component-view  bg-white ">
                    <div class="booking-component-head ">
            
            
                        <h1 class="text-center booking-component-head-title">Your Invoices !</h1>
            
                        {{-- options for upcoming, past and cancelled --}}
                        <div class="bookings-list-filter">
                            <div wire:click="toggleInvoiceComponents('all')" class="list-filter-item @if($invoiceViewOptions['all']) active-filter @endif cursor-pointer">All</div>
                            <div wire:click="toggleInvoiceComponents('unpaid')" class="list-filter-item  @if($invoiceViewOptions['unpaid']) active-filter @endif  cursor-pointer">Unpaid</div>
                            <div wire:click="toggleInvoiceComponents('paid')" class="list-filter-item  @if($invoiceViewOptions['paid']) active-filter @endif  cursor-pointer">Paid</div>
                        </div>
            
                    </div>
            
                    <!-- ****************** booking component body starts ************************* -->
                    @if($invoiceViewOptions['all'])
                        @if (count($allInvoices) > 0)
                            <div class="booking-component-body ">
                                <ul class="list-group list-group">
                                    @foreach($allInvoices as $invoice)
                                    <li id="{{$loop->index}}"  class="list-group-item  booking-hover  {{$invoice->id == $confirmingID ? 'active-booking-item'  : ''}}" >
                                        <div class="pull-left">
                                            <span  class="badge" style="float:left;">Date: {{$invoice->invoice_date}}</span><br>
                                            <span  class="badge" style="float:left;">Invoice No: {{$invoice->invoice_no}} </span>
                                        </div>
                                        @if($invoice->paid)
                                            <div class="pull-right">
                                                <span  class="badge" style="float:right;">
                                                    @if(Auth::user()->role_id !== 3)
                                                        @if($confirmingCancelID === $invoice->id)
                                                            <button type="button" class="btn btn-labeled btn-danger" wire:click='cancelNow({{$invoice->id}})'>Sure?</button>
                                                        @else
                                                            <button type="button" class="btn btn-labeled btn-danger" wire:click='confirmCancel({{$invoice->id}})'>Cancel</button>
                                                        @endif
                                                    @endif
                                                </span>
                                                <span  class="badge" style="float:right;"><button type="button" class="btn btn-labeled btn-success" wire:click="payNow({{$invoice->id}})">{{Auth::user()->role_id !== 3 ? 'send reminder' : 'Pay'}}</button></span>
                                                <span  class="badge" style="float:right;"><button type="button" class="btn btn-labeled btn-primary" wire:click="showSelectedInvoice({{$invoice->id}})">View</button></span>
                                            </div>
                                        @else
                                        <div class="pull-right">
                                            <span  class="badge" style="float:right;">PAID</span>
                                            <span  class="badge" style="float:right;"></span>
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>                    
                        @else
                            <span  class="badge" style="float:center;">Nothing found</span>
                        @endif
                    @endif
    
                    @if($invoiceViewOptions['unpaid'])
                        @if (count($unPaidInvoices) > 0)
                        <div class="booking-component-body ">
                            <ul class="list-group list-group">
                                @foreach($unPaidInvoices as $invoice)
                                <li id="{{$loop->index}}" class="list-group-item" >
                                    <div class="pull-left">
                                        <span  class="badge" style="float:left;">Date: {{$invoice->invoice_date}}</span><br>
                                        <span  class="badge" style="float:left;">Invoice No: {{$invoice->invoice_no}} </span>
                                    </div>
                                    <div class="pull-right">
                                        <span  class="badge" style="float:right;">
                                            @if($confirmingCancelID === $invoice->id)
                                                <button type="button" class="btn btn-labeled btn-danger" wire:click='cancelNow({{$invoice->id}})'>Sure?</button>
                                            @else
                                                @if(Auth::user()->role_id !== 3)<button type="button" class="btn btn-labeled btn-danger" wire:click='confirmCancel({{$invoice->id}})'>Cancel</button>@endif
                                            @endif
                                        </span>
                                        <span  class="badge" style="float:right;"><button type="button" class="btn btn-labeled btn-success" wire:click='payNow({{$invoice->id}})'>{{Auth::user()->role_id !== 3 ? 'send reminder' : 'Pay'}}</button></span>
                                        <span  class="badge" style="float:right;"><button type="button" class="btn btn-labeled btn-primary" wire:click="showSelectedInvoice({{$invoice->id}})">View</button></span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>                        
                        @else
                            <span  class="badge" style="float:center;">Nothing found</span>
                        @endif
                    @endif
    
                    @if($invoiceViewOptions['paid'])
                        @if (count($paidInvoices) > 0)
                        <div class="booking-component-body ">
                            <ul class="list-group list-group">
                                @foreach($paidInvoices as $invoice)
                                <li id="{{$loop->index}}"  class="list-group-item text-dark active-booking-item-color" wire:click="showSelectedInvoice({{$invoice->id}})">Date: {{$invoice->invoice_date}}
                                    <div class="pull-left">
                                    <span class="badge" style="float:left;">Invoice No: {{$invoice->invoice_no}} </span>
                                    </div>
                                    <div class="pull-right">
                                    <span class="badge" style="float:right;">PAID</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>                        
                        @else
                            <span  class="badge" style="float:center;">Nothing found</span>
                        @endif
    
    
                    @endif
                        
                        
                </div>
                    <!-- ****************** booking component body starts here ************************* -->
                    
                @if($selectedInvoice)
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="row p-5">
                                                    <div class="col-md-6">
                                                        <h2 class="font-weight-bold">SedowStudios</h2><br>
                                                        <h2 class="font-weight-bold">{{$selectedInvoice->paid ? 'INVOICE' : 'RECEIPT'}}</h2>
                                                    </div>
                            
                                                    <div class="col-md-6 text-right">
                                                        <p class="font-weight-bold mb-1">Invoice #{{$selectedInvoice->invoice_no}}</p>
                                                        <p class="text-muted">Due:{{$selectedInvoice->invoice_date}}</p>
                                                    </div>
                                                </div>
                            
                                                <hr class="my-5">
                            
                                                <div class="row pb-5 p-5">
                                                    <div class="col-md-6">
                                                        <p class="font-weight-bold mb-4">SedowStudios Ltd</p>
                                                        <p class="mb-1">Address: 121 Downing Street</p>
                                                        <p>London</p>
                                                        <p class="mb-1">United Kingdom</p>
                                                        <p class="mb-1">6781 45P</p>
                                                    </div>
                            
                                                    <div class="col-md-6 text-right">
                                                        <p class="font-weight-bold mb-4">Payment Details</p>
                                                        <p class="mb-1"><span class="text-muted">Client Email: </span> {{$selectedInvoice->getCustomer()->email}}</p>
                                                        <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                                                        <p class="mb-1"><span class="text-muted">Payment Type: </span> Booking Appointment</p>
                                                        <p class="mb-1"><span class="text-muted">Name: </span>{{$selectedInvoice->getCustomer()->name}}</p>
                                                    </div>
                                                </div>
                            
                                                <div class="row p-5">
                                                    <div class="col-md-12">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                                                    <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                                                    <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                                                    <th class="border-0 text-uppercase small font-weight-bold">Hours</th>
                                                                    <th class="border-0 text-uppercase small font-weight-bold">Price p/h</th>
                                                                    <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>{{$selectedInvoiceBooking->getService()->name}}</td>
                                                                    <td>A {{$selectedInvoiceBooking->getService()->name}} Booking at sedowstudios</td>
                                                                    <td>{{$selectedInvoiceBooking->getDuration()}}</td>
                                                                    <td>£{{$selectedInvoiceBooking->getService()->price * 1}}</td>
                                                                    <td>£{{$selectedInvoiceBooking->getTotalPrice()}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                            
                                                <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                                                    {{-- <div class="py-3 px-5 text-right">
                                                        <div class="mb-2">Grand Total</div>
                                                        <div class="h2 font-weight-light">$234,234</div>
                                                    </div>
                            
                                                    <div class="py-3 px-5 text-right">
                                                        <div class="mb-2">Discount</div>
                                                        <div class="h2 font-weight-light">10%</div>
                                                    </div> --}}
                            
                                                    <div class="py-3 px-5 text-right">
                                                        <div class="mb-2">Sub - Total amount</div>
                                                        <div class="h2 font-weight-light">£{{$selectedInvoiceBooking->getTotalPrice()}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    </div>

                    @elseif($reminderSent)
                    <div class="container">
                    <p class="text-center alert alert-danger ">REMINDER SENT</p>
                    </div>
                    
                    <!-- ****************** booking component body ends here ************************* -->
            </div>
    
        </div>

    @endif


</div>
