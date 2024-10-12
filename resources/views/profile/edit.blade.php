{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}






@extends('layouts.adminindex')
@section('caption','Student Show')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="javascript:void(0);" id="btn-back" class="btn btn-secondary btn-sm rounded-0"> Back</a>
            <a href="{{route('students.index')}}" class="btn btn-secondary btn-sm rounded-0"> Close</a>

            <hr/>

            <div class="row">
                <div class="col-md-4 col-lg-3 mb-2">
                    <h6>Info</h6>
                    <div class="card border-0 rounded-0 shadow">

                        <div class="card-body">

                            <div class="d-flex flex-column align-items-center mb-3">

                                    
                                @if($user->lead['converted'])

                                    <form action="{{route('students.updateprofilepicture',$user->student['id'])}}" method="POST" enctype="multipart/form-data">
                                        @csrf 
                                        @method("PUT")


                                        <div class="form-group col-md-12 text-center">
                                            
                                            <label for="image" class="gallery">
                                                @if($user->student['image'])
                                                    <img src="{{asset($user->student['image'])}}" alt="{[$user->name]}" class="img-thumbnail" width="100" height="100">
                                                @else 
                                                    <span>Choose Images</span>
                                                @endif
                                            </label>
                                            <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" hidden />
                                            <button type="submit" id="uploadbtn" class="btn btn-primary btn-sm text-sm rounded-0">Upload</button>
                                            
                                        </div>


                                    </form>

                                @endif

                                <h6 class="my-1">{{ $userdata->name }}</h6>
                            </div>

                            <div class="w-100 d-flex flex-row justify-content-between mb-3">

                                <button type="button" class="w-100 btn btn-primary btn-sm rounded-0 me-2">Like</button>

                                
                            </div>

                            <div class="mb-5">

                                <div class="row g-0 mb-2">
                                    <div class="col-auto">
                                        <i class="fas fa-exchange-alt"></i>
                                    </div>
                                    <div class="col ps-3">
                                        <div class="row">
                                            <div class="col">
                                               <div>Pipe Status</div> 
                                            </div>
                                            <div class="col-auto">
                                                <div>
                                                    <span class="badge {{ $user->lead['converted'] ? 'bg-success' : 'bg-danger' }}">Pipeline</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($user->lead['converted'])
                                    <div class="row g-0 mb-2">
                                        <div class="col-auto">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="row">
                                                <div class="col">
                                                <div>Account Status</div> 
                                                </div>
                                                <div class="col-auto">
                                                    <div>
                                                        <span class="badge {{ $user->student['status_id'] ? 'bg-success' : 'bg-danger' }}">{{$user->student['status']['name']}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div>


                            <div class="mb-5">
                                <p class="text-small text-muted text-uppercase mb-2">Lead Info</p>
                                

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <div class="col">
                                        <a href="{{route('leads.show',$user->lead['id'])}}">{{$user->lead['leadnumber']}}</a>
                                    </div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-venus"></i>
                                    </div>
                                    <div class="col">{{ $user->lead['gender']['name'] }}</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-flag-checkered"></i>
                                    </div>
                                    <div class="col">{{$user->lead['age']}} years old</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="col">{{ $user->lead['city']['name'] }} | {{ $user->lead['country']['name'] }}</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div class="col">{{ date('d M Y h:i:s A',strtotime($user->lead['created_at'])) }}</div>
                                </div>

                                <div class="row g-0 mb-2">
                                    <div class="col-auto me-2">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="col">{{ date('d M Y h:i:s A',strtotime($user->lead['updated_at'])) }}</div>
                                </div>

                            </div>


                            @if($user->lead['converted'])
                                <div class="mb-5">
                                    <p class="text-small text-muted text-uppercase mb-2">Student Info</p>
                                    

                                    <div class="row g-0 mb-2">
                                        <div class="col-auto me-2">
                                            <i class="fas fa-address-card"></i>
                                        </div>
                                        <div class="col">
                                            <a href="{{route('students.show',$user->student['id'])}}">{{$user->student['regnumber']}}</a>
                                        </div>
                                    </div>

                                    <div class="row g-0 mb-2">
                                        <div class="col-auto me-2">
                                            <i class="fas fa-venus"></i>
                                        </div>
                                        <div class="col">{{ $user->student['gender']['name'] }}</div>
                                    </div>

                                    <div class="row g-0 mb-2">
                                        <div class="col-auto me-2">
                                            <i class="fas fa-flag-checkered"></i>
                                        </div>
                                        <div class="col">{{$user->student['age']}} years old</div>
                                    </div>

                                    <div class="row g-0 mb-2">
                                        <div class="col-auto me-2">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                        <div class="col">{{ $user->student['city']['name'] }} | {{ $user->lead['country']['name'] }}</div>
                                    </div>

                                    <div class="row g-0 mb-2">
                                        <div class="col-auto me-2">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                        <div class="col">{{ date('d M Y h:i:s A',strtotime($user->student['created_at'])) }}</div>
                                    </div>

                                    <div class="row g-0 mb-2">
                                        <div class="col-auto me-2">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="col">{{ date('d M Y h:i:s A',strtotime($user->student['updated_at'])) }}</div>
                                    </div>

                                </div>
                            @endif


                        </div>


                    </div>

                </div>

                <div class="col-md-8 col-lg-9">

                    <h6>Compose</h6>

                    <div class="card border-0 rounded-0 shadow mb-4">
                        <div class="card-body">

                            <div class="accordion">
		
                                <div class="acctitle"> Email</div>
                                <div class="acccontent">
                                    <div class="col-md-12 py-3">
                                        <form action="{{route('students.mailbox')}}" method="POST" >
                                            @csrf
                                            <div class="row">
                                                
                                                <div class="col-md-6 form-group mb-3">
                                                    <input type="email" name="cmpemail" id="cmpemail" class="form-control form-control-sm border-0 rounded:0" placeholder="To:" value="" readonly />
                                                </div>
                                                <div class="col-md-6 form-group mb-3">
                                                    <input type="text" name="cmpsubject" id="cmpsubject" class="form-control form-control-sm border-0 rounded:0" placeholder="Subject:" />
                                                </div>
                                                <div class="col-md-12 form-group mb-3">
                                                    <textarea name="cmpcontent" id="cmpcontent"class="form-control form-control-sm border-0 rounded:0" rows="3" style="resize: none" placeholder="Your message here..."></textarea>
                                                </div>

                                                <div class="col-md-12 d-flex justify-content-end align-items-end">
                                                    <button type="submit" class="btn btn-secondary btn-sm rounded-0">Send</button>
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                        
                            </div>

                        </div>
                    </div>

                    
                    <h6>Enrolls</h6>
                    <div class="card border-0 rounded-0 shadow mb-4">
                        <div class="card-body d-flex flex-wrap gap-3">


                        </div>
                    </div>

                    <h6>Additional Info</h6>
                    <div class="card border-0 rounded-0 shadow mb-4">
                        
                            <ul class="nav">
                                <li class="nav-item">
                                    <button type="button" id="autoclick" class="tablinks" onclick="gettab(event,'personaltab')">Personal</button>
                                </li>
                    
                                <li class="nav-item">
                                    <button type="button" class="tablinks" onclick="gettab(event,'leadtab')">Lead</button>
                                </li>
                    
                                <li class="nav-item">
                                    <button type="button" class="tablinks" onclick="gettab(event,'studenttab')">Student</button>
                                </li>
                    
                                <li class="nav-item">
                                    <button type="button" class="tablinks" onclick="gettab(event,'signtab')">Sign in</button>
                                </li>

                                <li class="nav-item">
                                    <button type="button" class="tablinks" onclick="gettab(event,'linkedtab')">Linked</button>
                                </li>

                                <li class="nav-item">
                                    <button type="button" class="tablinks" onclick="gettab(event,'logtab')">Log</button>
                                </li>
                            </ul>
                    
                            <div class="tab-content">
                                
                                <div id="personaltab" class="tab-panel">
                                    <h3>This is Home Information.</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div>
                    
                                <div id="leadtab" class="tab-panel">
                                    <h3>Lead Information.</h3>
                                   
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
                                                <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" placeholder="Enter Email" value="{{old('email',$lead->email)}}" readonly />
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
                                                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3" {{$lead->isconverted() ? 'disabled' :''}}>Update</button>
                                                </div>
                                            </div>
                                
                                
                                        </div>
                                
                                    </form>


                                </div>
                    
                                <div id="studenttab" class="tab-panel">
                                    <h3>Student Information.</h3>
                                                            
                                    @if($user->lead['converted'])
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
                                                    <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" placeholder="Enter Email" value="{{old('email',$student->email)}}" readonly>
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
                                    @else 
                                        <p>No Data</p>
                                    @endif

                                </div>

                                <div id="signtab" class="tab-panel">
                                    <h6>Sign-In pasword</h6>

                                    <div class="col-md-4 mx-auto">
                                    <form action="{{ route('password.update') }}" method="POST" class="mt-3">
                    
                                        @csrf
                                        @method('PUT')


                                        <div class="form-group mb-3">
                                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder=" Old Password" autofocus value="{{old('current_password')}}" />
                                            @error('current_password')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    <div class="form-group mb-3">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" autofocus value="{{old('password')}}" />
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
                                    
                        
                        
                                        <div class="float-end mb-3">
                                            <button type="submit" class="btn btn-info btn-sm rounded-0">Save Change</button>
                                        </div>
                        
                                    </form>
                                </div>
                                </div>

                                <div id="linkedtab" class="tab-panel">
                                    <h6>Linked App</h6>
                                    <p>Github</p>


                                    <div class="card rounded-0">
                                        

                                        <div id="displayone" class="card-body">
                                            <!-- <img src="https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG.png" class="rounded-circle" alt="userimg" />
                                            <h3 class="card-title">User Name</h3>
                                            <p class="card-subtitle">Hello World</p>
                                            <ul class="list-group">
                                                <li class="list-group-item">Repositories : <span class="fw-bold">100</span></li>
                                                <li class="list-group-item">Followers : <span class="fw-bold">200</span></li>
                                                <li class="list-group-item">Following : <span class="fw-bold">300</span></li>
                                            </ul> -->
                                        </div>

                                        <div id="displaytwo" class="card-footer">
                                            <div class="dropdown float-end">

                                                <a href="javascript:void(0);" class="btn btn-success btn-sm rounded-0 dropdown-toggle" data-bs-toggle="dropdown">Repositories Links</a>

                                                <ul id="displaylistgroup" class="dropdown-menu">
                                                    <!-- <li><a href="#" target="_blank" class="dropdown-item">Sample Link</a></li> -->
                                                </ul>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                
                    
                                <div id="remark" class="tab-panel">
                                    <p></p>
                                </div>
                    
                            </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    <!--End Page Content Area-->

@endsection


@section('css')
<style type="text/css">

/* Start Accordion*/

.accordion{
	width: 100%;
}

.acctitle{
	font-size: 13px;
	user-select: none;

	padding: 5px;
	margin: 0;

	cursor: pointer;
    transition: background-color .2s ease-in;

	position: relative;
}


.acctitle::after{
	content: '\f0e0'; /*+*/
	font-family: "Font Awesome 5 Free";

	/*position: absolute;
	right: 15px;
	top: 50%;
	transform: translateY(-50%);*/

	float: right;
}

.shown.acctitle::after{
	content: '\f2b6';
}

/* .active::after{
	content: '\f2b6';
} */

.acccontent{
	height: 0;
	background-color: #f4f4f4;
	text-align: justify;
	font-size: 14px;

	padding: 0 10px;

	overflow: hidden;

	transition: height 0.3s ease-in-out;

}

/* End Accordion */

/* Start Tab Box  */

.nav{
	display: flex;

	padding: 0;
	margin: 0;
}

.nav .nav-item{
	list-style-type: none;
}

.nav .tablinks{
	border: none;
	padding: 15px 20px;
	cursor: pointer;

	transition: background-color .3s ease-in;
}
.nav .tablinks:hover{
	background-color: #f3f3f3;
}

.nav .tablinks.active{
	color: blue;
}

.tab-panel{
	padding: 5px 15px;
	display: none;
}

/* End Tab Box  */


/* Start Profile Image  */

.gallery{
			width: 100%;
            height: 100%;
			background-color: #eee;
			color: #aaa;

            display: flex;
            justify-content: center;
            align-items: center;

			text-align: center;
			padding: 10px;
		}

		.gallery.removetxt span{
			display: none;
		}

		.gallery img{
			width: 100px;
			height: 100px;
			border: 2px dashed #aaa;
			border-radius: 10px;
			object-fit: cover;

			padding: 5px;
			margin: 0 5px;
		}

        #uploadbtn{
            display: none;
        }
