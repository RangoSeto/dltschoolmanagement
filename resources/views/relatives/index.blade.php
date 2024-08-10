@extends('layouts.adminindex')
@section('caption','Relative List')
@section('content')


    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="#createmodal" class="btn btn-primary btn-sm rounded-0" data-bs-toggle="modal">Create</a>

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
                    @foreach($relatives as $idx=>$relative)
                    <tr  id="delete_{{$relative->id}}">
                        <td>
                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$relative->id}}" />
                        </td>
                        <td>{{++$idx}}</td>
                        <td>{{$relative->name}}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input change-btn" {{ $relative->status_id === 3 ? 'checked' : '' }} data-id="{{$relative->id}}" />
                            </div>
                        </td>
                        <td>{{$relative->user['name']}}</td>
                        <td>{{$relative->created_at->format('d M Y')}}</td>
                        <td>{{$relative->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$relative->id}}" data-name="{{$relative->name}}" data-status="{{$relative->status_id}}"><i class="fas fa-pen"></i></a>
                            <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <form id="formdelete-{{$idx}}" action="{{route('relatives.destroy',$relative->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                    <form id="" action="{{route('relatives.store')}}" method="POST">

                        {{ csrf_field() }}

                        <div class="row align-items-end">
                            <div class="col-md-7 form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="status_id">Status <span class="text-danger">*</span></label>
                                <select type="text" name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                    @foreach($statuses as $status)
                                    <option value="{{$status['id']}}">{{$status['name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm rounded-0">Submit</button>
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
            <div id="editmodal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0">

                        <div class="modal-header">
                            <h6 class="modal-title">Edit Form</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <form id="formaction" action="" method="POST">

                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="row align-items-end">
                                    <div class="col-md-7 form-group">
                                        <label for="editname">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="editname" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="editstatus_id">Status <span class="text-danger">*</span></label>
                                        <select type="text" name="status_id" id="editstatus_id" class="form-control form-control-sm rounded-0">
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
            // End Delete Item


            // Start Edit Form
            $(document).on('click','.editform',function(e){

                $('#editname').val($(this).data('name'));
                $('#editstatus_id').val($(this).data('status'));

                const getid = $(this).attr('data-id');
                $('#formaction').attr('action',`/relatives/${getid}`);

                e.preventDefault();

            });
            // End Edit Form

            // for mytable
            // $('#mytable').DataTable();


            // Start Change Btn
            $('.change-btn').change(function(){
                const getid = $(this).data('id');
                const setstatus = $(this).prop('checked') == true ? 3 : 4;

                $.ajax({
                    url:"relativesstatus",
                    type:"GET",
                    dataType:"json",
                    data:{"id":getid,"status_id":setstatus},
                    success:function(response){
                        console.log(response.success);
                    }
                });
            });
            // End Change Btn


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

{{--
Day (Sunday)
ploymorph(many to many) --}}
