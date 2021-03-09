@if ($showBookingComponent)
<div>
    <div class="booking-component card shadow-lg bg-white rounded">
        <div class="booking-component-head ">

            <button wire:click="closeComponent"  class="close p-4 position-absolute top-0 right-0" >
                <span class="close-btn" aria-hidden="true">&times;</span>
            </button>

            <h1 class="text-center booking-component-head-title">Create a booking !</h1>

            <div class="pagination-circles-all">
                <div class="pagination-circle @if($formComponents['showBookingDetailForm']) active-circle @endif "></div>
                <div class="pagination-circle @if($formComponents['showCustomerDetailForm']) active-circle @endif"></div>
                <div class="pagination-circle @if($formComponents['showConfirmationForm']) active-circle @endif"></div>
            </div>

        </div>

        <!-- ****************** booking component body starts ************************* -->
            <div class="booking-component-body ">
                    {{-- <div class="login-page-photo2"> --}}
                        <div class="form-container2">
                            {{-- <div class="image-holder"></div> --}}
                            <div id="login-register">
                                <form action="{{route('customerSubmit')}}" method="POST">
                                    @csrf
                                    
                                    @if(session()->has('message'))
                                    <p class="alert {{ session()->get('alert-class', 'message') }}">{{ session()->get('message') }}</p>
                                    @endif

                                    <div class="form-group">
                                        <a wire:click="toggleComponent('showBookingDetailForm')" class="login-register-links-sm cursor-pointer @if($formComponents['showBookingDetailForm']) link-active @endif d-inline-block">Booking Details</a>
                                        <a wire:click="toggleComponent('showCustomerDetailForm')" class="login-register-links-sm cursor-pointer @if($formComponents['showCustomerDetailForm']) link-active @endif  d-inline-block">Customer Details</a>
                                        <a wire:click="toggleComponent('showConfirmationForm')" class="login-register-links-sm cursor-pointer @if($formComponents['showConfirmationForm']) link-active @endif  d-inline-block">Confirmation</a>
                                    </div>
                                    <hr>
                                        
                    
                    
                                        {{-- ************ start booiing-details form  ************* --}}
                                            @if ($formComponents['showBookingDetailForm'])
                                                
                                                <div class="form-group">
                                                    <select class="form-control @error('bookingForm.service_id') is-invalid @enderror row" type="text" wire:model.lazy="bookingForm.service_id" name="service_id"   required >
                                                        <option >Select service</option>
                                                        @if(count($services))
                                                            @foreach($services as $service)
                                                                <option value="{{$service->service_id}}">{{$service->name}}</option>
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
                                                        <option>Select staff</option>
                                                        @if(count($staff))
                                                            @foreach($staff as $staff)
                                                                <option value="{{$staff->user_id}}">{{$staff->name}}</option>
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
                                                    <label for="timepicker" id="timepickerlabel" class="col-10 col-form-label form-control">Select Start Time</label><br>
                                                    <div class="form-group">
                                                        <div class="col-10">
                                                            <input class="form-control @error('bookingForm.start_time') is-invalid @enderror row" name="start_time" wire:model.lazy="bookingForm.start_time" type="datetime-local" value="{{  $bookingForm['start_time'] ? $bookingForm['start_time'] : '' }}" id="timepicker">
                                                        </div>
                                                    </div>                                                    
                                                </div>

                                                @error('bookingForm.start_time')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong><br>
                                                    </span>
                                                @enderror

                                                @error('confirmationData.end_time')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                                @if(Auth::user()->role_id !== 3)
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
                                                @endif
                                            @endif
                                                
                    
                                        {{-- ************ end booking-details form  ************* --}}

                                        @if ($formComponents['showCustomerDetailForm'])        
                                            {{-- ************ start customer-details form  ************* --}}
                                            <div class="form-group text-center">
                                                @if(Auth::user()->role_id !== 3)<a wire:click="toggleCustomerStates('showExistingCustomerForm')" class="login-register-links-sm cursor-pointer @if($formComponents['showExistingCustomerForm']) link-active @endif d-inline-block">Existing Customer</a>
                                                <a wire:click="redirectToCreateCustomer" class="login-register-links-sm cursor-pointer d-inline-block">New Customer</a>@endif
                                            </div>
                                            <hr>

                                            @if($formComponents['showExistingCustomerForm'])
                                                    {{-- Existing customer list  --}}
                                                    @if(Auth::user()->role_id !== 3)
                                                    {{-- show new and exisiting options to non customer user --}}
                                                        @if($customers->isNotEmpty())
                                                            @foreach($customers as $customer)
                                                                <div class="form-group row">
                                                                    <div class="form-check">
                                                                        <input @if(($customer->user_id !== Auth::user()->user_id) && Auth::user()->role_id ==3) disabled @endif class="form-check-input  @error('bookingForm.customer_id') is-invalid @enderror" type="radio" wire:model="bookingForm.customer_id" value="{{$customer->user_id}}" id="{{$customer->user_id}}">
                                                                        <label class="form-check-label" for="{{$customer->user_id}}">{{$customer->name}}</label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            {{$customers->links()}}
                                                        @else
                                                        <span id="badge" class="badge" style="float:center;">No customers found</span>
                                                        @endif

                                                    @else
                                                    
                                                    <div class="form-group row">
                                                        <div class="form-check">
                                                            <input checked class="form-check-input  @error('bookingForm.customer_id') is-invalid @enderror" type="radio" wire:model="bookingForm.customer_id" value="{{ Auth::user()->user_id }}" id="{{Auth::user()->user_id}}">
                                                            <label class="form-check-label" for="{{Auth::user()->user_id}}">{{Auth::user()->name}}</label>
                                                        </div>
                                                    </div>

                                                    @endif
                                                    {{-- end of showing customers based on whose is logged in --}}

                                                @error('bookingForm.customer_id')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            @endif
                                            
                                                @if($formComponents['showNewCustomerForm'])
                                                    {{-- New customer form --}}
                                                    
                                                @endif
                                        @endif

                                        {{-- ************ end customer-details form  ************* --}}
                                        
                                        @if ($formComponents['showConfirmationForm'])        
                                        {{-- ************ start confirmation form  ************* --}}
                                            @if($showConfirmationDetails)
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <h1 class="badge" style="float:left;">Booking Summary: ({{$confirmationData['customer'] ? $confirmationData['customer']['name'] : ''}})</h1>
                                                        <h1 class="badge" style="float:right;">Price: £{{$confirmationData['price'] ? $confirmationData['price'] : ''}}</h1><br>
                                                        <p class="badge" style="float:left;">Service: {{$confirmationData['service'] ? $confirmationData['service']['name'] : ''}} {{"(".$bookingForm['duration']." hours)"}}</p>
                                                        <p class="badge" style="float:right;">Staff: {{$confirmationData['staff'] ? $confirmationData['staff']['name'] : ''}}</p><br>
                                                        <p class="badge" style="float:left;">Start time: {{$confirmationData['start_time'] ? $confirmationData['start_time'] : ''}}</p>
                                                        <p class="badge" style="float:right;">End time: {{$confirmationData['end_time'] ? $confirmationData['end_time'] : ''}}</p><br>
                                                    </div>
                                                </div>

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
                                                <strong>There is an error is previous forms</strong>
                                            </span>
                                        @endif
                                        
                                        {{-- button to create booking --}}
                                        <div class="form-group">
                                            <a  wire:click="createBooking" class="btn btn-primary rounded-pill btn-block">{{__('Reserve') }}</a>
                                        </div>
                                        <div class="form-group">
                                            <button wire:click.prevent="$emit('paynow')"  class="btn btn-success rounded-pill btn-block">{{__('Pay Now') }}</button>
                                        </div>
                                        
                                        <div wire:loading>Loading ...... </div>

                                            @else
                                                <p class="badge" style="float:center;">Please fill the previous forms</p><br>

                                            @endif


                                        {{-- ************ end confirmation form  ************* --}}
                    
                                        @endif    
                                </form>
                            </div>
                        </div>
                    {{-- </div> --}}
            </div>
            
            
        </div>
        <!-- ****************** booking component body starts ************************* -->


    </div>
</div>

</div>

@endif

{{-- <!-- show this empty div if component is closed --> --}}
<div>
</div>

