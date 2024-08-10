@extends('layouts.adminindex')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
            <a href="javascript:void(0);" id="createmodal-btn" class="btn btn-primary btn-sm rounded-0 me-3">Transfer</a>
        </div>

        <hr/>


        <div class="col-md-12">

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
                        <th>No</th>
                        <th>Student Id </th>
                        <th>Points</th>
                        <th>Account Type</th>
                        <th>Created At</th>
                        <th>Updated At</th>
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
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content rounded-0">

                    <div class="modal-header">
                        <h6 class="modal-title">Title</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        
                        <div id="step1">
                            <form id="verifyform" action="" method="">

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="student_id">Student ID <span class="text-danger">*</span></label>
                                        <input type="text" name="student_id" id="student_id" class="form-control form-control-sm rounded-0" placeholder="Enter Student ID" value="{{old('student_id')}}">
                                    </div>
    
                                    <div class="col-md-12 text-end mt-3">
                                        <button type="button" id="verify-btn" class="btn btn-primary btn-sm rounded-0">Next</button>
                                    </div>

                                </div>
    
                            </form>
                        </div>

                        <div id="step2" style="display: none;">
                            <form id="createform" action="" method="">

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <ul class="list-group"></ul>
                                    </div>
    
                                    <div class="col-md-12 form-group">
                                        <label for="points">Points <span class="text-danger">*</span></label>
                                        <input type="number" name="points" id="points" class="form-control form-control-sm rounded-0" placeholder="Enter Point" value="{{old('points')}}">
                                    </div>
    
                                    <input type="hidden" id="receiver_id" name="receiver_id" />
                                    
                                    <div class="col-md-12 text-end mt-3">
                                        <button type="button" id="stepback-btn" class="btn btn-primary btn-sm rounded-0 me-3">Back</button>
                                        <button type="submit" id="create-btn" class="btn btn-primary btn-sm rounded-0" value="action-type">Submit</button>
                                    </div>
    
    
                                </div>
    
                            </form>
                        </div>

                    </div>


                </div>
            </div>
        </div>
        {{-- end create modal  --}}

        {{-- start otp modal  --}}
        <div id="otpmodal" class="modal fade">
            <div class="modal-dialog model-sm modal-dialog-centered">
                <div class="modal-content">
    
                    <div class="modal-body">
                        <form id="verifyotpform" action="" method="">
    
                            <div class="row">
    
                                <div class="form-group col-md-12 mb-3">
                                    <label for="otpcode">OTP Code <span class="text-danger">*</span></label>
                                    <input type="text" name="otpcode" id="otpcode" class="form-control form-control-sm rounded-0" placeholder="Enter Your OTP">
                                </div>
    
                                <input type="hidden" name="otpuser_id" id="otpuser_id" value="{{$userdata['id']}}" />
    
                                <div class="col-md-12 text-end mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0">Update</button>
                                </div>
                                
                            </div>
    
                            {{-- <p id="otpmessage"></p> --}}
                            <p>Expires in : <span id="otptimer"></span> seconds</p>
    
                        </form>
                    </div>
    
    
                </div>
            </div>
        </div>
        {{-- end otp modal  --}}


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
            function fetchalldatas(){
                $.ajax({
                    url:"{{ route('pointtransfers.index') }}",
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
                    }
                });
            }


            fetchalldatas();


            // Start Verify & Transfer Points

            // Start Create 
            $('#createmodal-btn').click(function(){

                $("#step1").show();
                $("#step2").hide();

                // clear form data
                // $("#createform")[0].reset();
                $("#createform").trigger("reset");
                $("#verifyform").trigger("reset");

                $("#createmodal .modal-title").text("Verify Student");
                $("#create-btn").html("Transfer");
                $("#create-btn").val("action-type");

                $('#createmodal').modal("show"); // toggle
            });

            // Start Verify Student

            $("#verify-btn").click(function(){

                const studentid = $("#student_id").val();

                $.ajax({
                        url:"{{route('userpoints.verifystudent')}}",
                        type:'POST',
                        dataType:"json",
                        data: {
                            studentid: studentid
                        },
                        success:function(response){

                            let htmlview = '';

                            $("#step1").hide();
                            $("#step2").show();

                            $("#createmodal .modal-title").text("Transfer Points");
                            $("#receiver_id").val(response.user.id);

                            htmlview = `<li class="list-group-item"><a href="{{URL::to('students/${response.student.id}')}}" target="_blank" >${response.student.firstname} ${response.student.lastname}</a></li>`;
                            $("#createmodal .modal-body #createform ul.list-group").html(htmlview);

                        },
                        error:function(response){
                            console.log("Error: ",response);
                        }
                    });

            });

            $("#stepback-btn").click(function(){

                $("#createmodal .modal-title").text("Verify Student");
                $("#step2").hide();
                $("#step1").show();

                $("#verifyform").trigger("reset");
            });

            // End Verify Student

            
            // Start Transfer point
            // $("#create-btn").click(function(e){
            //     e.preventDefault();

            //     let actiontype = $("#create-btn").val();
            //     $(this).html("Sending...");

            //     if(actiontype == "action-type"){
                    

            //         $.ajax({
            //             url:"{{route('pointtransfers.transfers')}}",
            //             type:'POST',
            //             dataType:"json",
            //             data: $("#createform").serialize(),
            //             success:function(response){

            //                 // $("#createform")[0].reset()
            //                 $("#createform").trigger("reset");

            //                 $("#createmodal").modal('hide'); // toggle
            //                 $("#create-btn").html("Save Change");

            //                 fetchalldatas();

            //                 Swal.fire({
            //                     title: "Transfer!",
            //                     text: "Transfer Successfully.",
            //                     icon: "success"
            //                 });


            //             },
            //             error:function(response){
            //                 console.log("Error: ",response);
            //                 $("#create-btn").html("Save Change");
            //             }
            //         });

            //     }
            // });

            // End Transfer point




            // Start OTP with transfer point
            $("#create-btn").click(function(e){
                e.preventDefault();


                // loading box
                Swal.fire({
                    title: "Processing...",
                    text: "Please wait while we send your OTP",
                    allowOutsideClick:false,
                    didOpen: () => {
                        Swal.showLoading();
                        
                    }
                });
                // loading box


                $.ajax({
                    url:'/generateotps',
                    type:"POST",
                    success:function(response){
                        // console.log(response);

                        // close loading box 
                        Swal.close();

                        // $('#otpmessage').text("Your OTP Code is : "+ response.otp);
                        $("#otpmodal").modal('show');

                        startotptimer(60); // OTP will expires in 60s (1 minutes);

                    },
                    error:function(response){
                        console.error("Error : ",response);
                    }
                });
            });


            function startotptimer(duration){
                
                timeleft = duration; // 60 seconds
                $("#otptimer").text(timeleft);

                let setinv = setInterval(dectimer,1000);

                function dectimer(){
                    timeleft--;

                    $("#otptimer").text(timeleft);

                    if(timeleft <= 0){
                        clearInterval(setinv);
                        $("#otpmodal").modal('hide');
                    }
                }

            }

            $("#verifyotpform").on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url:'/verifyopts',
                    type:'POST',
                    data:$(this).serialize(),
                    success:function(response){

                        if(response.message){

                            // start pay now
                            $.ajax({
                                url:"{{route('pointtransfers.transfers')}}",
                                type:'POST',
                                dataType:"json",
                                data: $("#createform").serialize(),
                                success:function(response){

                                    // $("#createform")[0].reset()
                                    $("#createform").trigger("reset");

                                    $("#createmodal").modal('hide'); // toggle
                                    $("#create-btn").html("Save Change");

                                    fetchalldatas();

                                    Swal.fire({
                                        title: "Transfer!",
                                        text: "Transfer Successfully.",
                                        icon: "success"
                                    });


                                },
                                error:function(response){
                                    console.log("Error: ",response);
                                    $("#create-btn").html("Save Change");
                                }
                            });
                            // end pay now

                            $("#otpmodal").modal('hide');

                            console.log("Pay Now");
                        }else{
                            console.log("Invalid OTP");
                        }

                    },
                    error:function(response){
                        console.log("Error OTP : ",response);
                    }
                });
            });
            // End OTP with transfer point

            // End Create 

            
            // End Verify & Transfer Points




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
                            url:`/userpoints/${getid}`,
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
                            url:'{{route("userpoints.bulkdeletes")}}',
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

