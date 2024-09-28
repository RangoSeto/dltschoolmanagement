@extends('layouts.adminindex')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
            <a href="javascript:void(0);" id="modal-btn" class="btn btn-primary btn-sm rounded-0">Create</a>
        </div>

        <hr/>


        <div class="col-md-12 ">

            <div>
                <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
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

        <div class="col-md-12">

            <table id="mytable" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                        </th>
                        <th>No</th>
                        <th>Name</th>
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

            {{-- {{ $warehouses->links() }} --}}

        </div>

    </div>

    <!--End Page Content Area-->


    {{-- START MODAL AREA --}}

        {{-- start create model  --}}
        <div id="createmodal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">

                    <div class="modal-header">
                        <h6 class="modal-title">Create Form</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="formaction" action="" method="">

                            <div class="row align-items-end px-3">
                                <div class="col-md-7 form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Application name" value="{{old('name')}}">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="status_id">Status <span class="text-danger">*</span></label>
                                    <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                        @foreach($statuses as $status)
                                        <option value="{{$status['id']}}">{{$status['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" id="id" name="id" />
                                <input type="hidden" id="user_id" name="user_id" value="{{$userdata['id']}}" />

                                <div class="col-md-2">
                                    <button type="submit" id="action-btn" class="btn btn-primary btn-sm rounded-0" value="action-type">Submit</button>
                                </div>


                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">

                    </div>

                </div>
            </div>
        </div>
        {{-- end create modal  --}}


        {{-- start edit model  --}}
        {{-- <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">

                    <div class="modal-header">
                        <h6 class="modal-title">Edit Form</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="formaction" action="" method="">

                            <div class="row align-items-end">
                                <div class="col-md-7 form-group">
                                    <label for="editname">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="editname" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="editstatus_id">Name <span class="text-danger">*</span></label>
                                    <select name="status_id" id="editstatus_id" class="form-control form-control-sm rounded-0">
                                        @foreach($statuses as $status)
                                        <option value="{{$status['id']}}">{{$status['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0">Update</button>
                                </div>


                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">

                    </div>

                </div>
            </div>
        </div> --}}
        {{-- end edit modal  --}}
{{-- END MODAL AREA --}}

@endsection


@section('css')
    {{-- datatable css1 js1  --}}
    <link  href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" />
@endsection


@section('scripts')

{{-- jquery validate  --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js" type="text/javascript"></script>

{{-- sweetalert2 js1 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script type="text/javascript">


        $(document).ready(function(){


            // Start Passing Header Token
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            // Start Passing Header Token


            // Start fetch All Datas
            function fetchalldatas(query=""){
                $.ajax({
                    url:"{{url('api/warehousessearch')}}",
{{--                     url:"{{'api/warehouses'}}",--}}
                    {{--url:"{{route('api.warehouses.index')}}",--}}
                    method:"GET",
                    type:"json",
                    data:{"query":query},
                    success:function(response){
                        // console.log(response);

                        $("#mytable tbody").empty();

                        let datas = response.data;
                        // console.log(datas);

                        let html;

                        datas.forEach(function(data,idx){
                            console.log(data);

                            html += `<tr id="delete_${data.id}">
                                        <td>
                                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="${data.id}" />
                                        </td>
                                        <td>${++idx}</td>
                                        <td>${data.name}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                            </div>
                                        </td>
                                        <!-- <td>${data.user['name']}</td> -->
                                        <td>${data.user.name}</td>
                                        <td>${data.created_at}</td>
                                        <td>${data.updated_at}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="text-info editform edit-btns" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}" data-status="${data.status_id}"><i class="fas fa-pen"></i></a>
                                            <a href="javascript:void(0);" class="text-danger ms-2 delete-btns" data-idx="${idx}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                        </td>

                                    </tr>`;
                        });


                        $("#mytable tbody").prepend(html);

                    }
                });
            }

            fetchalldatas();
            // End fetch All Datas


            // Start Filter by search Query
            $("#btn-search").on('click',function(e){
                e.preventDefault();

                const query = $("#filtername").val();
                // console.log(query);

                if(query.length > 1){
                    $('.loading').show();
                }

                fetchalldatas(query);

            });
            // End Filter by search Query



            // Start Create Form

            $('#modal-btn').click(function(){

                // clear form data
                // console.log($("#formaction"));//{0: form#formaction, length: 1}
                // console.log($("#formaction")[0]);
                // method 1
                // $("#formaction")[0].reset(); // if you use reset()! that element can't be array. needed to converted element

                // method 2
                $("#formaction").trigger("reset");

                $("#createmodal .model-title").text("Create Form");

                $("#action-btn").val("create-btn");

                $('#createmodal').modal("show"); // toggle
            });

            $('#formaction').validate({

                rules:{
                    name:"required"
                },

                messages:{
                    name:"Please enter the application name"
                },

                submitHandler:function(form){

                    let actiontype = $("#action-btn").val();

                    if(actiontype === "create-btn"){

                        $("#action-btn").text("Sending");

                        // let formdata = $('#formaction').serialize();
                        // let formdata = $(form).serialize();
                        // let formdata = $('#formaction').serializeArray();
                        let formdata = $(form).serializeArray();

                        $.ajax({
                            data:formdata,
                            url:"{{url('api/warehouses')}}",
                            type: "POST",
                            dataType:'json',
                            success:function(response){
                                // console.log(response);

                                if(response){
                                    $('#createmodal').modal('hide'); // toggle

                                    const data = response.data;

                                    let html = `<tr id="delete_${data.id}">
                                        <td>
                                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="${data.id}" />
                                        </td>
                                        <td>${data.id}</td>
                                        <td>${data.name}</td>
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

                                    $("#action-btn").text("Submit");

                                    Swal.fire({
                                        title: "Added!",
                                        text: "Added Successfully!",
                                        icon: "success"
                                    });

                                }
                            },
                            error:function(response){
                                console.log("Error : ",response);
                            }
                        });

                    }else{

                        const getid = $("#id").val();

                        $("#action-btn").text("Sending");

                        $.ajax({
                            url:`api/warehouses/${getid}`,
                            type:"PUT",
                            dataType:"json",
                            data:$("#formaction").serialize(), // name=kpay&status_id=4
                            success:function(response){
                                // console.log(this.data); // name=kpay&status_id=3
                                // console.log(response);

                                const data = response.data;

                                let html = `<tr id="delete_${data.id}">
                                    <td>
                                        <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="${data.id}" />
                                    </td>
                                    <td>${data.id}</td>
                                    <td>${data.name}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input change-btn" ${data.status_id == 3 ? 'checked' : ''} data-id="${data.id}" />
                                        </div>
                                    </td>
                                    <td>${data.user['name']}</td>
                                    <td>${data.created_at}</td>
                                    <td>${data.updated_at}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}" data-status="${data.status_id}"><i class="fas fa-pen"></i></a>
                                        <a href="javascript:void(0);" class="text-danger ms-2 delete-btns" data-idx="${data.id}" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                    </td>

                                </tr>`;

                                $("#delete_"+data.id).replaceWith(html);

                                $("#action-btn").html("Submit");

                                $('#createmodal').modal('hide');

                                Swal.fire({
                                    title: "Updated!",
                                    text: "Updated Successfully!",
                                    icon: "success"
                                });


                            }

                        });

                    }



                }

            });
            // End Create Form



            // Start Edit Form

            $(document).on('click','.edit-btns',function(){

                const getid = $(this).data('id');
                // console.log(getid);

                $.get(`warehouses/${getid}/edit`,function(response){
                    // console.log(response);

                    $("#createmodal .modal-title").text("Edit Form");
                    $('#action-btn').text("Update");
                    $('#action-btn').val("edit-btn");
                    $("#createmodal").modal("show");

                    $("#id").val(response.id);
                    $("#name").val(response.name);
                    $("#status_id").val(response.status_id);

                });


            });

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
                            url:`api/warehouses/${getid}`,
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


            // Start Change btn
            $(document).on('change','.change-btn',function(){

                var getid = $(this).data('id');
                // console.log(getid);
                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                console.log(setstatus);

                $.ajax({
                    url:"api/warehousesstatus",
                    type:"PUT",
                    dataType:"json",
                    data:{"id":getid,"status_id":setstatus},

                    success:function(response){
                        // console.log(response);
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
                            url:'{{route("warehouses.bulkdeletes")}}',
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


        });
    </script>
@endsection

