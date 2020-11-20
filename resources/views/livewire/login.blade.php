{{-- @include('layouts.nav') --}}
<div class="login-page-photo" style="background-color: {{ $color ?? '' }}">
    <div class="form-container">
        <div class="image-holder"></div>
        <div id="login-register">
            <form >
                @csrf
                
                <div class="form-group">
                    <a wire:click.prevent="toggleLogin" class="login-register-links cursor-pointer @if($login_active) link-active @endif d-inline-block">Login</a>
                    <a wire:click.prevent="toggleRegister" class="login-register-links cursor-pointer @if($register_active ) link-active @endif d-inline-block">Register</a>
                </div>
                <hr>
                    
                @if(session()->has('message'))
                <p class="alert {{ session()->get('alert-class', 'message') }}">{{ session()->get('message') }}</p>
                @endif

                {{-- ************ start login component ************* --}}
                @if ($login_active)
                    <div class="form-group">


                        <input class="form-control @error('login_form.email') is-invalid @enderror" type="email" wire:model.lazy="login_form.email"  name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        
                        @error('login_form.email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input class="form-control @error('login_form.password') is-invalid @enderror" type="password" wire:model.lazy="login_form.password" name="password" placeholder="Password" required autocomplete="current-password">
                        
                        @error('login_form.password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label" for="remember">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>Remember Me.
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" wire:click.prevent="login" class="btn btn-primary rounded-pill btn-block">{{__('Login') }}</button>
                    </div>
                    
                        @if (Route::has('password.request'))
                        <a class="already"href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}</a>
                        @endif

                    {{-- ************ end login component ************* --}}


                    {{-- ************ start register component ************* --}}

                    @elseif($register_active)
                            <div class="form-group">
                                <input class="form-control @error('register_form.name') is-invalid @enderror" type="text" wire:model.lazy="register_form.name" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                
                                @error('register_form.name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                                
                            <div class="form-group">
                                <input class="form-control @error('register_form.email') is-invalid @enderror" type="email" wire:model.lazy="register_form.email"  name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                
                                @error('register_form.email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
            
                            <div class="form-group">
                                <input class="form-control @error('register_form.password') is-invalid @enderror" type="password" wire:model.lazy="register_form.password" name="password" placeholder="Password" required autocomplete="current-password">
                                
                                @error('register_form.password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <input class="form-control @error('password') is-invalid @enderror" type="password" wire:model.lazy="register_form.password_confirmation" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                            
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label" for="agree-terms">
                                        By registering you agree to <span>Terms and Conditions </span> and <span>Privacy Policy</span>. 
                                    </label>
                                </div>
                            </div>
            
                            <div class="form-group">
                                <button type="submit" wire:click.prevent="register" class="btn btn-primary rounded-pill btn-block">{{__('Register') }}</button>
                            </div>
                            
                            <a class="already cursor-pointer" wire:click.prevent="toggleLogin">
                                {{ __('Have an account? Login here') }}
                            </a>
                        @endif

                    {{-- ************ end register component ************* --}}

                    
            </form>
        </div>
    </div>
</div>
</div>

