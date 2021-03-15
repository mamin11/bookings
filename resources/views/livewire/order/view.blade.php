<div>
    <div>
        <div id="mySidenavRight" class="sidenavRight shadow-lg">
    
            <div class="booking-left-center-container container-fluid" style="">
                <div class="booking-component-view  bg-white ">
                    <div class="booking-component-head ">
            
            
                        <h1 class="text-center booking-component-head-title">Your Orders !</h1>
            
                        {{-- options for upcoming, past and cancelled --}}
                        <div class="bookings-list-filter">
                            <div wire:click="toggleOrderComponents('all')" class="list-filter-item @if($orderViewOptions['all']) active-filter @endif cursor-pointer">All</div>
                            <div wire:click="toggleOrderComponents('uncomplete')" class="list-filter-item  @if($orderViewOptions['uncomplete']) active-filter @endif  cursor-pointer">Upcoming</div>
                            <div wire:click="toggleOrderComponents('completed')" class="list-filter-item  @if($orderViewOptions['completed']) active-filter @endif  cursor-pointer">completed</div>
                        </div>
                    </div>
            
                    <!-- ****************** booking component body starts ************************* -->
                    @if($orderViewOptions['all'])
                        @if (count($orders) > 0)
                            <div class="booking-component-body ">
                                <ul class="list-group list-group">
                                    @foreach($orders as $order)
                                    <li id="{{$loop->index}}"  class="list-group-item  booking-hover  {{$order->order_id == $confirmingID ? 'active-booking-item'  : ''}}" >
                                        <div class="pull-left">
                                            <span  class="badge" style="float:left;">Date: {{$order->created_at}}</span><br>
                                            <span  class="badge" style="float:left;">Invoice No: {{$order->order_number}} </span>
                                        </div>
                                        @if($order->completed)
                                            <div class="pull-right">
                                                <span  class="badge" style="float:right;">
                                                    @if(Auth::user()->role_id !== 3)
                                                        @if($confirmingDoneID === $order->order_id)
                                                            <button type="button" class="btn btn-labeled btn-danger" wire:click='markDone({{$order->order_id}})'>Sure?</button>
                                                        @else
                                                            <button type="button" class="btn btn-labeled btn-danger" wire:click='confirmMarkDone({{$order->order_id}})'>Mark Done</button>
                                                        @endif
                                                    @endif
                                                </span>
                                                <span  class="badge" style="float:right;"><button type="button" class="btn btn-labeled btn-primary" wire:click="showSelectedOrder({{$order->order_id}})">View</button></span>
                                            </div>
                                        @else
                                            <div class="pull-right">
                                                <span  class="badge" style="float:right;"><button type="button" class="btn btn-labeled btn-primary" wire:click="showSelectedOrder({{$order->order_id}})">View</button></span>
                                                <span  class="badge ml-3" style="float:right;">COMPLETED</span>
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
                        
                    @if($orderViewOptions['completed'])
                        @if (count($completedOrders) > 0)
                            <div class="booking-component-body ">
                                <ul class="list-group list-group" >
                                    @foreach($completedOrders as $order)
                                        <li id="{{$loop->index}}"  class="list-group-item  booking-hover  {{$order->order_id == $confirmingID ? 'active-booking-item'  : ''}}" >
                                            <div class="pull-left">
                                                <span  class="badge" style="float:left;">Date: {{$order->created_at}}</span><br>
                                                <span  class="badge" style="float:left;">Invoice No: {{$order->order_number}} </span>
                                                <span  class="badge" style="float:right;"><button type="button" class="btn btn-labeled btn-primary" wire:click="showSelectedOrder({{$order->order_id}})">View</button></span>
                                            </div>
                                        </li>
                                        
                                    @endforeach
                                </ul>
                            </div>                    
                        @else
                            <span  class="badge" style="float:center;">Nothing found</span>
                        @endif
                    @endif

                    @if($orderViewOptions['uncomplete'])
                        @if (count($uncompletedOrders) > 0)
                            <div class="booking-component-body ">
                                <ul class="list-group list-group">
                                    @foreach($uncompletedOrders as $order)
                                    <li id="{{$loop->index}}"  class="list-group-item  booking-hover  {{$order->order_id == $confirmingID ? 'active-booking-item'  : ''}}" >
                                        <div class="pull-left">
                                            <span  class="badge" style="float:left;">Date: {{$order->created_at}}</span><br>
                                            <span  class="badge" style="float:left;">Invoice No: {{$order->order_number}} </span>
                                        </div>
                                        @if(!$order->paid)
                                            <div class="pull-right">
                                                <span  class="badge" style="float:right;">
                                                    @if(Auth::user()->role_id !== 3)
                                                        @if($confirmingDoneID === $order->order_id)
                                                            <button type="button" class="btn btn-labeled btn-danger" wire:click='markDone({{$order->order_id}})'>Sure?</button>
                                                        @else
                                                            <button type="button" class="btn btn-labeled btn-danger" wire:click='confirmMarkDone({{$order->order_id}})'>Mark Done</button>
                                                        @endif
                                                    @endif
                                                </span>
                                                <span  class="badge" style="float:right;"><button type="button" class="btn btn-labeled btn-primary" wire:click="showSelectedOrder({{$order->order_id}})">View</button></span>
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
                        
                </div>
                    <!-- ****************** order component body starts here ************************* -->

                    @if($reminderSent)
                        <div class="container">
                            <p class="text-center alert alert-danger ">REMINDER SENT</p>
                        </div>
                    @endif

                    @if($showingOrder)
                        <div class="container">
                            <!--Section: Block Content-->
                        <section>
                        
                            <!--Grid row-->
                            <div class="row">
                            
                                <!--Grid column-->
                                <div class="col-lg-8 shadow-lg">
                            
                                    <!-- Card -->
                                    <div class="card wish-list mb-3">
                                    <div class="card-body">
                            
                                        {{-- @dd($items) --}}
                                @if(($showingOrder->getTotalItems()) > 0)
                                        @foreach ($showingOrder->getOrderDetails() as $order)
                                            <div class="row mb-4">
                                                <div class="col-md-5 col-lg-3 col-xl-3">
                                                    <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                                                    <img class="img-fluid w-100"
                                                        src="{{ $order->getProduct()->getMainImage() ? $order->getProduct()->getMainImage() : 'https://via.placeholder.com/150x100' }}" alt="Sample">
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-lg-9 col-xl-9">
                                                    <div>
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                        <h5>{{ $order->getProduct()->name }}</h5>
                                                        <p class="mb-3 text-muted text-uppercase small">{{  $order->getProduct() ? $order->getProduct()->getCategory()->name : '' }}</p>
                                                        <p class="mb-2 text-muted text-uppercase small">{{ $order->getProduct() ? $order->getProduct()->getMaterial()->name : ''}}</p>
                                                        <p class="mb-3 text-muted text-uppercase small">{{ $order->getProduct() ? $order->getProduct()->getSize()->name : '' }}</p>
                                                        </div>
                        
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mb-4">      
                                        @endforeach
                                @endif
                                    </div>
                                    </div>
                                    <!-- Card -->
                            
                            
                                </div>
                                <!--Grid column-->
                            
                                        <!--Grid column-->
                                        <div class="col-lg-4 shadow-lg">
                                    
                                            <!-- Card -->
                                            <div class="card mb-3">
                                                <div class="card-body">
                                        
                                                    <h5 class="mb-3">Customer</h5>
                                        
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                            Name
                                                            <span>{{ $showingOrder->getCustomer()->name }}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                            Email
                                                            <span>{{ $showingOrder->getCustomer()->email }}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                            Address
                                                            <span>{{ $showingOrderCustomerAddress ? $showingOrderCustomerAddress->address : '' }}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                            City
                                                            <span>{{ $showingOrderCustomerAddress ? $showingOrderCustomerAddress->city : '' }}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                            Post Code
                                                            <span>{{ $showingOrderCustomerAddress ? $showingOrderCustomerAddress->post_code : '' }}</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                            Country
                                                            <span>{{ $showingOrderCustomerAddress ? $showingOrderCustomerAddress->country : '' }}</span>
                                                        </li>
                                                    </ul>
                                                    
                                        
                                                </div>
                                            </div>
                                            <!-- Card -->

                                    </div>
                                    <!--Grid column-->
                            
                            </div>
                            <!--Grid row-->
                        
                            </section>
                            <!--Section: Block Content-->
                        </div>
                    
                    <!-- ****************** order component body ends here ************************* -->
            </div>
    
        </div>

    @endif


</div>
