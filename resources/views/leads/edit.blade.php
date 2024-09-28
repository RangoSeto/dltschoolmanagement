@extends('layouts.adminindex')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="/leads/{{$lead->id}}" method="POST">
    
                @csrf
                @method('PUT')
        
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="firstname">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" placeholder="Enter Firstname name" value="{{$lead->lastname}}">

                    </div>
        
                    <div class="col-md-3 mb-3">
                        <label for="lastname">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" placeholder="Enter Last name" value="{{$lead->lastname}}">
                        
                    </div>
        

                    <div class="col-md-3 form-group mb-3">
                        <label for="gender_id">Gender <span class="text-danger">*</span></label>
                        <select type="text" name="gender_id" id="gender_id" class="form-control form-control-sm rounded-0">
                            <option disabled>Choose a Gender</option>
                            @foreach($genders as $gender)
                                {{-- <option value="{{$gender['id']}}" {{$gender['id'] == $lead->gender->id ? 'selected' : ''}}>{{$gender['name']}}</option> --}}
                                <option value="{{$gender['id']}}" {{$gender['id'] == old('gender_id',$lead->gender->id) ? 'selected' : ''}}>{{$gender['name']}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="age">Age <span class="text-danger">*</span></label>
                        <input type="number" name="age" id="age" class="form-control form-control-sm rounded-0" placeholder="EnterAge" value="{{old('age',$lead->age)}}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" placeholder="Enter Email" value="{{old('email',$lead->email)}}">
                    </div>



                    <div class="col-md-3 form-group mb-3">
                        <label for="country_id">Country <span class="text-danger">*</span></label>
                        <select type="text" name="country_id" id="country_id" class="form-control form-control-sm rounded-0 country_id">
                            <option disabled>Choose a Country</option>
                            @foreach($countries as $country)
                                <option value="{{$country['id']}}" {{$country['id'] == $lead->country_id ? 'selected' : ''}}>{{$country['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label for="city_id">City <span class="text-danger">*</span></label>
                        <select type="text" name="city_id" id="city_id" class="form-control form-control-sm rounded-0 city_id">
                            <option disabled>Choose a City</option>
                            @foreach($cities as $city)
                                <option value="{{$city['id']}}" {{$city['id'] == $lead->city_id ? 'selected' : 'hidden'}}>{{$city['name']}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    @if($lead->isconverted())
                        <small>This lead have already been converted to a studnet. Editing is disabled.</small>
                    @endif
        
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <a href="{{route('leads.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3" {{$lead->isconverted() ? 'disabled' :''}}>Update</button>
                        </div>
                    </div>
        
        
                </div>
        
            </form>

        </div>

    </div>

    <!--End Page Content Area-->

@endsection




@section('scripts')

    <script type="text/javascript">

        $(document).ready(function(){


            // Start Dynamic Select Option 
            $(document).on('change','.country_id',function(){
                                
                                const getcountryid = $(this).val();
                                // console.log(getcountryid);
                
                                let opforcity = "";
                                let opforregion = "";
                
                                    $.ajax({
                                        url:`/api/filter/cities/${getcountryid}`,
                                        type:"GET",
                                        dataType:'json',
                                        success:function(response){
                                            // console.log(response);
                
                                            $('.city_id').empty();
                
                                            opforcity += `<option selected disabled>Choose a city</option>`;
                
                                            for(let x = 0; x < response.data.length; x++){
                                                opforcity += `<option value="${response.data[x].id}">${response.data[x].name}</option>`;
                                            }
                
                                            $('.city_id').append(opforcity);
                                        },
                                        error:function(response){
                                            console.log("Error : ",response);
                                        }
                                    });
                            });
                
                                // End Dynamic Select Option 
                
                

        });

    </script>

@endsection