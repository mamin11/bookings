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
                                                    <select class="form-control @error('register_form.name') is-invalid @enderror" type="text" wire:model.lazy="register_form.name" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                        <option value="service name">Select service</option>
                                                        <option value="service name">service 1</option>
                                                        <option value="service name">service 1</option>
                                                        <option value="service name">service 3</option>
                                                    </select>
                                                    @error('register_form.name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                    
                                                <div class="form-group">
                                                    <select class="form-control @error('register_form.name') is-invalid @enderror" type="text" wire:model.lazy="register_form.name" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" >
                                                        <option value="service name">Select staff</option>
                                                        <option value="service name">staff 1</option>
                                                        <option value="service name">staff 2 </option>
                                                        <option value="service name">staff 3 </option>
                                                    </select>                                                    
                                                    @error('register_form.email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                
                                                <div class="form-group">
                                                    <label for="example-datetime-local-input" class="col-10 col-form-label form-control">Select Date and Time</label><br>
                                                    <div class="form-group row">
                                                        <div class="col-10">
                                                            <input class="form-control" type="datetime-local" value="" id="example-datetime-local-input">
                                                        </div>
                                                    </div>                                                    
                                                    @error('register_form.password')
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
                                                            <input type="checkbox">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                
                                                {{-- <div class="form-group">
                                                    <button type="submit" wire:click.prevent="register" class="btn btn-primary rounded-pill btn-block">{{__('Submit') }}</button>
                                                </div> --}}
                                                
                    
                                        {{-- ************ end booking-details form  ************* --}}

                                        @elseif ($formComponents['showCustomerDetailForm'])        
                                        {{-- ************ start customer-details form  ************* --}}
                                        <h1 class="text-center text-dark">customer details</h1>
                                        {{-- ************ end customer-details form  ************* --}}
                                        
                                        @elseif ($formComponents['showConfirmationForm'])        

                                        {{-- ************ start confirmation form  ************* --}}
                                        <h1>confirmation page</h1>
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