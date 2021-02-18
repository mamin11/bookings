<div>
    <div id="mySidenavRight" class="sidenavRight shadow-lg">

        <div class="booking-left-center-container container-fluid" style="">
            <div class="booking-component-view  bg-white ">
                <div class="booking-component-head ">
        
        
                    <h1 class="text-center booking-component-head-title">View Bookings !</h1>
        
                    {{-- options for upcoming, past and cancelled --}}
                    <div class="bookings-list-filter">
                        <div wire:click="toggleBookingComponents('upcoming')" class="list-filter-item @if($bookingViewOptions['upcoming']) active-filter @endif cursor-pointer">Upcoming</div>
                        <div wire:click="toggleBookingComponents('past')" class="list-filter-item  @if($bookingViewOptions['past']) active-filter @endif  cursor-pointer">Past</div>
                        <div wire:click="toggleBookingComponents('cancelled')" class="list-filter-item  @if($bookingViewOptions['cancelled']) active-filter @endif  cursor-pointer">Cancelled</div>
                    </div>
        
                </div>
        
                <!-- ****************** booking component body starts ************************* -->
                @if($bookingViewOptions['upcoming'])
                    @if ($upcomingBookings)
                        <div class="booking-component-body ">
                            <ul class="list-group list-group">
                                @foreach($upcomingBookings as $booking)
                                <li id="{{$loop->index}}" href="#" class="list-group-item">Date: {{$booking->start_at}}
                                    <div class="pull-right">
                                    <span  class="badge" style="float:left;">Customer: {{$booking->getCustomer()->name}} ( {{ $booking->getService()->name }} )</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>                    
                    @else
                        <span  class="badge" style="float:center;">Nothing found</span>
                    @endif
                @endif

                @if($bookingViewOptions['past'])
                    @if ($pastBookings)
                    <div class="booking-component-body ">
                        <ul class="list-group list-group">
                            @foreach($pastBookings as $booking)
                            <li id="{{$loop->index}}" href="#" class="list-group-item">Date: {{$booking->start_at}}
                                <div class="pull-right">
                                <span  class="badge" style="float:left;">Customer: {{$booking->getCustomer()->name}} ( {{ $booking->getService()->name }} )</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>                        
                    @else
                        <span  class="badge" style="float:center;">Nothing found</span>
                    @endif
                @endif

                @if($bookingViewOptions['cancelled'])
                    @if ($cancelledBookings)
                    <div class="booking-component-body ">
                        <ul class="list-group list-group">
                            @foreach($cancelledBookings as $booking)
                            <li id="{{$loop->index}}" href="#" class="list-group-item">Date: {{$booking->start_at}}
                                <div class="pull-right">
                                <span class="badge" style="float:left;">Customer: {{$booking->getCustomer()->name}} ( {{ $booking->getService()->name }} )</span>
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
                <!-- ****************** booking component body starts ************************* -->
        
        <div class="booking-component-view-center">

            <h1 class="text-center">
                <div class="d-flex justify-content-center p-4">
                    <a href="/bookings/add" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        ADD BOOKING</a>
                </div> 
            </h1>

            <div class="booking-center-head ">
                
                <div class="form-group">
                    <a wire:click="toggleComponent('showBookingDetails')" class="login-register-links-sm cursor-pointer @if($formComponents['showBookingDetails']) link-active @endif d-inline-block">Booking Details</a>
                    <a wire:click="toggleComponent('editBooking')" class="login-register-links-sm cursor-pointer @if($formComponents['editBooking']) link-active @endif  d-inline-block">Edit</a>
                    <a wire:click="toggleComponent('deleteBooking')" class="login-register-links-sm cursor-pointer @if($formComponents['deleteBooking']) link-active @endif  d-inline-block">Delete</a>
                </div>
                <hr>
                
            </div>

        </div>
        </div>

    </div>
</div>
