{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}



@include('layouts.adminheader')
<div id="app">

    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="bg-white p-4">

            <h5>Sign In</h5>

            <form action="{{route('login')}}" method="POST" class="mt-3">

                @csrf 

                <div class="form-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Username" autofocus value="{{old('email')}}" />
                    {{-- @error('email')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror --}}
                </div>

                <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{old('password')}}" />
                    {{-- @error('password')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror --}}
                </div>

                <div class="form-group">
                    <div class="d-flex">

                        <div class="form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input" {{old('remember') ? 'checked' : ''}} />
                            <label for="remember">Remember Me</label>
                        </div>

                        <div class="ms-auto">
                            <a href="{{ route('password.request') }}"><i class="fas fa-lock me-1"></i>Forgot Password</a>
                        </div>

                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info rounded-0">Log In</button>
                </div>

            </form>

            {{-- social Login  --}}
            <div class="row">
                <small class="text-center text-muted mt-3">Sign In with</small>
                <div class="col-12 mt-2 text-center">
                    
                    <a href="javascript:void(0);" class="btn" title="Login with Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Google"><i class="fab fa-google"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Github"><i class="fab fa-github"></i></a>

                </div>
            </div>

            {{-- register  --}}
            <div class="row">
                <div class="col-12 mt-2 text-center">
                    <small>Don't have an account ? <a href="{{route('register')}}" class="text-primary ms-1" >Sign Up</a></small>
                </div>
            </div>

        </div>
    </div>

</div>
@include('layouts.adminfooter')
