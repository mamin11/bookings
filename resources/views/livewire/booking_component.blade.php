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
                                <form >
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
                                                    <select class="form-control @error('bookingForm.service_id') is-invalid @enderror" type="text" wire:model.lazy="bookingForm.service_id" name="service_id"   required >
                                                        <option >Select service</option>
                                                        @if(count($services))
                                                            @foreach($services as $service)
                                                                <option value="{{$service->service_id}}">{{$service->name}}</option>
                                                            @endforeach
                                                        @else
                                                            <option disabled >No services Found</option>
                                                        @endif
                                                    </select>
                                                    @error('register_form.name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                    
                                                <div class="form-group">
                                                    <select class="form-control @error('bookingForm.staff_id') is-invalid @enderror" type="text" wire:model.lazy="bookingForm.staff_id" name="staff_id"  required  >
                                                        <option>Select staff</option>
                                                        @if(count($staff))
                                                            @foreach($staff as $staff)
                                                                <option value="{{$staff->user_id}}">{{$staff->name}}</option>
                                                            @endforeach
                                                        @else
                                                            <option disabled >No staff Found</option>
                                                        @endif
                                                    </select>                                                    
                                                    @error('register_form.email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                
                                                <div class="form-group">
                                                    <label for="start_date" class="col-10 col-form-label form-control">Select Date</label><br>
                                                    <div class="form-group row">
                                                        <div class="col-10">
                                                            <input class="form-control" name="start_at" wire:model.lazy="bookingForm.start_date" type="date" value="{{  $bookingForm['start_date'] ? $bookingForm['start_date'] : '' }}" id="start_date">
                                                        </div>
                                                    </div>                                                    
                                                    @error('bookingForm.start_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('bookingForm.duration') is-invalid @enderror" type="number" wire:model.lazy="bookingForm.duration" name="duration" placeholder="How many hours"  value="{{  $bookingForm['duration'] ? $bookingForm['duration'] : '' }}" required  >
                                                    </div>
                                                </div>
                                
                                                <div class="form-group">
                                                    <label for="start_time" class="col-10 col-form-label form-control">Select Start Time</label><br>
                                                    <div class="form-group row">
                                                        <div class="col-10">
                                                            <input class="form-control" name="start_time" wire:model.lazy="bookingForm.start_time" type="time" value="{{  $bookingForm['start_time'] ? $bookingForm['start_time'] : '' }}" id="start_time">
                                                        </div>
                                                    </div>                                                    
                                                    @error('bookingForm.start_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="form-check" id="form-slider">
                                                        <label class="form-check-label" for="inform-customer">
                                                            Inform the customer by sending them an <span>Email </span> and <span>SMS</span>. 
                                                        </label>
                                                        <label class="switch">
                                                            <input type="checkbox" name="notifyCustomer" wire:model.lazy="bookingForm.notifyCustomer" value="{{  $bookingForm['notifyCustomer'] ? $bookingForm['notifyCustomer'] : '' }}">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                
                                                {{-- <div class="form-group">
                                                    <button type="submit" wire:click.prevent="register" class="btn btn-primary rounded-pill btn-block">{{__('Submit') }}</button>
                                                </div> --}}
                                                
                    
                                        {{-- ************ end booking-details form  ************* --}}

                                        @if ($formComponents['showCustomerDetailForm'])        
                                            {{-- ************ start customer-details form  ************* --}}
                                            <div class="form-group text-center">
                                                <a wire:click="toggleCustomerStates('showExistingCustomerForm')" class="login-register-links-sm cursor-pointer @if($formComponents['showExistingCustomerForm']) link-active @endif d-inline-block">Existing Customer</a>
                                                <a wire:click="redirectToCreateCustomer" class="login-register-links-sm cursor-pointer d-inline-block">New Customer</a>
                                            </div>
                                            <hr>

                                            @if($formComponents['showExistingCustomerForm'])
                                                    {{-- Existing customer list  --}}
                                                    @if($customers->isNotEmpty())
                                                        @foreach($customers as $customer)
                                                            <div class="form-group row">
                                                                <div class="form-check">
                                                                    <input class="form-check-input " type="radio" wire:model="bookingForm.customer_id" value="{{$customer->user_id}}" id="{{$customer->user_id}}">
                                                                    <label class="form-check-label" for="{{$customer->user_id}}">{{$customer->name}}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        {{$customers->links()}}
                                                    @else
                                                    <span id="badge" class="badge" style="float:center;">No customers found</span>
                                                    @endif
                                            @endif
                                            
                                                @if($formComponents['showNewCustomerForm'])
                                                    {{-- New customer form --}}
                                                    
                                                @endif
                                        @endif

                                        {{-- ************ end customer-details form  ************* --}}
                                        
                                        @if ($formComponents['showConfirmationForm'])        
                                        {{-- ************ start confirmation form  ************* --}}
                                            @if($showConfirmationDetails)
                                                <h1 class="badge" style="float:left;">Booking Summary: ({{$confirmationData['customer'] ? $confirmationData['customer']['name'] : ''}})</h1>
                                                <h1 class="badge" style="float:right;">Price: {{$confirmationData['price'] ? $confirmationData['price'] : ''}}</h1><br>
                                                <p class="badge" style="float:left;">Service: {{$confirmationData['service'] ? $confirmationData['service']['name'] : ''}} {{"(".$bookingForm['duration']." hours)"}}</p>
                                                <p class="badge" style="float:right;">Date: {{$confirmationData['date'] ? $confirmationData['date'] : ''}}</p><br>
                                                <p class="badge" style="float:left;">Staff: {{$confirmationData['staff'] ? $confirmationData['staff']['name'] : ''}}</p>
                                                <p class="badge" style="float:right;">Time: {{$confirmationData['time'] ? $confirmationData['time'] : ''}}</p><br>
                                            @else
                                                <p class="badge" style="float:right;">Please fill the previous forms</p><br>

                                            @endif


                                        
                                        <div class="form-group">
                                            <button type="submit" wire:click.prevent="createBooking" class="btn btn-primary rounded-pill btn-block">{{__('Add') }}</button>
                                        </div> 
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