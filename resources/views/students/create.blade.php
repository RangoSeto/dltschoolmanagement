@extends('layouts.adminindex')
@section('caption','Create Student')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="/students" method="POST">
    
                @csrf
        
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="firstname">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" placeholder="Enter Firstname name" value="{{old('firstname')}}">
                        @error('firstname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="col-md-3 mb-3">
                        <label for="lastname">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" placeholder="Enter Last name" value="{{old('lastname')}}">
                        @error('lastname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div id="multiphone" class="col-md-3 mb-3 createpage">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <div class="input-group phonelimit">
                            <input type="text" name="phone[]" id="phone" class="form-control form-control-sm rounded-0 phone" placeholder="Enter Mobile Number" value="{{old('phone')}}">
                            <span id="addphone" class="input-group-text" style="font-size: 10px; cursor:pointer;"><i class="fas fa-plus-circle"></i></span>
                        </div>
                        
                    </div>
        
                    {{-- <div class="col-md-4 form-group mb-3">
                        <label for="regnumber">Register Number <span class="text-danger">*</span></label>
                        <input type="text" name="regnumber" id="regnumber" class="form-control form-control-sm rounded-0" placeholder="Enter Reg Number" value="{{old('regnumber')}}"/>
                        @error('regnumber')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
        
                    <div class="col-md-12 form-group mb-3">
                        <label for="remark">Remark</label>
                        <textarea name="remark" id="remark" class="form-control rounded-0" rows="5" placeholder="Enter Remark">{{old('remark')}}</textarea>
                    </div>
        
        
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <a href="{{route('students.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
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
                                <input type="text" name="phone[]" id="phone" class="form-control form-control-sm rounded-0 phone" placeholder="Enter Mobile Number" value="{{old('phone')}}">
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

        })

    </script>

@endsection