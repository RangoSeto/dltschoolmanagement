@include('layouts.auth.authheader')

<div id="app">

    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="bg-white p-4">

            <h5>@yield('caption')</h5>

            @yield('content')

            {{-- bootstrap loader --}}
            <div class="d-flex justify-content-center mt-3">
                <div id="loader" class="spinner-border spinner-border-sm d-none" role="status"></div>
            </div>
            

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

@include('layouts.auth.authfooter')
