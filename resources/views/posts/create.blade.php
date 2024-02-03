@extends('layouts.adminindex')
@section('caption','Create Post')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <form action="/posts" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-4">

                        <div class="row">

                            <div class="col-md-12 form-group mb-3">
                                <label for="image" class="gallery">
                                    <span>Choose Images</span>
                                </label>
                                <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" value="{{old('image')}}" hidden>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="startdate">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="startdate" id="startdate" class="form-control form-control-sm rounded-0" value="{{old('startdate')}}">
                                @error('startdate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="enddate">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="enddate" id="enddate" class="form-control form-control-sm rounded-0" value="{{old('enddate')}}">
                                @error('enddate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="starttime">Start Time <span class="text-danger">*</span></label>
                                <input type="time" name="starttime" id="starttime" class="form-control form-control-sm rounded-0" value="{{old('starttime')}}">
                                @error('starttime')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="endtime">End Date <span class="text-danger">*</span></label>
                                <input type="time" name="endtime" id="endtime" class="form-control form-control-sm rounded-0" value="{{old('endtime')}}">
                                @error('endtime')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Days</label>
                                <div class="d-flex flex-wrap">
                                    @foreach($days as $idx=>$day)
                                    <div class="form-check form-switch mx-3">
                                        <input type="checkbox" name="day_id[]" id="day_id{{$idx}}" class="form-check-input" value="{{$day->id}}" checked /> <label for="day_id{{$idx}}">{{$day->name}}</label>
                                    </div>
                                    @endforeach
                                </div>

                                {{-- start hidden field  --}}
                                <input type="hidden" name="dayable_type" id="dayable_type" value="App\Models\Post" />
                                {{-- end hidden field  --}}

                            </div>

                        </div>

                    </div>

                    <div class="col-md-8">
                        <div class="row">

                        <div class="col-md-12 form-group mb-3">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Post Title" value="{{old('title')}}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-6 form-group">
                            <label for="type_id">Type <span class="text-danger">*</span></label>
                            <select name="type_id" id="type_id" class="form-control form-control-sm rounded-0">
                                @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="fee">Fee <span class="text-danger">*</span></label>
                            <input type="number" name="fee" id="fee" class="form-control form-control-sm rounded-0" placeholder="Class Fee" value="{{old('fee')}}">
                            @error('fee')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label for="content">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" class="form-control form-control-sm rounded-0" rows="5" placeholder="Say Something">{{old('content')}}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 form-group mb-3">
                            <label for="tag_id">Tags <span class="text-danger">*</span></label>
                            <select name="tag_id" id="tag_id" class="form-control form-control-sm rounded-0">
                                @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 form-group mb-3">
                            <label for="attshow">Show On Att Form <span class="text-danger">*</span></label>
                            <select name="attshow" id="attshow" class="form-control form-control-sm rounded-0">
                                @foreach($attshows as $attshow)
                                <option value="{{$attshow->id}}">{{$attshow->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 form-group mb-3">
                            <label for="status_id">Status <span class="text-danger">*</span></label>
                            <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 d-flex justify-content-end align-items-end">
                            <a href="{{route('posts.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
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

    {{-- summernote css1 js1 --}}
    <link href="{{asset('assets/libs/summernote-0.8.18-dist/summernote-lite.min.css')}}" rel="stylesheet" />

    <style type="text/css">

		.gallery{
			width: 100%;
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

{{-- summernote css1 js1  --}}
<script src="{{asset('assets/libs/summernote-0.8.18-dist/summernote-lite.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    // Start Single Image preview
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

        // End Single Image preview


        // Start text editor for summernote 
        $('#content').summernote({
            placeholder: 'Say Something',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
            ]
        });
        // End text editor for summernote 




    });

</script>
@endsection
