@extends('layouts.adminindex')
@section('caption','Gender List')
@section('content')


    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-10">
            <form action="{{route('genders.store')}}" method="POST">
    
                {{ csrf_field() }}
        
                <div class="row align-items-end">
                    <div class="col-md-6 form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0 @error('name') is_invalid @enderror" placeholder="Enter name" value="{{old('name')}}">
                        {{-- @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror --}}
                    </div>
        
                    <div class="col-md-6">
                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                    </div>
        
        
                </div>
        
            </form>
            
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
                        <th>By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($genders as $idx=>$gender)
                    <tr id="delete_{{$gender->id}}">
                        <td>
                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$gender->id}}" />
                        </td>
                        <td>{{++$idx}}</td>
                        <td>{{$gender->name}}</td>
                        <td>{{$gender->user['name']}}</td>
                        <td>{{$gender->created_at->format('d M Y')}}</td>
                        <td>{{$gender->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$gender->id}}" data-name="{{$gender->name}}"><i class="fas fa-pen"></i></a>
                            <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <form id="formdelete-{{$idx}}" action="{{route('genders.destroy',$gender->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                        </form>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>

            <div class="loading">Loading...</div>

        </div>

    </div>

    <!--End Page Content Area-->


    {{-- START MODAL AREA --}}
        {{-- start edit model  --}}
            <div id="editmodal" class="modal fade">
                <div class="modal-dialog modal-sm modal-dialog-centered">
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
                                    <div class="col-md-8 form-group">
                                        <label for="editname">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="editname" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
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
            </div>
        {{-- end edit modal  --}}
    {{-- END MODAL AREA --}}


@endsection


@section('css')
    {{-- datatable css1 js1  --}}
    <link  href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" />

    <style type="text/css">
        .loading{
            font-weight: bold;

            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);

            display: none;
        }
    </style>
@endsection


@section('scripts')

{{-- datatable css1 js1  --}}
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
{{-- sweet alert js1--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">

        $(document).ready(function(){

            
            // Start Passing Header Token 
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            // End Passing Header Token 


            // Start fetch All Datas
            async function fetchalldatas(query=""){
                
                await $.ajax({
                    url:"{{url('api/genderssearch')}}",
                    method:"GET",
                    type:"json",
                    data:{"query":query},
                    success:function(response){
                        // console.log(response);

                        $('.loading').hide();

                        $("#mytable tbody").empty();

                        let datas = response.data;
                        // console.log(datas);

                        let html;

                        datas.forEach(function(data,idx){
                            // console.log(data);

                            html += `<tr id="delete_${data.id}">
                                        <td>
                                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="${data.id}" />
                                        </td>
                                        <td>${++idx}</td>
                                        <td>${data.name}</td>
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

                const getid = $(this).attr('data-id');
                $('#formaction').attr('action',`/genders/${getid}`);

                e.preventDefault();

            });
            // End Edit Form 

            // for mytable
            $('#mydata').DataTable();




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
                            url:'{{route("genders.bulkdeletes")}}',
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