/* End Profile Image  */


</style>
@endsection


@section('scripts')

<script type="text/javascript">


    // Start Back Btn
        const getbtnback = document.getElementById('btn-back');
        getbtnback.addEventListener('click',function(){
            // window.history.back();
            window.history.go(-1);
        });
    // End Back Btn

    // Start Tab Box
    
    var gettablinks = document.getElementsByClassName('tablinks'); //HTML Collection
    var gettabpanes = document.getElementsByClassName('tab-panel');

    var tabpanes = Array.from(gettabpanes);

    function gettab(evn,linkid){

        // console.log(evn.target);
        // console.log(linkid);

        tabpanes.forEach(function(tabpane){
            tabpane.style.display = "none";
        });

        for(var x=0; x < gettablinks.length; x++){

            gettablinks[x].className = gettablinks[x].className.replace(" active","");

        }




        document.getElementById(linkid).style.display = "block";

        // evn.target.className += " active";
        // evn.target.className = evn.target.className.replace("tablinks","tablinks active");
        // evn.target.classList.add('active');

        // console.log(evn);
        // console.log(evn.target);
        // console.log(evn.currentTarget);
        evn.currentTarget.className += " active";
    }

    document.getElementById('autoclick').click();

    // End Tab Box


    // Start Accordion

    var getacctitles = document.getElementsByClassName("acctitle");
    // console.log(getacctitles); //HTML Collection
    var getacccontents = document.querySelectorAll(".acccontent");
    // console.log(getacccontent); // Node List

    for(var x = 0; x < getacctitles.length; x++){
        // console.log(x);

        getacctitles[x].addEventListener('click', function(e){
            // console.log(e.target);
            // console.log(this);

            this.classList.toggle("shown");
            var getcontent = this.nextElementSibling;
            // console.log(getcontent);

            // getcontent = 0;
            // if(this.attr(id) = 0){
            // 	...
            // }else if....

            if(getcontent.style.height){
                getcontent.style.height=null; //beware can't set 0

            }else{
                // console.log(getcontent.scrollHeight);
                getcontent.style.height=getcontent.scrollHeight+"px";
            }
        });

        if(getacctitles[x].classList.contains("shown")){
            getacccontents[x].style.height = getacccontents[x].scrollHeight+"px";
        }
    }

    // End Accordion



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



            // Start Single Image Preview 
            var previewimages = function(input,output){

            console.log(input.files);


            if(input.files){
                var totalfiles = input.files.length;
                // console.log(totalfiles); img နဲ့ပက်သက်တဲ့ info တွေသိချင်ရင်

                if(totalfiles > 0){
                    $(".gallery").addClass("removetxt");
                }else{
                    $(".gallery").removeClass("removetxt");
                }

                for(var i=0; i < totalfiles ; i++){
                    var filereader = new FileReader();
                    filereader.readAsDataURL(input.files[i]);

                    filereader.onload = function(e){
                        $(output).html('');
                        $($.parseHTML("<img>")).attr("src",e.target.result).appendTo(output);
                    }

                }

                $("#uploadbtn").show();
            }

            };

            $("#image").change(function(){
            previewimages(this,'label.gallery');
            });
            // End Single Image Preview 

        

    });



    // Start Github User

    const getdisplayone = document.getElementById('displayone');
    const getdisplaytwo = document.getElementById('displaytwo');
    const getdisplaylistgroup = document.getElementById('displaylistgroup');

    const baseurl = `https://api.github.com`;

    emailtouser("hsuphyowai.mtla@gmail.com");

        function emailtouser(email){
            axios({
                method:"GET",
                url:`${baseurl}/search/commits?q=author-email:${email}`
            }).then((response)=>{
                console.log(response);

                const datas = response.data.items;

                if(datas.length > 0){
                    const username = datas[0].author.login;
                    // console.log(username);
                    getresult(username);
                }else{
                    getdisplayone.innerHTML = `<div class="alert alert-danger text-center">No data found for this email!</div>`;
                }
            });
        }

        function getresult(username){
            
            axios({
                method:'GET',
                url:`${baseurl}/users/${username}`
            }).then((response)=>{
                // console.log(response);
                // console.log(typeof response);

                const {data} = response;
                // console.log(data);

                cardbodytodom(data);
                resultrepos(username);

            }).catch((err)=>{
                // console.log(err);

                if(err.response.status === 404){
                    getdisplayone.innerHTML = `
                        <div class="alert alert-danger text-center">No Data Found !!!</div>
                    `;
                    getdisplaylistgroup.innerHTML = `<li><a href="javascript:void(0);" target="_blank" class="dropdown-item">No Data</a></li>`;
                }

            });
        }


        function cardbodytodom(user){

            // console.log(user);

            getdisplayone.innerHTML = `<div>
                    <img src="${user.avatar_url}" style="width:100px" class="rounded-circle" alt="userimg" />
                    <h3 class="card-title">${user.name}</h3>
                    <p class="card-subtitle">${user.bio}</p>
                    <ul class="list-group">
                        <li class="list-group-item">Repositories : <span class="fw-bold">${user.public_repos}</span></li>
                        <li class="list-group-item">Followers : <span class="fw-bold">${user.followers}</span></li>
                        <li class="list-group-item">Following : <span class="fw-bold">${user.following}</span></li>
                    </ul>
                </div>`;

        }


        function resultrepos(username){

            $.ajax({
                method:"GET",
                url:`${baseurl}/users/${username}/repos`,
                dataType:'json'
            }).done((data)=>{
                // console.log(data);

                cardfootertodom(data);
            }).fail(()=>{
                console.log('error');
            });

        }


        function cardfootertodom(repositories){

            // console.log(repositories);

            getdisplaylistgroup.innerHTML = '';

            repositories.forEach(repository=>{
                // console.log(repository);

                getdisplaylistgroup.innerHTML += `<li><a href="${repository.html_url}" target="_blank" class="dropdown-item">${repository.name}</a></li>`;
            });
        }
    // End Github user


</script>

@endsection
