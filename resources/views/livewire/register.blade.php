{{-- @include('layouts.nav') --}}
<div class="login-page-photo" style="background-color: {{ $color ?? '' }}">
    <div class="form-container">
        <div class="image-holder"></div>
        <div id="login-register">
            <form >
                @csrf
                
                <div class="form-group">
                    <a href="/login" class="login-register-links d-inline-block">{{__('Login') }}</a>
                    <a href="/register" class="login-register-links link-active d-inline-block">{{__('Register') }}</a>
                </div>
                <hr>

                <div class="form-group">
                    <input class="form-control @error('name') is-invalid @enderror" type="text"  name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                    
                <div class="form-group">
                    <input class="form-control @error('email') is-invalid @enderror" type="email"  name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required autocomplete="current-password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label" for="agree-terms">
                            By registering you agree to <span>Terms and Conditions </span> and <span>Privacy Policy</span>. 
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary rounded-pill btn-block">{{__('Register') }}</button>
                </div>
                
                <a class="already" href="/login">
                    {{ __('Have an account? Login here') }}
                </a>
            </form>
        </div>
    </div>
</div>
</div>