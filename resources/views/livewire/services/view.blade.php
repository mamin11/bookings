<div>
    <div id="mySidenavRight" class="sidenavRight shadow-lg">

        <div class="booking-left-center-container container-fluid" style="">
            <div class="booking-component-view  bg-white ">
                <div class="booking-component-head ">
        
        
                    <h1 class="text-center booking-component-head-title">View Services !</h1>
        
        
                </div>
        
                <!-- ****************** service component body starts ************************* -->
                    <div class="booking-component-body ">
                        <ul class="list-group list-group">
                            @if(count($services))
                                @foreach ($services as $item)
                                    <li id="item1" href="#" class="list-group-item">{{$item->name}}
                                        <div class="pull-right">
                                        <span id="badge" class="badge" style="float:left;">{{$item->price}}/hr</span>
                                        @if($confirmingID === $item->service_id)
                                            <span id="badge" class="badge cursor-pointer" wire:click="deleteService({{$item->service_id}})" style="color: red; float: right;">Sure?</span>
                                        @else
                                            <i class="fa fa-trash cursor-pointer" wire:click="confirmDelete({{$item->service_id}})" style="color: red; float: right;"></i>
                                        @endif
                                            <i class="fa fa-pen cursor-pointer" wire:click="updateService({{$item->service_id}})"  style="color: black; padding-right: 10px; float: right;"></i>
                                        </div>
                                    </li>
                                @endforeach
                                
                            @else
                            <span id="badge" class="badge" style="float:center;">Nothing found</span>
                            @endif
                        </ul>
                    </div>
                    
                    
            </div>
                <!-- ****************** service component body starts ************************* -->
        
        <div class="booking-component-view-center">
                            {{-- show update form if update button is clicked else show empty form --}}
                            @if($showUpdateForm)
                            {{-- ********** start of update service form ********* --}}
                            <div id="login-register" style="background-color: #E7E8E9 !important;">
                                                <form >
                                                    @csrf
                                                    
                                                    @if(session()->has('message'))
                                                    <p class="alert {{ session()->get('alert-class', 'message') }}">{{ session()->get('message') }}</p>
                                                    @endif
                
                                                    <hr>
                                                                <div class="form-group">
                                                                    <label for="updateServiceInput" class="col-10 col-form-label form-control">Update Service
                                                                        <i class="fas fa-sync-alt cursor-pointer" wire:click="hideUpdateForm"  style="color: black; padding-right: 10px; float: right;"></i>    
                                                                    </label><br>
                                                                    
                                                                    <div class="form-group row">
                                                                        <div class="col-10">
                                                                            <input class="form-control @error('updateServiceForm.name') is-invalid @enderror" type="text" wire:model.lazy="updateServiceForm.name" name="updateName" placeholder="name"  id="updateServiceInput" value="{{ $updateServiceForm['name'] ?  $updateServiceForm['name'] : '' }}" required  autofocus>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    @error('updateServiceForm.name')
                                                                        <span class="error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <div class="col-10">
                                                                            <input class="form-control @error('updateServiceForm.price') is-invalid @enderror" type="number" wire:model.lazy="updateServiceForm.price" name="updatePrice" placeholder="price per hour"  value="{{  $updateServiceForm['price'] ? $updateServiceForm['price'] : '' }}" required  >
                                                                        </div>
                                                                    </div>
                
                                                                    
                                                                    @error('updateServiceForm.price')
                                                                        <span class="error" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    
                                                                </div>
                
                                                                <div class="form-group">
                                                                    <button type="submit" wire:click.prevent="updateConfirm" class="btn btn-primary rounded-pill btn-block">{{__('Update') }}</button>
                                                                </div> 
                                                                
                                                </form>
                            </div>

                            {{-- *********** end of update service form ************* --}}

                        @else
                        <div id="login-register" style="background-color: #E7E8E9 !important;">
                            <form >
                                @csrf
                                
                                @if(session()->has('message'))
                                <p class="alert {{ session()->get('alert-class', 'message') }}">{{ session()->get('message') }}</p>
                                @endif

                                <hr>
                
                                    {{-- ************ start service-details form  ************* --}}
                            
                                            <div class="form-group">
                                                <label for="addServiceInput" class="col-10 col-form-label form-control">Add Service</label><br>
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('serviceForm.name') is-invalid @enderror" type="text" wire:model.lazy="serviceForm.name" name="name" placeholder="name"  id="addServiceInput" value="{{ old('name') }}" required  autofocus>
                                                    </div>
                                                </div>
                                                
                                                @error('serviceForm.name')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                                {{-- <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('serviceForm.duration') is-invalid @enderror" type="number" wire:model.lazy="serviceForm.duration" name="duration" placeholder="duration in hours"  value="{{ old('duration') }}" required >
                                                    </div>
                                                </div>

                                                
                                                @error('serviceForm.duration')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror --}}
                                                
                                                <div class="form-group row">
                                                    <div class="col-10">
                                                        <input class="form-control @error('serviceForm.price') is-invalid @enderror" type="number" wire:model.lazy="serviceForm.price" name="price" placeholder="price per hour"  value="{{ old('price') }}" required  >
                                                    </div>
                                                </div>

                                                
                                                @error('serviceForm.price')
                                                    <span class="error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" wire:click.prevent="addService" class="btn btn-primary rounded-pill btn-block">{{__('Add') }}</button>
                                                {{-- <button type="submit" wire:click.prevent="deleteService" class="btn btn-danger rounded-pill btn-block">{{__('Delete') }}</button> --}}
                                            </div> 
                                            
                
                                    {{-- ************ end service-details form  ************* --}}
                            </form>
                        </div>
                        @endif
        </div>
        </div>

    </div>
</div>
