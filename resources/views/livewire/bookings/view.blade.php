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
                                        @if($confirmingID === $booking->appointment_id)
                                            <span id="badge" class="badge cursor-pointer" wire:click="cancelBooking({{$booking->appointment_id}})" style="color: red; float: right;">Sure?</span>
                                        @else
                                            <i class="far fa-window-close cursor-pointer" wire:click="confirmCancel({{$booking->appointment_id}})" style="color: red; float: right;"></i>
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
                    <a href="/bookings/add" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        ADD BOOKING</a>
                </div> 
            </h1>

            <div class="booking-center-head ">
                
                <div class="form-group">
                    <a wire:click="toggleComponent('showBookingDetails')" class="login-register-links-sm cursor-pointer @if($formComponents['showBookingDetails']) link-active @endif d-inline-block">Booking Details</a>
                    <a wire:click="toggleComponent('deleteBooking')" class="login-register-links-sm cursor-pointer @if($formComponents['deleteBooking']) link-active @endif  d-inline-block">Delete</a>
                </div>
                {{-- <hr> --}}

                <div class="booking-component-body ">
                        <div class="form-container2">
                            <div id="login-register">
                                <form >
                                    @csrf
                                        @if($formComponents['showBookingDetails']  && $updatingBooking)
                                                <div class="form-group">
                                                    <select class="form-control @error('bookingForm.service_id') is-invalid @enderror row" type="text" wire:model.lazy="bookingForm.service_id" name="service_id"   required >
                                                        @if(count($services)>0)
                                                            @foreach($services as $service)
                                                                <option {{$service->service_id == $bookingForm['service_id'] ? 'selected' : ''}} name="{{$service->service_id}}" value="{{ $service->service_id}}">{{$service->name}}</option>
                                                            @endforeach
                                                        @else
                                                            <option disabled >No services Found</option>
                                                        @endif
                                                    </select>
                                                </div>

                                                    @error('bookingForm.service_id')
                                                        <span class="error text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                        
                                                    <div class="form-group">
                                                        <select class="form-control @error('bookingForm.staff_id') is-invalid @enderror row" type="text" wire:model.lazy="bookingForm.staff_id" name="staff_id"  required  >
                                                            @if(count($staff))
                                                                @foreach($staff as $sta)
                                                                    <option {{ $sta->user_id == $bookingForm['staff_id'] ? 'selected="selected"' : ''}} value="{{ $sta->user_id}}">{{$sta->name}}</option>
                                                                @endforeach
                                                            @else
                                                                <option disabled >No staff Found</option>
                                                            @endif
                                                        </select>                                                    
                                                    </div>

                                                    @error('bookingForm.staff_id')
                                                        <span class="error text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <div class="form-group ">
                                                        <div class="col-10">
                                                            <input class="form-control @error('bookingForm.duration') is-invalid @enderror row" type="number" wire:model.lazy="bookingForm.duration" name="duration" placeholder="How many hours"  value="{{  $bookingForm['duration'] ? $bookingForm['duration'] : '' }}" required  >
                                                        </div>
                                                    </div>

                                                    @error('bookingForm.duration')
                                                        <span class="error text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <div class="form-group">
                                                        <label for="timepicker" id="timepickerlabel" class="col-10 col-form-label form-control">Previous Start Time</label><br>
                                                        <div class="form-group">
                                                            <div class="col-10">
                                                                <input class="form-control row" disabled name="originalTime" type="text" value="{{  $updatingBooking ? $updatingBooking->start_at : '' }}">
                                                                <input class="form-control @error('bookingForm.start_time') is-invalid @enderror row" name="start_time" wire:model.lazy="bookingForm.start_time" type="datetime-local" value="{{  $bookingForm['start_time'] ? $bookingForm['start_time'] : '' }}" id="timepicker">
                                                            </div>
                                                        </div>                                                    
                                                    </div>

                                                    @error('bookingForm.start_time')
                                                        <span class="error text-danger" role="alert">
                                                            <strong>{{ $message }}</strong><br>
                                                        </span>
                                                    @enderror

                                                    @error('bookingForm.end_time')
                                                        <span class="error text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <hr>
                                                        @if($customers->isNotEmpty())

                                                            @foreach($customers as $customer)
                                                                @if($bookingForm['customer_id'] == $customer->user_id)
                                                                    <div class="form-group row">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label" >Customer:</label><br>
                                                                            <input class="form-check-input" disabled type="radio" value="" id="amin">
                                                                            <label class="form-check-label" for="amin" >{{$customer->name}}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach

                                                        @else
                                                            <span id="badge" class="badge" style="float:center;">No customers found</span>
                                                        @endif
                                                    <hr>

                                                    <hr>
                                                        <div class="form-group">
                                                            <div class="form-check" id="form-slider">
                                                                <label class="form-check-label" for="addComment">
                                                                    Add Comments. 
                                                                </label>
                                                                <label class="switch">
                                                                    <input type="checkbox" name="addComment" wire:click="$toggle('showAddComment')">
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                            
                                                            @if ($showAddComment)
                                                                <div class="form-group row">
                                                                    <div class="col-10">
                                                                        <textarea class="form-control" name="bookingComment" rows="5" wire:model.lazy="bookingForm.comments" placeholder="Add a comment here "  value="{{ $bookingForm['comments'] ? '' : '' }}" id="bookingComment"></textarea>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        
                                                        @if ($errors->any())
                                                            <span class="error text-danger" role="alert">
                                                                <strong>There is an error is in forms</strong>
                                                            </span>
                                                        @endif
                                                    <hr>
                                                    
                                                    <div class="form-group">
                                                        <div class="form-check" >
                                                            <label class="form-check-label" for="inform-customer">
                                                                Inform the customer by sending them an <span>Email </span> and <span>SMS</span>. 
                                                            </label>
                                                            <label class="switch">
                                                                <input type="checkbox" name="notifyCustomer" wire:model="bookingForm.notifyCustomer" id="inform-customer" value="{{  $bookingForm['notifyCustomer'] ? $bookingForm['notifyCustomer'] : 1 }}">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" wire:click.prevent="updateBookingConfirm" class="btn btn-primary rounded-pill btn-block">{{__('Update') }}</button>
                                                    </div>
                                        @endif


                                        @if($formComponents['deleteBooking'] && $updatingBooking)
                                            @if($deleteConfirmed)
                                                <div class="alert alert-success" role="alert">
                                                    Successfully Deleted!
                                                </div>
                                            @elseif($deleteCancelled)
                                                <div class="alert alert-danger" role="alert">
                                                    Cancelled deletion!
                                                </div>
                                            @else
                                                <div class="container">
                                                    <div class="card" style="width: 28rem;">
                                                        <div class="card-body">
                                                        <h2 class="card-title">Are You Sure?</h2>
                                                        <div class="row align-items-center">
                                                            <div class="col-5 btn btn-primary ml-2" wire:click="deleteBooking({{$updatingBooking->appointment_id}})" style="background-color: green !important;">YES</div>
                                                            <div class="col-5 btn btn-primary ml-2" wire:click="cancelDeleteBooking()" style="background-color: red !important;">NO</div>
                                                        </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif

                                        @if(!$formComponents['deleteBooking']  && !$formComponents['showBookingDetails'])
                                            <span class="error" role="alert">Please select above options</span>
                                        @endif
                                </form>
                            </div>
                        </div>
                </div>
                
                
            </div>

        </div>
        </div>

    </div>
</div>
