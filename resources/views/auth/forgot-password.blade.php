{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

 --}}










@include('layouts.auth.authheader')


<div id="app">

    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-3 bg-white p-4">

            <h6>Forgot Password!</h6>




            <div class="row">

                <div>
                    <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

                </div>

                @if (session('status'))
                    <small class="mb-4 text-primary text-sm ">
                        A new verification link has been sent to the email address you provided during registration.
                    </small>
                @endif


                <form action="{{ route('password.email') }}" method="POST" class="mt-3">

                    @csrf 
    
                    <div class="form-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your Email" autofocus value="{{old('email')}}" />
                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
    
    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-info rounded-0">Email Password Reset Link</button>
                    </div>
    
                </form>


            </div>





            

        </div>
    </div>

</div>

@include('layouts.auth.authfooter')
