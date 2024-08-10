@extends('layouts.adminindex')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
            <a href="javascript:void(0);" id="createmodal-btn" class="btn btn-primary btn-sm rounded-0 me-3">Create</a>
            <a href="javascript:void(0);" id="setmodal-btn" class="btn btn-info btn-sm rounded-0">Set To User</a>
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

        <div class="col-md-12 loader-container">

            <table id="mytable" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                        </th>
                        <th>No</th>
                        <th>Name </th>
                        <th>Price</th>
                        <th>Duration/Day</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tabledata">

                </tbody>
            </table>

            <div class="loader">
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
            </div>
        </div>

    </div>

    <!--End Page Content Area-->


    {{-- START MODAL AREA --}}

        {{-- start create model  --}}
        <div id="createmodal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">

                    <div class="modal-header">
                        <h6 class="modal-title">Title</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="createform" action="" method="">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Application name" value="{{old('name')}}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input type="number" name="price" id="price" class="form-control form-control-sm rounded-0" placeholder="Enter Price" value="{{old('price')}}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="duration">Duration <span class="text-danger">*</span></label>
                                    <input type="number" name="duration" id="duration" class="form-control form-control-sm rounded-0" placeholder="Enter Duration" value="{{old('duration')}}">
                                </div>


                                <input type="hidden" id="packageid" name="package_id" />

                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" id="create-btn" class="btn btn-primary btn-sm rounded-0" value="action-type">Submit</button>
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


        {{-- start set model  --}}
        <div id="setmodal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">

                    <div class="modal-header">
                        <h6 class="modal-title">Title</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="setform" action="" method="">

                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="setuser_id">User Id <span class="text-danger">*</span></label>
                                    <input type="text" name="setuser_id" id="setuser_id" class="form-control form-control-sm rounded-0" placeholder="Enter User Id" value="{{old('setuser_id')}}">
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="package_id">Pakage Id <span class="text-danger">*</span></label>
                                    <input type="number" name="package_id" id="package_id" class="form-control form-control-sm rounded-0" placeholder="Enter Package ID" value="{{old('package_id')}}">
                                </div>

                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" id="set-btn" class="btn btn-primary btn-sm rounded-0">Submit</button>
                                </div>

                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">

                    </div>

                </div>
            </div>
        </div>
        {{-- end set modal  --}}
{{-- END MODAL AREA --}}

@endsection


@section('css')

    <link href="{{asset('assets/dist/css/loader.css')}}" rel="stylesheet" />

@endsection


@section('scripts')

{{-- datatable css1 js1  --}}
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
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
                    url:"{{route('packages.index')}}",
                    method:"GET",
                    beforeSend:function(){
                        $('.loader').addClass('show');
                    },
                    success:function(response){
                        // console.log(response);
                        $("#tabledata").html(response);
                    },
                    complete:function(){
                        $('.loader').removeClass('show');
                    },
                });
            }

            fetchalldatas();


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

            // End fetch All Datas



            // Start Create Package

            $('#createmodal-btn').click(function(){

                // clear form data
                // $("#createform")[0].reset();
                $("#createform").trigger("reset");

                $("#createmodal .modal-title").text("Create Package");
                $("#create-btn").html("Add New Package");
                $("#create-btn").val("action-type");

                $('#createmodal').modal("show"); // toggle
            });

            $("#create-btn").click(function(e){
                e.preventDefault();

                let actiontype = $("#create-btn").val();
                $(this).html("Sending...");

                if(actiontype == "action-type"){
                    // Do Create

                    $.ajax({
                        url:"{{route('packages.store')}}",
                        type:'POST',
                        dataType:"json",
                        data: $("#createform").serialize(),
                        success:function(response){

                            // $("#createform")[0].reset()
                            $("#createform").trigger("reset");

                            $("#createmodal").modal('hide'); // toggle
                            $("create-btn").html("Save Change");

                            fetchalldatas();

                            Swal.fire({
                                        title: "Created!",
                                        text: "Create Successfully.",
                                        icon: "success"
                                    });


                        },
                        error:function(response){
                            console.log("Error: ",response);
                            $("create-btn").html("Save Change");
                        }
                    });

                }else if(actiontype == "edit-type"){
                    // Do Edit

                    const getid = $("#packageid").val();

                    $.ajax({
                        url:`/packages/${getid}`,
                        type:'PUT',
                        dataType:"json",
                        data:$("#createform").serialize(),
                        success:function(response){

                            // $("#createform")[0].reset()
                            $("#createform").trigger("reset");

                            $("#createmodal").modal('hide'); // toggle
                            $("create-btn").html("Save Change");

                            fetchalldatas();

                            Swal.fire({
                                        title: "Updated!",
                                        text: "Updated Successfully.",
                                        icon: "success"
                                    });


                        },
                        error:function(response){
                            console.log("Error: ",response);
                            $("create-btn").html("Save Change");

                        }
                    });
                }

            });

            // End Create Form



            // Start Edit Form

            $(document).on('click','.edit-btns',function(){

                const getid = $(this).data('id');
                // console.log(getid);

                $.get(`/packages/${getid}`,function(response){
                    // console.log(response);

                    $("#createmodal .modal-title").text("Edit Form");
                    $('#create-btn').text("Update");
                    $('#create-btn').val("edit-type");
                    $("#createmodal").modal("show");

                    $("#packageid").val(response.id);
                    $("#name").val(response.name);
                    $("#price").val(response.price);
                    $("#duration").val(response.duration);

                });


            });

            // End Edit Form


            // Start Set package
            $('#setmodal-btn').click(function(){

                // clear form data
                // $("#setform")[0].reset();
                $("#setform").trigger("reset");

                $("#setmodal .modal-title").text("set Package");
                $("#set-btn").html("Set Package");

                $('#setmodal').modal("show"); // toggle
            });

            $("#set-btn").click(function(e){
                e.preventDefault();

                    $.ajax({
                        url:"{{route('packages.setpackage')}}",
                        type:'POST',
                        dataType:"json",
                        data:$("#setform").serialize(),
                        success:function(response){

                            // $("#setform")[0].reset()
                            $("#setform").trigger("reset");

                            $("#setmodal").modal('hide'); // toggle
                            $("set-btn").html("Save Change");

                            Swal.fire({
                                        title: "Access!",
                                        text: "Package Set Successfully.",
                                        icon: "success"
                                    });


                        },
                        error:function(response){
                            console.log("Error: ",response);
                            $("set-btn").html("Save Change");
                        }
                    });


            });
            // End Set Package


            // Start Single Delete

            $(document).on('click','.delete-btns',function(){

                const getid = $(this).data('id');
                const getidx = $(this).attr('data-idx');

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
                            url:`/packages/${getid}`,
                            type:"DELETE",
                            dataType:"json",
                            success:function(response){
                                if(response){

                                    fetchalldatas();

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

            // End Single Delete



            // Start Change btn
            $(document).on('change','.change-btn',function(){

                var getid = $(this).data('id');
                // console.log(getid);
                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                console.log(setstatus);

                $.ajax({
                    url:"socialapplicationsstatus",
                    type:"GET",
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
                            url:'{{route("packages.bulkdeletes")}}',
                            type:"DELETE",
                            dataType:"json",
                            data:{
                                selectedids:getselectedids,
                                _token:'{{csrf_token()}}'
                            },
                            success:function(response){
                                console.log(response); // 1

                                if(response){

                                    fetchalldatas();

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

