<div>
    <div id="mySidenavRight" class="sidenavRight shadow-lg">

        <div class="booking-left-center-container container-fluid" style="">
            <div class="booking-component-view  bg-white ">
                <div class="booking-component-head ">
        
        
                    <h1 class="text-center booking-component-head-title">View Customers !</h1>
        
        
                </div>
        
                <!-- ****************** customer component body starts ************************* -->
                    <div class="booking-component-body ">
                        <ul class="list-group list-group">
                            @foreach ($customers as $item)
                                <li id="item1" href="#" class="list-group-item">{{$item->name}}
                                    <div class="pull-right">
                                    <span id="badge" class="badge" style="float:left;">{{$item->email}}</span>
                                    @if($confirmingID === $item->customer_id)
                                        <span id="badge" class="badge cursor-pointer" wire:click="deleteCustomer({{$item->customer_id}})" style="color: red; float: right;">Sure?</span>
                                    @else
                                        <i class="fa fa-trash cursor-pointer" wire:click="confirmDelete({{$item->customer_id}})" style="color: red; float: right;"></i>
                                    @endif
                                        <i class="fa fa-pen cursor-pointer" wire:click="updateCustomer({{$item->customer_id}})"  style="color: black; padding-right: 10px; float: right;"></i>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    
            </div>
                <!-- ****************** customer component body starts ************************* -->
        
        <div class="booking-component-view-center">
                            {{-- show update form if update button is clicked else show empty form --}}
                            @if($showUpdateForm)
                            {{-- ********** start of update customer form ********* --}}
                            <div id="login-register" style="background-color: #E7E8E9 !important;">
                                                <form >
                                                    @csrf
                                                    
                                                    @if(session()->has('message'))
                                                    <p class="alert {{ session()->get('alert-class', 'message') }}">{{ session()->get('message') }}</p>
                                                    @endif
                
                                                    <hr>
                                                                <div class="form-group">
                                                                    <i class="fas fa-sync-alt cursor-pointer" wire:click="hideUpdateForm"  style="color: black; padding-right: 10px; float: right;"></i>    
                                                                    
                                                                    
                                                                    <div class="form-group">
                                                                        <a wire:click="showDetails()" class="login-register-links-sm cursor-pointer @if($showDetails) link-active @endif d-inline-block">Update Customer</a>
                                                                        <a wire:click="showBookings()" class="login-register-links-sm cursor-pointer @if($showBookings) link-active @endif  d-inline-block">Booking Details</a>
                                                                    </div>
                                                                    <hr>
                                                                    <br>
                                                                    
                                                                    @if($showDetails)
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateCustomerForm.name') is-invalid @enderror" type="text" wire:model.lazy="updateCustomerForm.name" name="updateName" placeholder="name"  id="updateCustomerInput" value="{{ $updateCustomerForm['name'] ?  $updateCustomerForm['name'] : '' }}" required  autofocus>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        @error('updateCustomerForm.name')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        
                                                                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateCustomerForm.email') is-invalid @enderror" type="email" wire:model.lazy="updateCustomerForm.email" name="updateEmail" placeholder="email"  value="{{  $updateCustomerForm['email'] ? $updateCustomerForm['email'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                    
                                                                        
                                                                        @error('updateCustomerForm.email')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror

                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateCustomerForm.date_of_birth') is-invalid @enderror" type="date" wire:model.lazy="updateCustomerForm.date_of_birth" name="date_of_birth" placeholder="date of birth"  value="{{  $updateCustomerForm['date_of_birth'] ? $updateCustomerForm['date_of_birth'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateCustomerForm.date_of_birth')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateCustomerForm.address') is-invalid @enderror" type="text" wire:model.lazy="updateCustomerForm.address" name="address" placeholder="Address"  value="{{  $updateCustomerForm['address'] ? $updateCustomerForm['address'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateCustomerForm.address')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateCustomerForm.city') is-invalid @enderror" type="text" wire:model.lazy="updateCustomerForm.city" name="city" placeholder="City"  value="{{  $updateCustomerForm['city'] ? $updateCustomerForm['city'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateCustomerForm.city')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateCustomerForm.country') is-invalid @enderror" type="text" wire:model.lazy="updateCustomerForm.country" name="country" placeholder="Country"  value="{{  $updateCustomerForm['country'] ? $updateCustomerForm['country'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateCustomerForm.country')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateCustomerForm.post_code') is-invalid @enderror" type="text" wire:model.lazy="updateCustomerForm.post_code" name="post_code" placeholder="Post code"  value="{{  $updateCustomerForm['post_code'] ? $updateCustomerForm['post_code'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateCustomerForm.post_code')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        
                                                                    </div>
                        
                    
                                                                    <div class="form-group">
                                                                        <button type="submit" wire:click.prevent="updateConfirm" class="btn btn-primary rounded-pill btn-block">{{__('Update') }}</button>
                                                                    </div> 

                                                                    @endif

                                                                    @if($showBookings)
                                                                        <ul class="list-group list-group">
                                                                            @if(count($updatingCustomerBookings) > 0)
                                                                                @foreach ($updatingCustomerBookings as $item)
                                                                                    @foreach($item->getBookings() as $booking)
                                                                                        <li id="item1" href="#" class="list-group-item">{{$booking->start_at}}</li>
                                                                                    @endforeach
                                                                                @endforeach
                                                                            @else        
                                                                                    <li id="item1" href="#" class="list-group-item">No bookings</li>
                                                                            @endif
                                                                        </ul>
                                                                    @endif

                                                </form>
                            </div>

                            {{-- *********** end of update customer form ************* --}}

                        @else
                        <div id="login-register" style="background-color: #E7E8E9 !important;">
                            <form >
                                @csrf
                                
                                @if(session()->has('message'))
                                <p class="alert {{ session()->get('alert-class', 'message') }}">{{ session()->get('message') }}</p>
                                @endif

                                <hr>
                
                                    {{-- ************ start customer-details form  ************* --}}
                            
                                            <div class="form-group">

                                                <div class="form-group">
                                                    <a class="login-register-links-sm cursor-pointer d-inline-block">Add Customer</a>
                                                </div>
                                                <hr>

                                                {{-- <label for="addCustomerInput" class="col-10 col-form-label form-control">Add Customer</label><br> --}}
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('customerForm.name') is-invalid @enderror" type="text" wire:model.lazy="customerForm.name" name="name" placeholder="name"  id="addCustomerInput" value="{{ old('name') }}" required  autofocus>
                                                    </div>
                                                </div>
                                                
                                                @error('customerForm.name')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                                {{-- <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('customerForm.duration') is-invalid @enderror" type="number" wire:model.lazy="customerForm.duration" name="duration" placeholder="duration in hours"  value="{{ old('duration') }}" required >
                                                    </div>
                                                </div>

                                                
                                                @error('customerForm.duration')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror --}}
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('customerForm.email') is-invalid @enderror" type="email" wire:model.lazy="customerForm.email" name="email" placeholder="email"  value="{{ old('email') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('customerForm.email')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('customerForm.password') is-invalid @enderror" type="text" wire:model.lazy="customerForm.password" name="password" placeholder="password"  value="{{ old('password') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('customerForm.password')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('customerForm.date_of_birth') is-invalid @enderror" type="date" wire:model.lazy="customerForm.date_of_birth" name="Date_of_birth" placeholder="date of birth"  value="{{ old('date_of_brith') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('customerForm.date_of_birth')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('customerForm.address') is-invalid @enderror" type="text" wire:model.lazy="customerForm.address" name="address" placeholder="Address"  value="{{ old('address') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('customerForm.address')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('customerForm.city') is-invalid @enderror" type="text" wire:model.lazy="customerForm.city" name="city" placeholder="City"  value="{{ old('city') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('customerForm.city')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('customerForm.country') is-invalid @enderror" type="text" wire:model.lazy="customerForm.country" name="country" placeholder="Country"  value="{{ old('country') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('customerForm.country')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('customerForm.post_code') is-invalid @enderror" type="text" wire:model.lazy="customerForm.post_code" name="post_code" placeholder="Post code"  value="{{ old('post_code') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('customerForm.country')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" wire:click.prevent="addCustomer" class="btn btn-primary rounded-pill btn-block">{{__('Add') }}</button>
                                                {{-- <button type="submit" wire:click.prevent="deleteCustomer" class="btn btn-danger rounded-pill btn-block">{{__('Delete') }}</button> --}}
                                            </div> 
                                            
                
                                    {{-- ************ end customer-details form  ************* --}}
                            </form>
                        </div>
                        @endif
        </div>
        </div>

    </div>
</div>
