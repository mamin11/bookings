<div>
    <div id="mySidenavRight" class="sidenavRight shadow-lg">

        <div class="booking-left-center-container container-fluid" style="">
            <div class="booking-component-view  bg-white ">
                <div class="booking-component-head ">
        
        
                    <h1 class="text-center booking-component-head-title">Your Staff !</h1>
        
        
                </div>
        
                <!-- ****************** staff component body starts ************************* -->
                    <div class="booking-component-body ">
                        <ul class="list-group list-group">
                            @if(count($staff))
                                @foreach ($staff as $item)
                                    <li id="item1" href="#" class="list-group-item">{{$item->name}}
                                        <div class="pull-right">
                                        <span id="badge" class="badge" style="float:left;">{{$item->email}}</span>
                                        @if($confirmingID === $item->user_id)
                                            <span id="badge" class="badge cursor-pointer" wire:click="deleteStaff({{$item->user_id}})" style="color: red; float: right;">Sure?</span>
                                        @else
                                            <i class="fa fa-trash cursor-pointer" wire:click="confirmDelete({{$item->user_id}})" style="color: red; float: right;"></i>
                                        @endif
                                            <i class="fa fa-pen cursor-pointer" wire:click="updateStaff({{$item->user_id}})"  style="color: black; padding-right: 10px; float: right;"></i>
                                        </div>
                                    </li>
                                @endforeach
                                
                            @else
                                <span id="badge" class="badge" style="float:center;">Nothing found</span>
                            @endif
                        </ul>
                    </div>
                    
                    
            </div>
                <!-- ****************** staff component body starts ************************* -->
        
        <div class="booking-component-view-center">

                            {{-- show update form if update button is clicked else show empty form --}}
                            @if($showUpdateForm)
                            {{-- ********** start of update staff form ********* --}}
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
                                                                        <a wire:click="showDetails()" class="login-register-links-sm cursor-pointer @if($showDetails) link-active @endif d-inline-block">Update Staff</a>
                                                                        <a wire:click="showServices()" class="login-register-links-sm cursor-pointer @if($showServices) link-active @endif  d-inline-block">Staff Services</a>
                                                                    </div>
                                                                    <hr>
                                                                    <br>
                                                                    
                                                                    @if($showDetails)
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateStaffForm.name') is-invalid @enderror" type="text" wire:model.lazy="updateStaffForm.name" name="updateName" placeholder="name"  id="updateCustomerInput" value="{{ $updateStaffForm['name'] ?  $updateStaffForm['name'] : '' }}" required  autofocus>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        @error('updateStaffForm.name')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        
                                                                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateStaffForm.email') is-invalid @enderror" type="email" wire:model.lazy="updateStaffForm.email" name="updateEmail" placeholder="email"  value="{{  $updateStaffForm['email'] ? $updateStaffForm['email'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                    
                                                                        
                                                                        @error('updateStaffForm.email')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <select class="form-control @error('updateStaffForm.role') is-invalid @enderror" type="text" wire:model.lazy="updateStaffForm.role" name="role" placeholder="role" value="{{ $updateStaffForm['role'] ? $updateStaffForm['role'] : '' }}" required >
                                                                                    @foreach($roles as $role)
                                                                                        <option {{$role->role_id == $updateStaffForm['role'] ? 'selected="selected"' : ''}} value="{{$role->role_id}}">{{$role->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                    
                                                                        
                                                                        @error('updateStaffForm.role')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror

                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateStaffForm.date_of_birth') is-invalid @enderror" type="date" wire:model.lazy="updateStaffForm.date_of_birth" name="date_of_birth" placeholder="date of birth"  value="{{  $updateStaffForm['date_of_birth'] ? $updateStaffForm['date_of_birth'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateStaffForm.date_of_birth')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateStaffForm.address') is-invalid @enderror" type="text" wire:model.lazy="updateStaffForm.address" name="address" placeholder="Address"  value="{{  $updateStaffForm['address'] ? $updateStaffForm['address'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateStaffForm.address')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateStaffForm.city') is-invalid @enderror" type="text" wire:model.lazy="updateStaffForm.city" name="city" placeholder="City"  value="{{  $updateStaffForm['city'] ? $updateStaffForm['city'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateStaffForm.city')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateStaffForm.country') is-invalid @enderror" type="text" wire:model.lazy="updateStaffForm.country" name="country" placeholder="Country"  value="{{  $updateStaffForm['country'] ? $updateStaffForm['country'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateStaffForm.country')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                        
                                                                        <div class="form-group row">
                                                                            <div class="col-10">
                                                                                <input class="form-control @error('updateStaffForm.post_code') is-invalid @enderror" type="text" wire:model.lazy="updateStaffForm.post_code" name="post_code" placeholder="Post code"  value="{{  $updateStaffForm['post_code'] ? $updateStaffForm['post_code'] : '' }}" required  >
                                                                            </div>
                                                                        </div>
                        
                                                                        
                                                                        @error('updateStaffForm.post_code')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        
                                                                    </div>

                                                                    @endif

                                                                {{-- pre-check staff services in the database loop all the services and check againt updating staff services --}}
                                                                    @if($showServices)
                                                                    <p class="text-center">GREENS WERE PREVIOUSLY ASSIGNED. DONT FORGET TO RE-CHECK THEM IF NEEDED</p>
                                                                        @foreach($services as $service)
                                                                            <div class="form-check">
                                                                                <input class="form-check-input "  wire:model.defer="updateStaffForm.services" name="services[]" type="checkbox" value="{{$service->service_id}}" id="{{$service->service_id}}">
                                                                                {{-- <input class="form-check-input" {{ in_array( $service->service_id, $staffServices ) ? 'checked' : '' }} wire:model.defer="updateStaffForm.services.{{$loop->index}}" name="services[]" type="checkbox" value="{{$service->service_id}}" id="{{$service->service_id}}"> --}}
                                                                                <label class="form-check-label {{ in_array( $service->service_id, $staffServices ) ? 'bg-success' : '' }}" for="{{$service->service_id}}">{{$service->name}}</label>
                                                                            </div>
                                                                        @endforeach

                                                                        @error('updateStaffForm.services')
                                                                            <span class="error" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror

                                                                        <div class="form-group">
                                                                            <button type="submit" wire:click.prevent="updateConfirm" class="btn btn-primary rounded-pill btn-block">{{__('Update') }}</button>
                                                                        </div> 
                                                                    @endif

                                                                    {{-- <ul class="list-group list-group">
                                                                        @if(count($updatingStaffServices) > 0)
                                                                            @foreach ($services as $service)
                                                                                @foreach($updatingStaffServices->getServices() as $staffService)
                                                                                <input class="form-check-input" {{$staffService->service_id == $service->service_id ? 'checked' : ''}} type="checkbox" value="{{$service->service_id}}" id="{{$service->name}}">
                                                                                <label class="form-check-label" for="{{$service->name}}">{{$service->name}}</label>
                                                                                @endforeach
                                                                            @endforeach
                                                                        @else        
                                                                                <li id="item1" class="list-group-item">No Services</li>
                                                                        @endif
                                                                    </ul> --}}

                                                </form>
                            </div>

                            {{-- *********** end of update staff form ************* --}}

                        @else
                        <div id="login-register" style="background-color: #E7E8E9 !important;">
                            <form >
                                @csrf
                                
                                @if(session()->has('message'))
                                <p class="alert {{ session()->get('alert-class', 'message') }}">{{ session()->get('message') }}</p>
                                @endif

                                <hr>
                
                                    {{-- ************ start staff-details form  ************* --}}
                            
                                            <div class="form-group">
                                                
                                                <div class="form-group">
                                                    <a wire:click="addStaffDetails()" class="login-register-links-sm cursor-pointer @if($addStaffDetails) link-active @endif d-inline-block">Staff Details</a>
                                                    <a wire:click="addStaffServices()" class="login-register-links-sm cursor-pointer @if($addStaffServices) link-active @endif  d-inline-block">Speciality Services</a>
                                                </div>
                                                <hr>
                                                <br>
                                                
                                                @if($addStaffDetails)
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('staffForm.name') is-invalid @enderror" type="text" wire:model.lazy="staffForm.name" name="name" placeholder="name"  id="addCustomerInput" value="{{ old('name') }}" required  autofocus>
                                                    </div>
                                                </div>
                                                
                                                @error('staffForm.name')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('staffForm.email') is-invalid @enderror" type="email" wire:model.lazy="staffForm.email" name="email" placeholder="email"  value="{{ old('email') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('staffForm.email')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('staffForm.password') is-invalid @enderror" type="text" wire:model.lazy="staffForm.password" name="password" placeholder="password"  value="{{ old('password') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('staffForm.password')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <select class="form-control @error('staffForm.role') is-invalid @enderror" type="text" wire:model.lazy="staffForm.role" name="role" placeholder="role" value="{{ old('role') }}" required >
                                                            <option value="service name">Select role</option>
                                                                @foreach($roles as $role)
                                                                    <option value="{{$role->role_id}}">{{$role->name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                
                                                @error('staffForm.role')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('staffForm.date_of_birth') is-invalid @enderror" type="date" wire:model.lazy="staffForm.date_of_birth" name="date_of_birth" placeholder="date of birth"  value="{{ old('date_of_brith') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('staffForm.date_of_birth')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('staffForm.address') is-invalid @enderror" type="text" wire:model.lazy="staffForm.address" name="address" placeholder="Address"  value="{{ old('address') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('staffForm.address')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('staffForm.city') is-invalid @enderror" type="text" wire:model.lazy="staffForm.city" name="city" placeholder="City"  value="{{ old('city') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('staffForm.city')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('staffForm.country') is-invalid @enderror" type="text" wire:model.lazy="staffForm.country" name="country" placeholder="Country"  value="{{ old('country') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('staffForm.country')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('staffForm.post_code') is-invalid @enderror" type="text" wire:model.lazy="staffForm.post_code" name="post_code" placeholder="Post code"  value="{{ old('post_code') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('staffForm.country')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                            
                                            {{-- staff sepecialities tab starts here --}}
                                            @elseif($addStaffServices)
                                            
                                            @foreach($services as $service)
                                                <div class="form-group row">
                                                    <div class="form-check">
                                                        <input class="form-check-input  @error('staffForm.services') is-invalid @enderror" type="checkbox" wire:model.lazy="staffForm.services" name="services[]" value="{{$service->service_id}}" id="{{$service->name}}">
                                                        <label class="form-check-label" for="{{$service->name}}">{{$service->name}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                                    
                                                @error('staffForm.services')
                                                <span class="error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            <div class="form-group">
                                                <button type="submit" wire:click.prevent="addStaff" class="btn btn-primary rounded-pill btn-block">{{__('Complete') }}</button>
                                            </div> 

                                            {{-- staff specialities ends here --}}

                                            @endif
                                            
                
                                    {{-- ************ end staff-details form  ************* --}}
                            </form>
                        </div>
                        @endif
        </div>
        </div>

    </div>
</div>
