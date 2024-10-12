{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
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
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

 --}}







 @include('layouts.auth.authheader')


 <div id="app">
 
     <div class="vh-100 d-flex justify-content-center align-items-center">
         <div class="col-3 bg-white p-4">
 
             <h6>New Password!</h6>
 

             <div class="row">
 
                 <form action="{{ route('password.store') }}" method="POST" class="mt-3">
 
                     @csrf 


                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

     
                     <div class="form-group mb-3">
                         <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" autofocus value="{{old('email')}}" />
                         @error('email')
                             <span class="invalid-feedback">
                                 <strong>{{$message}}</strong>
                             </span>
                         @enderror
                     </div>

                     <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autofocus value="{{old('password')}}" />
                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" placeholder="Confirm password" autofocus value="{{old('password_confirmation')}}" />
                        @error('password_confirmation')
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