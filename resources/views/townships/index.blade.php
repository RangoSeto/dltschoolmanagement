@extends('layouts.adminindex')
@section('caption','Country List')
@section('content')


    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
            <form action="{{route('townships.store')}}" method="POST">
    
                {{ csrf_field() }}
        
                <div class="row align-items-end">

                    <div class="col-md-2 form-group mb-3">
                        <label for="country_id">Country <span class="text-danger">*</span></label>
                        <select type="text" name="country_id" id="country_id" class="form-control form-control-sm rounded-0 country_id">
                            <option selected disabled>Choose a Country</option>
                            @foreach($countries as $country)
                            <option value="{{$country['id']}}">{{$country['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 form-group mb-3">
                        <label for="city_id">City <span class="text-danger">*</span></label>
                        <select type="text" name="city_id" id="city_id" class="form-control form-control-sm rounded-0 city_id">
                            <option selected disabled>Choose a City</option>
                            {{-- @foreach($cities as $city)
                            <option value="{{$city['id']}}">{{$city['name']}}</option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="col-md-2 form-group mb-3">
                        <label for="region_id">Region <span class="text-danger">*</span></label>
                        <select type="text" name="region_id" id="region_id" class="form-control form-control-sm rounded-0 region_id">
                            {{-- @foreach($regions as $region)
                            <option value="{{$region['id']}}">{{$region['name']}}</option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="col-md-2 form-group mb-3">
                        <label for="name">Township Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
                    </div>

                    <div class="col-md-2 form-group mb-3">
                        <label for="status_id">Status <span class="text-danger">*</span></label>
                        <select type="text" name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                            @foreach($statuses as $status)
                            <option value="{{$status['id']}}">{{$status['name']}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="col-md-2 text-sm-end text-md-start mb-3">
                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                    </div>
        
        
                </div>
        
            </form>
        </div>

        <hr/>

        <div class="col-md-12">
            
            <div>
                <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
            </div>

            <div>
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-md-2 col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search..." />
                                <button type="submit" id="btn-search" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-12">

            <table id="mydata" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Region</th>
                        <th>Status</th>
                        <th>By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($townships as $idx=>$township)
                    <tr id="delete_{{$township->id}}">
                        <td>
                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$township->id}}" />
                        </td>
                        {{-- <td>{{++$idx}}</td> --}}
                        <td>{{$idx+ $townships->firstItem()}}</td>
                        <td>{{$township->name}}</td>
                        <td>{{$township->country['name']}}</td>
                        <td>{{$township->city['name']}}</td>
                        <td>{{$township->region['name']}}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input change-btn" {{ $township->status_id === 3 ? 'checked' : '' }} data-id="{{$township->id}}" />
                            </div>
                        </td>
                    
                        <td>{{$township->user['name']}}</td>
                        <td>{{$township->created_at->format('d M Y')}}</td>
                        <td>{{$township->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="{{route('townships.edit',$township->id)}}" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$township->id}}" data-country_id="{{$township->country_id}}" data-city_id="{{$township->city_id}}" data-region_id="{{$township->region_id}}" data-name="{{$township->name}}" data-status="{{$township->status_id}}"><i class="fas fa-pen"></i></a>
                            <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <form id="formdelete-{{$idx}}" action="{{route('townships.destroy',$township->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $townships->links('pagination::bootstrap-4') }}

        </div>

    </div>

    <!--End Page Content Area-->


    {{-- START MODAL AREA --}}
        {{-- start edit model  --}}
            <div id="editmodal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h6 class="modal-title">Edit Form</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <form id="formaction" action="" method="POST">
    
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                        
                                <div class="row align-items-end">

                                    <div class="col-md-4 form-group mb-3">
                                        <label for="editcountry_id">Country <span class="text-danger">*</span></label>
                                        <select type="text" name="editcountry_id" id="editcountry_id" class="form-control form-control-sm rounded-0 couontry_id">
                                            @foreach($countries as $country)
                                            <option value="{{$country['id']}}">{{$country['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group mb-3">
                                        <label for="editcity_id">City <span class="text-danger">*</span></label>
                                        <select type="text" name="editcity_id" id="editcity_id" class="form-control form-control-sm rounded-0 city_id">
                                            {{-- @foreach($cities as $city)
                                            <option value="{{$city['id']}}">{{$city['name']}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group mb-3">
                                        <label for="editregion_id">Region <span class="text-danger">*</span></label>
                                        <select type="text" name="editregion_id" id="editregion_id" class="form-control form-control-sm rounded-0 region_id">
                                            {{-- @foreach($regions as $region)
                                            <option value="{{$region['id']}}">{{$region['name']}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="editname">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="editname" id="editname" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="editstatus_id">Status <span class="text-danger">*</span></label>
                                        <select type="text" name="editstatus_id" id="editstatus_id" class="form-control form-control-sm rounded-0">
                                            @foreach($statuses as $status)
                                            <option value="{{$status['id']}}">{{$status['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        
                                    <div class="col-md-12 text-sm-end text-start mb-3">
                                        <button type="submit" class="btn btn-primary btn-sm rounded-0">Update</button>
                                    </div>
                        
                        
                                </div>
                        
                            </form>
                        </div>

                        <div class="modal-footer">

                        </div>

                    </div>
                </div>
            </div>
        {{-- end edit modal  --}}
    {{-- END MODAL AREA --}}


@endsection


@section('css')
    
@endsection


@section('scripts')

{{-- sweet alert js1--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            $('.region_id').empty();

                            opforcity += `<option selected disabled>Choose a city</option>`;
                            opforregion += `<option selected disabled>Choose a Region</option>`;

                            for(let x = 0; x < response.data.length; x++){
                                opforcity += `<option value="${response.data[x].id}">${response.data[x].name}</option>`;
                            }

                            $('.city_id').append(opforcity);
                            $('.region_id').append(opforregion);
                        },
                        error:function(response){
                            console.log("Error : ",response);
                        }
                    });
            });


            $(document).on('change','.city_id',function(){

                const getcityid = $(this).val();
                // console.log(getcityid);

                let opforregion = "";

                    $.ajax({
                        url:`/api/filter/regions/${getcityid}`,
                        type:"GET",
                        dataType:'json',
                        success:function(response){
                            // console.log(response);

                            $('.region_id').empty();

                            opforregion += `<option selected disabled>Choose a Region</option>`;

                            for(let y = 0; y < response.data.length; y++){
                                opforregion += `<option value="${response.data[y].id}">${response.data[y].name}</option>`;
                            }

                            $('.region_id').append(opforregion);
                        },
                        error:function(response){
                            console.log("Error : ",response);
                        }
                    });
            });

            // End Dynamic Select Option 


            // Start Delete Item
            $('.delete-btns').click(function(){

                var getidx = $(this).data('idx');
                // console.log(getidx);

                if(confirm(`Are you sure !!! You want to Delete ${getidx} ?`)){
                    $('#formdelete-'+getidx).submit();
                    return true;
                }else{
                    return false;
                }
            });
            // Start Delete Item


            // Start Edit Form 
            $(document).on('click','.editform',function(e){

                // console.log($(this).attr('data-id'),$(this).data('name'));

                $('#editname').val($(this).data('name'));
                $('#editcountry_id').val($(this).data('country_id'));
                $('#editcity_id').val($(this).data('city_id'));
                $('#editregion_id').val($(this).data('region_id'));
                $('#editstatus_id').val($(this).data('status'));

                const getid = $(this).attr('data-id');
                $('#formaction').attr('action',`/townships/${getid}`);

                e.preventDefault();

            });
            // End Edit Form 


            // Start Bulk Delete 

            $("#selectalls").click(function(){
                $(".singlechecks").prop('checked',$(this).prop('checked'));
            });

            $("#bulkdelete-btn").click(function(){
                let getselectedids = [];

                // console.log($("input:checkbox[name=singlechecks]:checked"));

                $("input:checkbox[name='singlechecks']:checked").each(function(){
                    getselectedids.push($(this).val());
                });

                console.log(getselectedids);


                Swal.fire({
                    title: "Are you sure?",
                    text: `You won't be able to revert id !`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        // data remove
                        $.ajax({
                            url:'{{route("townships.bulkdeletes")}}',
                            type:"DELETE",
                            dataType:"json",
                            data:{
                                selectedids:getselectedids,
                                _token:'{{csrf_token()}}'
                            },
                            success:function(response){
                                console.log(response); // 1

                                if(response){
                                    // ui remove
                                    $.each(getselectedids,function(key,val){
                                        $(`#delete_${val}`).remove();
                                    });


                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    });
                                }
                            },
                            error:function(response){
                                console.log("Error : ",response);
                            }
                        });


                    }
                });     

            });

            // End Bulk Delete 


            // Start Change Btn 

            $('.change-btn').change(function(){
                const getid = $(this).data('id');
                const setstatus = $(this).prop('checked') === true ? 3 : 4;

                $.ajax({
                    url:'townshipsstatus',
                    type:'GET',
                    dataType:'json',
                    data:{"id":getid,"status_id":setstatus},
                    success:function(response){
                        console.log(response.success);

                        Swal.fire({
                            title: "Updated!",
                            text: "Updated Successfully!",
                            icon: "success"
                        });
                    }
                });

            });

            // End Change Btn

        });

    </script>
@endsection

