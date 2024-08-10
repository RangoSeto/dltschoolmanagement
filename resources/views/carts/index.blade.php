@extends('layouts.adminindex')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="row px-3 mt-3">

            <div class="col-md-8 mb-3">
                <h6><a href="{{route('plans.index')}}" class="nav-link">Continue Shopping</a></h6>
                <hr/>
                <div class="text-center">
                    <span>You have {{$userdata->carts()->count()}} items in your cart</span>
                </div>

                @foreach($carts as $idx=>$cart)
                    <div id="package_{{$cart->package_id}}" class="d-flex justify-content-between align-items-center p-2 mt-3 package" data-packageid="{{$cart->package_id}}">
                        
                        <div>
                            <span>{{++$idx}}.</span>
                            <span>{{$cart->package['name']}}</span>
                            <span>{{$cart->package['duration']}} days</span>
                        </div>

                        <div>
                            <span class="quantity">{{$cart->quantity}} qty</span>
                        </div>

                        <div>
                            <span class="me-5">{{$cart->price}}</span>
                            <a href="javascript:void(0);" id="removefromcart" data-packageid="{{$cart->package_id}}">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </a>
                        </div>

                    </div>
                @endforeach


            </div>

            <div class="col-md-4 mb-3">
                <h6>Payment details</h6>
                <hr/>

                <div class="d-flex justify-content-between">
                    <span>Total</span>
                    <span>{{$totalcost}}</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Payment Method</span>
                    <span>Point Pay</span>
                </div>

                <div class="d-grid mt-3">
                    <button type="button" id="paybypoints" class="btn btn-primary btn-sm rounder-0">Pay Now</button>
                </div>
            </div>

        </div>

    </div>

    <!--End Page Content Area-->


    {{-- START MODAL AREA  --}}
    <div id="otpmodal" class="modal fade">
        <div class="modal-dialog model-sm modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <form id="verifyform" action="" method="">

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
    {{-- END MODAL AREA --}}

@endsection


@section('css')

    <link href="{{asset('assets/dist/css/loader.css')}}" rel="stylesheet" />

@endsection


@section('scripts')

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


            // Start Pay by Points

            // $("#paybypoints").click(function(){

            //     let packageid;

            //     $(".package").each(function(){

            //         packageid = $(this).data('packageid');
            //         console.log(packageid);

            //         $.ajax({
            //             url:"{{route('carts.paybypoints')}}",
            //             type:'POST',
            //             data:{
            //                 _token:$('meta[name="csrf-token"]').attr('content'),
            //                 packageid:packageid
            //             },
            //             success:function(response){
            //                 window.alert(response.message);
            //                 location.reload();
            //             },
            //             error:function(response){
            //                 window.alert(response.responseJSON.message);
            //             }
            //         });


            //     });
            
            // });

            // End Pay by Points

            // Start OTP
            $("#paybypoints").click(function(){


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

            $("#verifyform").on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url:'/verifyopts',
                    type:'POST',
                    data:$(this).serialize(),
                    success:function(response){

                        if(response.message){

                            // start pay now
                            
                            let packageid;

                            $(".package").each(function(){

                                packageid = $(this).data('packageid');
                                console.log(packageid);

                                $.ajax({
                                    url:"{{route('carts.paybypoints')}}",
                                    type:'POST',
                                    data:{
                                        _token:$('meta[name="csrf-token"]').attr('content'),
                                        packageid:packageid
                                    },
                                    success:function(response){
                                        window.alert(response.message);
                                        location.reload();
                                    },
                                    error:function(response){
                                        window.alert(response.responseJSON.message);
                                    }
                                });


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

            // End OTP


            // Remove from cart
            $(document).on('click',"#removefromcart",function(){
                
                const packageid = $(this).data('packageid');
                $.ajax({
                    url:"{{route('carts.remove')}}",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}",
                        packageid:packageid
                    },
                    success:function(response){
                        console.log(response.message);

                        // UI remove
                        // $("#package_"+packageid).remove();
                        $('div[id="package_'+packageid+'"]').remove();
                        
                    },
                    error:function(response){
                        console.log(response);
                    }
                });

            });

        });

    </script>
@endsection

