@extends('layouts.adminindex')
@section('caption','Create Student')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="/students/{{$student->id}}" method="POST">
    
                @csrf
                @method('PUT')
        
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="firstname">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" placeholder="Enter Firstname name" value="{{$student->firstname}}">
                        @error('firstname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="col-md-3 mb-3">
                        <label for="lastname">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" placeholder="Enter Last name" value="{{$student->lastname}}">
                        @error('lastname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-3 form-group mb-3">
                        <label for="gender_id">Gender <span class="text-danger">*</span></label>
                        <select type="text" name="gender_id" id="gender_id" class="form-control form-control-sm rounded-0">
                            <option disabled>Choose a Gender</option>
                            @foreach($genders as $gender)
                                {{-- <option value="{{$gender['id']}}" {{$gender['id'] == $student->gender->id ? 'selected' : ''}}>{{$gender['name']}}</option> --}}
                                <option value="{{$gender['id']}}" {{$gender['id'] == old('gender_id',$student->gender->id) ? 'selected' : ''}}>{{$gender['name']}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="age">Age <span class="text-danger">*</span></label>
                        <input type="number" name="age" id="age" class="form-control form-control-sm rounded-0" placeholder="EnterAge" value="{{old('age',$student->age)}}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" placeholder="Enter Email" value="{{old('email',$student->email)}}">
                    </div>



                    <div class="col-md-3 form-group mb-3">
                        <label for="country_id">Country <span class="text-danger">*</span></label>
                        <select type="text" name="country_id" id="country_id" class="form-control form-control-sm rounded-0 country_id">
                            <option disabled>Choose a Country</option>
                            @foreach($countries as $country)
                                <option value="{{$country['id']}}" {{$country['id'] == $student->country_id ? 'selected' : ''}}>{{$country['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label for="city_id">City <span class="text-danger">*</span></label>
                        <select type="text" name="city_id" id="city_id" class="form-control form-control-sm rounded-0 city_id">
                            <option disabled>Choose a City</option>
                            @foreach($cities as $city)
                                <option value="{{$city['id']}}" {{$city['id'] == $student->city_id ? 'selected' : 'hidden'}}>{{$city['name']}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div id="multiphone" class="col-md-3 mb-3 editpage">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        @foreach ($studentphones as $studentphone)
                            <input type="text" name="studentphoneid[]" id="studentphoneid" value="{{$studentphone->id}}" hidden />

                            <div class="input-group phonelimit">
                                <input type="text" name="phone[]" id="phone" class="form-control form-control-sm rounded-0 phone" placeholder="Enter Mobile Number" value="{{$studentphone->phone}}">
                                
                                @if($studentphones->count() > 1)
                                    <a href="{{route('studentphones.delete',$studentphone->id)}}" class="input-group-text">
                                        <span class="removephone" style="font-size: 10px; cursor:pointer;color:red;"><i class="fas fa-minus-circle"></i></span>
                                    </a>
                                @endif

                                <span id="addphone" class="input-group-text" style="font-size: 10px; cursor:pointer;"><i class="fas fa-plus-circle"></i></span>


                            </div>
                        @endforeach
                        
                    </div>
        
                    <div class="col-md-12 form-group mb-3">
                        <label for="remark">Remark</label>
                        <textarea name="remark" id="remark" class="form-control rounded-0" rows="5" placeholder="Enter Remark">{{$student->remark}}</textarea>
                    </div>
        
        
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <a href="{{route('students.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Update</button>
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
                

            // Start Add / Remove Phone for (createpage/editpage)
                // Note :: do not forget to put multiphone / createpage or editpage / phone

                $(document).on('click','#addphone',function(){
                    addnewinput();
                });

                function addnewinput(){
                    const maxnumber = 3;
                    let getphonelimit = $(".phonelimit").length;
                    let newinput;

                    if(getphonelimit < maxnumber){

                        if($('#multiphone').hasClass('createpage')){

                            newinput = `<div class="input-group phonelimit">
                                <input type="text" name="phone[]" id="phone" class="form-control form-control-sm rounded-0 phone" placeholder="Enter Mobile Number">
                                <span id="removephone" class="input-group-text" style="font-size: 10px; cursor:pointer;color:red;"><i class="fas fa-minus-circle"></i></span>
                            </div>`;

                            $('#multiphone').append(newinput);
                        }else if($('#multiphone').hasClass('editpage')){
                            
                            newinput = `<div class="input-group phonelimit">
                                <input type="text" name="newphone[]" id="newphone" class="form-control form-control-sm rounded-0 phone" placeholder="Enter Mobile Number">
                                <span class="input-group-text removephone" style="font-size: 10px; cursor:pointer;color:red;"><i class="fas fa-minus-circle"></i></span>
                            </div>`;

                            $('#multiphone').append(newinput);

                        }

                    }
                }

                // remove ui for new input
                $(document).on('click','.removephone',function(){
                    $(this).parent().remove();
                });

            // End Add / Remove Phone for (createpage/editpage)




        });

    </script>

@endsection