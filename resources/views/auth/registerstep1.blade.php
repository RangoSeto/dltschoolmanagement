
@extends('layouts.auth.authindex')
@section('caption','Access')
@section('content')


            <form id="stepform" action="{{route('register.storestep1')}}" method="POST" class="mt-3">

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

                <div class="form-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" value="{{old('password_confirmation')}}" />
                    {{-- @error('password_confirmation')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror --}}
                </div>


                <div class="d-grid">
                    <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Next</button>
                </div>

            </form>



@endsection

