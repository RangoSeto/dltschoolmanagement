
@extends('layouts.auth.authindex')
@section('caption','Contact Info')
@section('content')

            <form id="stepform" action="{{route('register.storestep3')}}" method="POST" class="mt-3">

                @csrf 

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
                    <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Next</button>
                </div>

            </form>



@endsection

