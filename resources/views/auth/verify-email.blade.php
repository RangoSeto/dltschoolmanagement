{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
 --}}






@include('layouts.adminheader')
<div id="app">

    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-3 bg-white p-4">

            <h6>Email Verification</h6>

            <div class="row">

                <div>
                    <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <small class="mb-4 text-primary text-sm ">
                        A new verification link has been sent to the email address you provided during registration.
                    </small>
                @endif


                <form class="mt-3" method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div class="d-grid">
                        <button type="submit" class="btn btn-info rounded-0">Resend Verification Email</button>
                    </div>
        
                </form>


                <div class="col-12 mt-2 text-center">
                    <small>Don't have action ? </small>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();" class="small" >Sign Out</a>
                    </form>
                </div>

            </div>


        </div>
    </div>

</div>


@include('layouts.adminfooter')

