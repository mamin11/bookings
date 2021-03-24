<div>
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-6">
                                {{-- card starts here --}}
                                <div class="card  shadow ">
                                    {{-- card header starts here --}}
                                    <div class="card-header bg-white border-0">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <h1 class="mb-3 text-center">Form</h1>
                                            </div>
                
                                            <div class="col-12">
                                                <form>
                                                    <div class="pl-lg-4">
                                                        <div class="row mb-5">
                                                            <div class="col-lg-12">
                                                                <div class="form-group focused">
                                                                    <input type="text" wire:model.lazy='templateForm.heading' id="templateheading" name="templateheading"  class="form-control form-control-alternative @error('templateForm.heading') is-invalid @enderror " placeholder="Heading" value="{{ $updatingTemplate ? $templateForm['heading'] : '' }}">
                                                                    <textarea style="min-height: 200px" type="text" wire:model.lazy='templateForm.message' id="templatemessage"  class="form-control form-control-alternative @error('templateForm.message') is-invalid @enderror " placeholder="Message body" value="{{ $updatingTemplate ? $templateForm['message'] : '' }}"></textarea>
                                                                    
                                                                    <div class="form-group mt-3">
                                                                        <div class="form-check" >
                                                                            <label class="form-check-label" for="active">
                                                                                set to active ({{$templateForm['active']}})
                                                                            </label>
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="active" wire:model="templateForm.active" id="active" value="{{  $updatingTemplate ? $templateForm['active'] : '' }}">
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                
                                                                @error('templateForm.heading')
                                                                    <span class="error text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong><br>
                                                                    </span>
                                                                @enderror
                
                                                                @error('templateForm.message')
                                                                    <span class="error text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                
                                        </div>
                                        
                                        
                                            {{-- button starts here --}}
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        @if($showUpdateTemButton)
                                                            <button type="submit" wire:click.prevent="updateTemplateConfirm" class="btn btn-dark rounded-pill btn-block btn-lg">{{__('Update') }}</button>
                                                        @else
                                                            <button type="submit" wire:click.prevent="addTemplate" class="btn btn-dark rounded-pill btn-block btn-lg">{{__('Add') }}</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- button ends here --}}
                
                                    </div>
                                    {{-- card header ends here --}}
                                
                                    <div class="card-body">
                                        <ul class="list-group list-group">
                                            @if(count($templates))
                                                @foreach ($templates as $item)
                                                    <li id="template{{$item->id}}"  class="list-group-item">{{$item->heading}}
                                                        <div class="pull-right">
                                                        <span id="badge" class="badge" style="float:left;">Status: {{$item->active == 1 ? ' active' : ' in-active'}}</span>
                                                        @if($templateConfirmingID === $item->id)
                                                            <span id="badge" class="badge cursor-pointer" wire:click="deleteTemplate({{$item->id}})" style="color: red; float: right;">Sure?</span>
                                                        @else
                                                            <i class="fa fa-trash cursor-pointer" wire:click="confirmDelete({{$item->id}})" style="color: red; float: right;"></i>
                                                        @endif
                                                            <i class="fa fa-pen cursor-pointer" wire:click="updateTemplate({{$item->id}})"  style="color: black; padding-right: 10px; float: right;"></i>
                                                            <i class="fa fa-eye cursor-pointer" wire:click="viewTemplate({{$item->id}})"  style="color: black; padding-right: 10px; float: right;"></i>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                
                                            @else
                                            <span id="badge" class="badge" style="float:center;">Nothing found</span>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                {{-- card ends here --}}
            </div>

            <div class="col-md-3" id="sms-preview">
                {{-- <div class="card  shadow "> --}}

                    {{-- <h1 class="my-3 text-center">Preview</h1> --}}
                    @if($viewingTemplate)
                    <div class="template">
                        <h6 class=" " >{{$viewingTemplate->heading}} </h6>
                        <p class=" " >{{$viewingTemplate->message}} </p>
                        <span>Thanks,</span><br>
                        <span>Sedowstudios</span>

                    </div>
                    @else
                    @endif

                    {{-- <p>This is test</p> --}}
                {{-- </div> --}}
            </div>

        </div>
    </div>
</div>
