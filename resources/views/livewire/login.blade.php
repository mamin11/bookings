{{-- @include('layouts.nav') --}}
<div class="login-page-photo" style="background-color: {{ $color ?? '' }}">
    <div class="form-container">
        <div class="image-holder"></div>
        <div id="login-register">
            <form >
                @csrf
                
                <div class="form-group">
                    <a href="/login" class="login-register-links link-active d-inline-block">{{__('Login') }}</a>
                    <a href="/register" class="login-register-links d-inline-block">{{__('Register') }}</a>
                </div>
                <hr>
                    
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
                    <div class="form-check">
                        <label class="form-check-label" for="remember">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>Remember Me.
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary rounded-pill btn-block">{{__('Login') }}</button>
                </div>
                
                @if (Route::has('password.request'))
                <a class="already"href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}</a>
                @endif
            </form>
        </div>
    </div>
</div>
</div>