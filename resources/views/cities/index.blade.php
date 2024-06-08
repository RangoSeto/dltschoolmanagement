@extends('layouts.adminindex')
@section('caption','City List')
@section('content')


    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            {{-- <form action="{{route('cities.store')}}" method="POST"> --}}
            <form id="createform">

                {{ csrf_field() }}

                <div class="row align-items-end">
                    <div class="col-md-3 form-group mb-3">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        {{-- @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label for="country_id">Country <span class="text-danger">*</span></label>
                        <select type="text" name="country_id" id="country_id" class="form-control form-control-sm rounded-0">
                            @foreach($countries as $country)
                            <option value="{{$country['id']}}">{{$country['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label for="status_id">Status <span class="text-danger">*</span></label>
                        <select type="text" name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                            @foreach($statuses as $status)
                            <option value="{{$status['id']}}">{{$status['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="user_id" id="user_id" value="{{$userdata['id']}}" />


                    <div class="col-md-3 text-sm-end text-md-start mb-3">
                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" id="create-btn" class="btn btn-primary btn-sm rounded-0 ms-3 create-btn">Submit</button>
                    </div>


                </div>

            </form>
        </div>

        <hr/>

        <div class="col-md-12">

            <div>
                <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
                <a href="javascript:void(0);" id="generateotp-btn" class="btn btn-success btn-sm rounded-0 ms-5">Generate OTP</a>
            </div>

            <div>
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-md-2 col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search..." value="{{request('filtername')}}" />
                                <button type="button" id="btn-search" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-md-12 loader-container myscroll">

            <table id="mytable" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <div class="loader">
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
            </div>

            {{-- {{ $cities->links('pagination::bootstrap-4') }} --}}

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
                            <form id="editform" action="" method="">


                                <div class="row align-items-end">
                                    <div class="col-md-5 form-group mb-3">
                                        <label for="editname">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="editname" id="editname" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
                                    </div>


                                    <div class="col-md-4 form-group mb-3">
                                        <label for="editcountry_id">Country <span class="text-danger">*</span></label>
                                        <select type="text" name="editcountry_id" id="editcountry_id" class="form-control form-control-sm rounded-0">
                                            @foreach($countries as $country)
                                            <option value="{{$country['id']}}">{{$country['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 form-group mb-3">
                                        <label for="editstatus_id">Status <span class="text-danger">*</span></label>
                                        <select type="text" name="editstatus_id" id="editstatus_id" class="form-control form-control-sm rounded-0">
                                            @foreach($statuses as $status)
                                            <option value="{{$status['id']}}">{{$status['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" name="id" id="id" />
                                    <input type="hidden" name="user_id" id="user_id" value="{{$userdata['id']}}" />


                                    <div class="col-md-12 text-end mb-3">
                                        <button type="submit" id="edit-btn" class="btn btn-primary btn-sm rounded-0">Update</button>
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
    <link href="{{asset('assets/dist/css/loader.css')}}" rel="stylesheet" />
    <style type="text/css">
        /* .myscroll{
            height: 200px;
            overflow-y: scroll;
        } */
    </style>
@endsection


@section('scripts')


{{-- jquery validate  --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js" type="text/javascript"></script>
{{-- sweetalert2 js1 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">

        // Start Filter
        const getfilterbtn = document.getElementById('btn-search');
        getfilterbtn.addEventListener('click',function(e){
            const getfiltername = document.getElementById('filtername').value;
            const getcururl = window.location.href;

            // console.log(getcururl); //http://127.0.0.1:8000/cities
            // console.log(getcururl.split('?')); // ['http://127.0.0.1:8000/cities','?filtername=yan']
            // console.log(getcururl.split('?')[0]); // http://127.0.0.1:8000/cities
            window.location.href = getcururl.split('?')[0] + '?filtername='+getfiltername; // ဒီမှာ splitမလုပ်လည်းရတယ်ရိုးရိုးဟာပဲရလာမှာမလို့


            e.preventDefault();

        });
        // End Filter

        $(document).ready(function(){


            // Start Passing Header Token
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            // Start Passing Header Token


            const getmyscroll = document.querySelector('.myscroll');
            const gettbody = document.querySelector("#mytable tbody");
            const getloader = document.querySelector(".loader");

            let page = 1;

            // Start fetch All Datas By Paginate
            async function fetchalldatasbypaginate(){

                const url = `api/citiessearch?page=${page}`;

                let results;

                await fetch(url).then(response=>{
                    // console.log(response);
                    return response.json();
                }).then(data=>{
                    console.log(data);

                    results = data.data;
                    console.log(results);
                }).catch(err=>{
                    console.log(err);
                });

                return results;

            }

            fetchalldatasbypaginate();

            async function alldatastodom(){
                const getresults = await fetchalldatasbypaginate();

                getresults.forEach((data)=>{

                    const newtr = document.createElement('tr');
                    newtr.id = `delete_${data.id}`;

                    newtr.innerHTML = `
                                    <td>
                                        <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="${data.id}" />
                                    </td>
                                    <td>${data.id}</td>
                                    <td>${data.name}</td>
                                    <td>${data.country['name']}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                        </div>
                                    </td>
                                    <td>${data.user.name}</td>
                                    <td>${data.created_at}</td>
                                    <td>${data.updated_at}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="text-info editform edit-btns" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}" data-status="${data.status_id}"><i class="fas fa-pen"></i></a>
                                        <a href="javascript:void(0);" class="text-danger ms-2 delete-btns" data-idx="${data.id}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                        `;

                    gettbody.appendChild(newtr);
                });

                // console.log(newtr);
            }

            alldatastodom();



            document.addEventListener('scroll',()=>{
                // console.log(document.documentElement.scrollTop);
                // console.log(document.documentElement.scrollHeight);
                // console.log(document.documentElement.clientHeight);

                const {scrollTop,scrollHeight,clientHeight} = document.documentElement;

                if(scrollTop + clientHeight > scrollHeight - 5){
                    // console.log('hay');
                    showloader();
                }
            });

            // Show loader & fetch more datas
            function showloader(){
                getloader.classList.add('show');

                setTimeout(() => {
                    getloader.classList.remove('show');

                    setTimeout(()=>{
                        page++;
                        // console.log(page);
                        alldatastodom();
                    },300);

                }, 1000);
            }
            // Show loader & fetch more datas


            // End fetch All Datas By Paginate



            // Start Create Form


            $('#createform').validate({

                rules:{
                    name:"required"
                },

                messages:{
                    name:"Please enter the application name"
                },

                submitHandler:function(form){


                        $("#create-btn").text("Sending");

                        let formdata = $(form).serializeArray();

                        $.ajax({
                            data:formdata,
                            url:"{{url('api/cities')}}",
                            type: "POST",
                            dataType:'json',
                            success:function(response){
                                // console.log(response);

                                console.log(response);

                                if(response){
                                    const data = response.data;


                                    let html = `<tr id="delete_${data.id}">
                                        <td>
                                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="${data.id}" />
                                        </td>
                                        <td>${data.id}</td>
                                        <td>${data.name}</td>
                                        <td>${data.country['name']}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                            </div>
                                        </td>
                                        <td>${data.user.name}</td>
                                        <td>${data.created_at}</td>
                                        <td>${data.updated_at}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}" data-status="${data.status_id}"><i class="fas fa-pen"></i></a>
                                            <a href="javascript:void(0);" class="text-danger ms-2 delete-btns" data-idx="${data.id}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                        </td>

                                    </tr>`;

                                    $("#mytable tbody").prepend(html);

                                    $("#create-btn").text("Submit");

                                    Swal.fire({
                                        title: "Added!",
                                        text: "Added Successfully!",
                                        icon: "success"
                                    });

                                }
                            },
                            error:function(response){
                                console.log("Error : ",response);
                                $("#create-btn").text("Try Again");
                            }
                        });

                }


            });
            // End Create Form



            // Start Edit Form

            $(document).on('click','.edit-btns',function(){

                const getid = $(this).data('id');
                // console.log(getid);

                $.get(`cities/${getid}/edit`,function(response){
                    // console.log(response);

                    $("#editmodal").modal("show");

                    $("#id").val(response.id);
                    $("#editname").val(response.name);
                    $("#editcountry_id").val(response.country_id);
                    $("#editstatus_id").val(response.status_id);

                });


            });

            // Start Edit Modal

            $('#editform').validate({

                rules:{
                    editname:"required"
                },

                messages:{
                    editname:"Please enter the application name"
                },

                submitHandler:function(form){

                    const getid = $("#id").val();

                    $("#edit-btn").text("Sending");

                        let formdata = $(form).serializeArray();

                        $.ajax({
                            data:formdata,
                            url:`api/cities/${getid}`,
                            type: "PUT",
                            dataType:'json',
                            success:function(response){
                                // console.log(response);

                                if(response){
                                    const data = response.data;

                                    let html = `<tr id="delete_${data.id}">
                                        <td>
                                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="${data.id}" />
                                        </td>
                                        <td>${data.id}</td>
                                        <td>${data.name}</td>
                                        <td>${data.country['name']}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                            </div>
                                        </td>
                                        <td>${data.user.name}</td>
                                        <td>${data.created_at}</td>
                                        <td>${data.updated_at}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}" data-status="${data.status_id}"><i class="fas fa-pen"></i></a>
                                            <a href="javascript:void(0);" class="text-danger ms-2 delete-btns" data-idx="${data.id}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                        </td>

                                    </tr>`;

                                    $("#delete_"+data.id).replaceWith(html);

                                    $("#edit-btn").text("Update");
                                    $("#editmodal").modal("hide"); // toggle

                                    Swal.fire({
                                        title: "Updated!",
                                        text: "Updated Successfully!",
                                        icon: "success"
                                    });

                                }
                            },
                            error:function(response){
                                console.log("Error : ",response);
                                $("#edit-btn").text("Try Again");
                            }
                        });

                }


                });

            // End Edit Modal


            // End Edit Form


            // Start Delete Form

            // By ajax

            $(document).on('click','.delete-btns',function(){
                const getidx = $(this).attr('data-idx');
                const getid = $(this).data('id');


                Swal.fire({
                    title: "Are you sure?",
                    text: `You won't be able to revert id ${getidx} !`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {


                        // data remove
                        $.ajax({
                            url:`api/cities/${getid}`,
                            type:"DELETE",
                            dataType:"json",
                            success:function(response){
                                console.log(response); // 1

                                if(response){
                                    // ui remove
                                    $(`#delete_${getid}`).remove();


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

            // End Delete Form



            // for mytable
            // $('#mytable').DataTable();


            // Start Change btn
            $(document).on('change','.change-btn',function(){

                var getid = $(this).data('id');
                // console.log(getid);
                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                console.log(setstatus);

                $.ajax({
                    url:"api/citiesstatus",
                    type:"PUT",
                    dataType:"json",
                    data:{"id":getid,"status_id":setstatus},

                    success:function(response){
                        console.log(response);
                        // console.log(response.success);

                        Swal.fire({
                            title: "Updated!",
                            text: "Updated Successfully!",
                            icon: "success"
                        });
                    }
                });

            });

            // End Change btn


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

                // $.ajax({
                //     url:'{{route("cities.bulkdeletes")}}',
                //     type:"DELETE",
                //     dataType:"json",
                //     data:{
                //         selectedids:getselectedids,
                //         _token:'{{csrf_token()}}'
                //     },
                //     success:function(response){
                //         // console.log(response);
                //         if(response){
                //             $.each(getselectedids,function(key,val){
                //                 $(`#delete_${val}`).remove();
                //             });
                //         }
                //     },
                //     error:function(response){
                //         console.log('Error :',response);
                //     }
                // });


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
                            url:'{{route("cities.bulkdeletes")}}',
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


            // Start OTP 
            $("#generateotp-btn").on('click',function(){
                
                $.ajax({
                    url:'/generateotps',
                    type:"POST",
                    success:function(response){
                        console.log(response);
                    },
                    error:function(response){
                        console.error("Error : ",response);
                    }
                });

            });
            // End OTP



        });

    </script>
@endsection

