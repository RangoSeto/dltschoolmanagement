{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}





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

            <form action="{{route('register')}}" method="POST" class="mt-3">

                @csrf 

                <div class="form-group mb-3">
                    <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" placeholder="First Name" autofocus value="{{old('firstname')}}" />
                    {{-- @error('firstname')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror --}}
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="Last Name" autofocus value="{{old('lastname')}}" />
                    {{-- @error('firstname')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror --}}
                </div>

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

                <div class="form-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" value="{{old('password_confirmation')}}" />
                    {{-- @error('password_confirmation')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror --}}
                </div>


                <div class="form-group mb-3">
                    <label for="gender_id">Gender <span class="text-danger">*</span></label>
                    <select type="text" name="gender_id" id="gender_id" class="form-control form-control-sm rounded-0">
                        <option selected disabled>Choose a Gender</option>
                        @foreach($genders as $gender)
                            <option value="{{$gender['id']}}">{{$gender['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="age">Age <span class="text-danger">*</span></label>
                    <input type="number" name="age" id="age" class="form-control form-control-sm rounded-0" placeholder="EnterAge" value="{{old('age')}}">
                </div>


                <div class="form-group mb-3">
                    <label for="country_id">Country <span class="text-danger">*</span></label>
                    <select type="text" name="country_id" id="country_id" class="form-control form-control-sm rounded-0 country_id">
                        <option selected disabled>Choose a Country</option>
                        @foreach($countries as $country)
                            <option value="{{$country['id']}}">{{$country['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="city_id">City <span class="text-danger">*</span></label>
                    <select type="text" name="city_id" id="city_id" class="form-control form-control-sm rounded-0 city_id">
                        <option selected disabled>Choose a City</option>
                        {{-- @foreach($cities as $city)
                        <option value="{{$city['id']}}">{{$city['name']}}</option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info rounded-0">Sign Up</button>
                </div>

            </form>

            {{-- social Login  --}}
            <div class="row">
                <small class="text-center text-muted mt-3">Sign up with</small>
                <div class="col-12 mt-2 text-center">
                    
                    <a href="javascript:void(0);" class="btn" title="Login with Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Google"><i class="fab fa-google"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Github"><i class="fab fa-github"></i></a>

                </div>
            </div>

            {{-- login  --}}
            <div class="row">
                <div class="col-12 mt-2 text-center">
                    <small>Already have an account ? <a href="{{route('login')}}" class="text-primary ms-1" >Sign In</a></small>
                </div>
            </div>

            {{-- data policy  --}}
            <div class="row">
                <div class="col-12 mt-2 text-center text-muted">
                    <small class="">By clicking Sign Up, you agree to our <a href="javascript:void(0);"  class="fw-bold">Terms</a>,<a href="javascript:void(0);"  class="fw-bold">Data Policy</a> and <a href="javascript:void(0);"  class="fw-bold">Cookie Policy</a>, You may receive SMS notification from us.</small>
                </div>
            </div>

        </div>
    </div>

</div>






@include('layouts.adminfooter')

