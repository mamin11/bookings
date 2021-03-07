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
                    @if (count($upcomingBookings) > 0)
                        <div class="booking-component-body ">
                            <ul class="list-group list-group">
                                @foreach($upcomingBookings as $booking)
                                <li id="{{$loop->index}}"  class="list-group-item">
                                    <div class="pull-left">
                                        <span  class="badge" style="float:left;">Date: {{$booking->start_at}}</span>
                                        <span  class="badge" style="float:left;">Customer: {{$booking->getCustomer()->name}} ( {{ $booking->getService()->name }} )</span><br>
                                    </div>

                                    <div class="pull-right">
                                        @if($confirmCancelID === $booking->appointment_id)
                                            <span id="badge" class="badge cursor-pointer" wire:click="confirmCancel({{$booking->appointment_id}})" style="color: red; float: right;">Sure?</span>
                                        @else
                                            <i class="far fa-window-close cursor-pointer" wire:click="cancelBooking({{$booking->appointment_id}})" style="color: red; float: right;"></i>
                                        @endif
                                        <i class="fa fa-pen cursor-pointer" wire:click="updateBooking({{$booking->appointment_id}})"  style="color: black; padding-right: 10px; float: right;"></i>
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
                    @if (count($pastBookings) > 0)
                    <div class="booking-component-body ">
                        <ul class="list-group list-group">
                            @foreach($pastBookings as $booking)
                            <li id="{{$loop->index}}" class="list-group-item">
                                <div class="pull-left">
                                    <span  class="badge" style="float:left;">Date: {{$booking->start_at}}</span><br>
                                    <span  class="badge" style="float:left;">Customer: {{$booking->getCustomer()->name}} ( {{ $booking->getService()->name }} )</span>
                                </div>

                                <div class="pull-right">
                                    <i class="fa fa-pen cursor-pointer" wire:click="updateBooking({{$booking->appointment_id}})"  style="color: black; padding-right: 10px; float: right;"></i>
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
                    @if (count($cancelledBookings) > 0)
                    <div class="booking-component-body ">
                        <ul class="list-group list-group">
                            @foreach($cancelledBookings as $booking)
                            <li id="{{$loop->index}}" href="#" class="list-group-item text-danger">Date: {{$booking->start_at}}
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
                    <a href="{{route('addBooking')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        CREATE BOOKING</a>
                </div> 
            </h1>

            <div class="booking-center-head ">
                
                {{-- <div class="form-group">
                    <a wire:click="toggleComponent('showBookingDetails')" class="login-register-links-sm cursor-pointer @if($formComponents['showBookingDetails']) link-active @endif d-inline-block">Booking Details</a>
                    <a wire:click="toggleComponent('deleteBooking')" class="login-register-links-sm cursor-pointer @if($formComponents['deleteBooking']) link-active @endif  d-inline-block">Delete</a>
                </div> --}}
                {{-- <hr> --}}

                <div class="booking-component-body ">
                        <div class="form-container2">
                            <div id="login-register">
                                <form >
                                </form>
                            </div>
                        </div>
                </div>
                
                
            </div>

        </div>
        </div>

    </div>
</div>
