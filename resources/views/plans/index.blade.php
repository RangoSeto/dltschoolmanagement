@extends('layouts.adminindex')
@section('content')

    <div class="container-fluid">
        <div class="col-md-12">

            <h6>Plan Management</h6>
            <p>Discover our popular services.</p>

        </div>

        <div class="loader-container">

            <div id="packagedata" class="row">

            </div>

            <div class="loader">
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
            </div>

        </div>

    </div>

@endsection


@section('css')

    <link href="{{asset('assets/dist/css/loader.css')}}" rel="stylesheet" />

@endsection


@section('scripts')

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
        function fetchallpackages(){
            $.ajax({
                url:"{{route('plans.index')}}",
                method:"GET",
                beforeSend:function(){
                    $('.loader').addClass('show');
                },
                success:function(response){
                    // console.log(response);
                    $("#packagedata").html(response);
                },
                complete:function(){
                    $('.loader').removeClass('show');
                },
            });
        }

        fetchallpackages();

        // End fetch All Datas

        // Start Add to Cart Package 
        $(document).on('click','.add-to-cart',function(){

            const packageid = $(this).data('package-id');
            const packageprice = $(this).data('package-price');

            $.ajax({
                url:"{{route('carts.add')}}",
                method:"POST",
                data:{
                    package_id:packageid,
                    quantity:1,
                    price:packageprice
                },
                success:function(response){
                    window.alert(response.message);
                }
            });

        });
        // End Add to Cart Package 



    });
</script>

@endsection

