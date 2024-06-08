@extends('layouts.adminindex')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
            <form id="createform">


                <div class="row align-items-end">

                    <div class="col-md-3 form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Type name" value="{{old('name')}}">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="paymenttype_id">Status <span class="text-danger">*</span></label>
                        <select name="paymenttype_id" id="paymenttype_id" class="form-control form-control-sm rounded-0">
                            @foreach($paymenttypes as $paymenttype)
                            <option value="{{$paymenttype['id']}}">{{$paymenttype['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="status_id">Status <span class="text-danger">*</span></label>
                        <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                            @foreach($statuses as $status)
                            <option value="{{$status['id']}}">{{$status['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" id="create-btn" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
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

            <table id="mytable" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                        </th>
                        <th>No</th>
                        <th>Name</th>
                        <th>Payment type</th>
                        <th>Status</th>
                        <th>By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentmethods as $idx=>$paymentmethod)
                    <tr id="delete_{{$paymentmethod->id}}">
                        <td>
                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$paymentmethod->id}}" />
                        </td>
                        <td>{{++$idx}}</td>
                        <td>{{$paymentmethod->name}}</td>
                        <td>{{$paymentmethod->paymenttype['name']}}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input change-btn" {{$paymentmethod->status_id === 3 ? 'checked' : ''}} data-id="{{$paymentmethod->id}}" />
                            </div>
                        </td>
                        <td>{{$paymentmethod->user['name']}}</td>
                        <td>{{$paymentmethod->created_at->format('d M Y')}}</td>
                        <td>{{$paymentmethod->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$paymentmethod->id}}" data-name="{{$paymentmethod->name}}" data-status="{{$paymentmethod->status_id}}" data-paymenttype="{{$paymentmethod->paymenttype_id}}"><i class="fas fa-pen"></i></a>
                            {{-- <a href="javascript:void(0);" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a> --}}
                            <a href="javascript:void(0);" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}" data-id="{{$paymentmethod->id}}"><i class="fas fa-trash-alt"></i></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!--End Page Content Area-->


    {{-- START MODAL AREA --}}
        {{-- start edit model  --}}
        <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">

                    <div class="modal-header">
                        <h6 class="modal-title">Edit Form</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="formaction" action="" method="">

                            <div class="row align-items-end">
                                <div class="col-md-4 form-group">
                                    <label for="editname">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="editname" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="editpaymenttype_id">Payment Type <span class="text-danger">*</span></label>
                                    <select name="paymenttype_id" id="editpaymenttype_id" class="form-control form-control-sm rounded-0">
                                        @foreach($paymenttypes as $paymenttype)
                                        <option value="{{$paymenttype['id']}}">{{$paymenttype['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="editstatus_id">Status <span class="text-danger">*</span></label>
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
        </div>
    {{-- end edit modal  --}}
{{-- END MODAL AREA --}}

@endsection


@section('css')
    {{-- datatable css1 js1  --}}
    <link  href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" />
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
            // Start Passing Header Token



            // Start Create Form
            $("#create-btn").click(function(e){
                e.preventDefault();

                $.ajax({
                    url:"{{ route('paymentmethods.store') }}",
                    type:"POST",
                    dataType:"json",
                    data:$("#createform").serialize(),
                    // data:$("#createform").serializeArray(),
                    success:function(response){
                        // console.log(response); // {status: 'success', data: {…}}
                        // console.log(response.status); // success
                        // console.log(this.data); // name=truemoney&status_id=3

                        const data = response.data;

                        $("#mytable").prepend(
                            `<tr id="${'delete_'+data.id}">
                                <td>
                                    <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="${data.id}" />
                                </td>
                                <td>${data.id}</td>
                                <td>${data.name}</td>
                                <td>${data.paymenttype_id}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input change-btn" ${data.status_id === "3" ? 'checked' : ''} data-id="${data.id}" />
                                    </div>
                                </td>
                                <td>${data.user_id}</td>
                                <td>${data.created_at}</td>
                                <td>${data.updated_at}</td>
                                <td>
                                    <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}" data-status="${data.status_id}"><i class="fas fa-pen"></i></a>
                                    <a href="javascript:void(0);" class="text-danger ms-2 delete-btns" data-idx="" data-id="${data.id}"><i class="fas fa-trash-alt"></i></a>
                                </td>

                            </tr>
                            `
                        );

                    },
                    error:function(response){
                        console.log("Error : ",response);
                    }
                });
            });

            // End Create Form



            // Start Edit Form
            $(document).on('click','.editform',function(){

                $('#editname').val($(this).attr('data-name'));
                $('#editpaymenttype_id').val($(this).data('paymenttype'));
                $('#editstatus_id').val($(this).data('status'));

                const getid = $(this).attr('data-id');
                // console.log(getid);
                $('#formaction').attr('data-id',getid); // send id to formaction for request id from submit action

            });

            $('#formaction').submit(function(e){

                e.preventDefault();

                const getid = $(this).attr('data-id');
                // const getid = 6;
                // console.log(getid);

                $.ajax({
                    url:`paymentmethods/${getid}`,
                    type:"PUT",
                    dataType:"json",
                    data:$("#formaction").serialize(), // name=kpay&status_id=4
                    success:function(response){
                        // console.log(this.data); // name=kpay&status_id=3
                        // console.log(response);
                        // console.log(response.status);
                        $('#editmodal').modal('hide');

                        window.location.reload(); // temp reload
                    }

                });

                // console.log('hello');

            });

            // End Edit Form


            // Start Delete Form

            // By ajax

            $('.delete-btns').click(function(){
                const getidx = $(this).attr('data-idx');
                const getid = $(this).data('id');

                if(confirm(`Are you sure !!! You want to Delete ${getidx} ?`)){

                    // ui remove

                    // data remove
                    $.ajax({
                        url:`paymentmethods/${getid}`,
                        type:"DELETE",
                        dataType:"json",
                        // data:{_token:"{{csrf_token()}}"},
                        success:function(response){
                            if(response && response.status === "success"){
                                const getdata = response.data;
                                $(`#delete_${getdata.id}`).remove();
                            }
                        }
                    });

                    return true;
                }else{
                    return false;
                }

            });

            // End Delete Form



            // for mytable
            // $('#mytable').DataTable();


            // Start Change btn
            $('.change-btn').change(function(){

                var getid = $(this).data('id');
                // console.log(getid);
                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                console.log(setstatus);

                $.ajax({
                    url:"paymentmethodsstatus",
                    type:"GET",
                    dataType:"json",
                    data:{"id":getid,"status_id":setstatus},

                    success:function(response){
                        // console.log(response);
                        console.log(response.success);

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
                            url:'{{route("days.bulkdeletes")}}',
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

