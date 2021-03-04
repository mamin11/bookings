<div>
    <div class="container  d-flex justify-content-center">
        <div class="col-xl-9">

                <div class="card  shadow ">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                        <div class="col-12">
                            <h1 class="mb-0 text-center">My account</h1>
                        </div>
                        </div>
                    </div>
                
                    <div class="card-body">
                        <form>
                            <div class="pl-lg-4">
                                <div class="row mb-5">
                                    <div class="col-lg-6">
                                        <div class="media align-items-center">
                                            <span class="avatar avatar-sm rounded-circle">
                                                <img alt="Image placeholder" style="width: 20vh; height: 20vh;" class="img-thumbnail avatar avatar-sm rounded-circle" src="{{$image ? $image->temporaryUrl() : ($user->image ? $user->getStaffProfilePic() : asset('img/user-profile.png')) }}">
                                            </span>
                                            <div class="media-body ml-5 d-none d-lg-block">
                                                <input type="file" wire:model="image" class="form-control-file cursor-pointer @error('form.image') is-invalid @enderror" id="image">
                                            </div>
                                        </div>
                                        @error('image')
                                        <span class="error text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            <h4 class="heading-small text-muted mb-4">User information</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                        <label class="form-control-label" for="input-username">Username</label>
                                        <input type="text" id="input-username" wire:model.lazy="form.name" class="form-control form-control-alternative @error('form.name') is-invalid @enderror" placeholder="{{$user ? $user->name : ''}}" value="{{$form['name'] ? $form['name'] : ''}}">
                                        </div>
                                        @error('form.name')
                                            <span class="error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email address</label>
                                        <input type="email" id="input-email"  wire:model.lazy="form.email" class="form-control form-control-alternative @error('form.email') is-invalid @enderror" placeholder="{{$user ? $user->email : ''}}">
                                        </div>
                                        @error('form.email')
                                            <span class="error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                        <label class="form-control-label" for="input-new-password">new password</label>
                                        <input type="text" id="input-new-password"  wire:model.lazy="form.newpassword" class="form-control form-control-alternative @error('form.newpassword') is-invalid @enderror" placeholder="{{$form['newpassword'] ? $form['newpassword'] : ''}}">
                                        </div>
                                        @error('form.newpassword')
                                            <span class="error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                        <label class="form-control-label" for="input-confirm-password">confirm password</label>
                                        <input type="text" id="input-confirm-password"  wire:model.lazy="form.confirmpassword" class="form-control form-control-alternative @error('form.confirmpassword') is-invalid @enderror"  placeholder="{{$form['confirmpassword'] ? $form['confirmpassword'] : ''}}">
                                        </div>
                                        @error('form.confirmpassword')
                                            <span class="error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control @error('form.date_of_birth') is-invalid @enderror" type="date" wire:model.lazy="form.date_of_birth" name="date_of_birth" placeholder="{{  $form['date_of_birth'] ? $form['date_of_birth'] : $user->date_of_birth }}">
                                            </div>
                                        </div>
                                        @error('form.date_of_birth')
                                            <span class="error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- Address -->
                            <h4 class="heading-small text-muted mb-4">Contact information</h4>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group focused">
                                        <label class="form-control-label" for="input-address">Address</label>
                                        <input id="input-address @error('form.address') is-invalid @enderror" type="text" wire:model.lazy="form.address" class="form-control form-control-alternative"  placeholder="{{$address->address ? $address->address : $form['address'] }}" >
                                        </div>
                                        @error('form.address')
                                            <span class="error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                        <label class="form-control-label" for="input-city">City</label>
                                        <input type="text" id="input-city"  wire:model.lazy="form.city" class="form-control form-control-alternative @error('form.city') is-invalid @enderror"  placeholder="{{$form['city'] ? $form['city'] : $address->city}}">
                                        </div>
                                        @error('form.city')
                                            <span class="error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                        <label class="form-control-label" for="input-country">Country</label>
                                        <input type="text" id="input-country"  wire:model.lazy="form.country" class="form-control form-control-alternative @error('form.country') is-invalid @enderror"  placeholder="{{$form['country'] ? $form['country'] : $address->country}}">
                                        </div>
                                        @error('form.country')
                                            <span class="error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                        <label class="form-control-label" for="input-country">Postal code</label>
                                        <input type="text" id="input-postal-code"  wire:model.lazy="form.post_code" class="form-control form-control-alternative @error('form.post_code') is-invalid @enderror" placeholder="{{$form['post_code'] ? $form['post_code'] : $address->post_code}}">
                                        </div>
                                        @error('form.post_code')
                                            <span class="error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <button type="submit" wire:click.prevent="update" class="btn btn-primary rounded-pill btn-block btn-lg">{{__('Update') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    @if($updated)
                        @if($flashMessage['message'] )
                            <p class="text-center alert  @if($flashMessage['class'] == 'success') alert-success @else alert-danger @endif ">{{ $flashMessage['message'] }}</p>
                        @endif
                    @endif


                </div>

        </div>
        </div>
    </div>
    </div>
</div>

</div>
