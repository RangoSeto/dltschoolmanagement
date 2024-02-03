@extends('layouts.adminindex')
@section('caption','Create Role')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="/roles" method="POST" enctype="multipart/form-data">
    
                @csrf
        
                <div class="row">

                    <div class="col-md-4">
                        <label for="image" class="gallery">
                            <span>Choose Images</span>
                        </label>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            
                        <div class="col-md-6 form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" value="{{old('image')}}">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Role name" value="{{old('name')}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="status_id">Status <span class="text-danger">*</span></label>
                            <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                <option disabled selected>Choose Stauts</option>
                                {{-- @foreach($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach --}}
                                @foreach($statuses as $idx=>$name)
                                    <option value="{{$idx}}">{{$name}}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
            
                        <div class="col-md-6 d-flex justify-content-end align-items-end">
                            <div>
                                <a href="{{route('roles.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                            </div>
                        </div>
            
                        </div>
                    </div>

        
                </div>
        
            </form>

        </div>

    </div>

    <!--End Page Content Area-->

@endsection

@section('css')
    <style type="text/css">

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
    </style>
@endsection

@section('scripts')
<script type="text/javascript">
		
    $(document).ready(function(){

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
            }

        };

        $("#image").change(function(){
            previewimages(this,'label.gallery');
        });



    });

</script>
@endsection