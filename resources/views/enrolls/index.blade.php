@extends('layouts.adminindex')
@section('caption','Enrolls List')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
            <form action="{{route('enrolls.store')}}" method="POST">

                {{ csrf_field() }}

                <div class="row align-items-end">

                    <div class="col-md-3 form-group">
                        <label for="classdate">Class Date <span class="text-danger">*</span></label>
                        <input type="date" name="classdate" id="classdate" class="form-control form-control-sm rounded-0" value="{{old('classdate')}}">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="post_id">Class <span class="text-danger">*</span></label>
                        <select name="post_id" id="post_id" class="form-control form-control-sm rounded-0">
                            @foreach($posts as $post)
                                {{-- <option value="{{$enroll['id']}}">{{$enroll['title']}}</option> --}} {{-- don't use[''] if you try with DB:: --}}
                                <option value="{{$post->id}}">{{$post->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="attcode">attendance Code <span class="text-danger">*</span></label>
                        <input type="text" name="attcode" id="attcode" class="form-control form-control-sm rounded-0" value="{{old('attcode')}}">
                    </div>

                    <div class="col-md-3">
                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                    </div>

                </div>

            </form>
        </div>

        <hr/>

        <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0 mb-3">Bulk Delete</a>


        <div class="col-md-12">

            <table id="mydata" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                        </th>
                        <th>No</th>
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Stage</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrolls as $idx=>$enroll)
                    <tr id="delete_{{$enroll->id}}">
                        <td>
                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$enroll->id}}" />
                        </td>
                        {{-- <p>{{$enroll}}</p> --}}
                        <td>{{++$idx}}</td>
                        {{-- <td>{{$enroll->student($enroll->user_id)}}</td> --}}
                        <td><a href="{{route('students.show',$enroll->studenturl())}}">{{$enroll->student()}}</a></td>
                        <td>{{$enroll->post['title']}}</td>
                        <td>{{$enroll->stage->name}}</td>
                        <td>{{$enroll->created_at->format('d M Y')}}</td>
                        <td>{{$enroll->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0);" class="text-primary me-2 quickform" data-bs-toggle="modal" data-bs-target="#quickmodal" data-id="{{$enroll->id}}" data-remark="{{$enroll->remark}}" data-stage="{{$enroll->stage_id}}"><i class="fas fa-user-check"></i></a>
                            <a href="javascript:void(0);" class="text-info " data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$enroll->id}}" data-remark="{{$enroll->remark}}" data-stage_id="{{$enroll->stage_id}}"><i class="fas fa-pen"></i></a>
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
        <div id="quickmodal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">

                    <div class="modal-header">
                        <h6 class="modal-title">Quick Form</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="quickformaction" action="" method="">

                            <div class="row align-items-end">


                                <div class="col-md-3 form-group">
                                    <label for="editstage_id">Stage <span class="text-danger">*</span></label>
                                    <select name="editstage_id" id="editstage_id" class="form-control form-control-sm rounded-0">
                                        @foreach($stages as $stage)
                                            <option value="{{$stage->id}}">{{$stage->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-7 form-group">
                                    <label for="editremark">Remark</label>
                                    <input type="text" name="editremark" id="editremark" class="form-control form-control-sm rounded-0" rows="1" value="{{old('remark')}}" />
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


        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){


            // Start Edit Form
            $(document).on('click','.quickform',function(){

                $('#editstage_id').val($(this).data('stage'));
                $('#editremark').val($(this).data('remark'));

                const getid = $(this).data('id');
                // console.log(getid);

                $('#quickformaction').attr('data-id',getid);

            });

            $('#quickformaction').submit(function(e){
                e.preventDefault();

                const getid = $(this).attr('data-id');

                $.ajax({
                    url:`enrolls/${getid}`,
                    type:"PUT",
                    dataType:'json',
                    data:$(this).serialize(),
                    success:function(response){
                        if(response && response.status === "success"){
                            const getdata = response.data;
                            $('#quickmodal').modal('hide');
                        }
                    }
                })

            })


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
                            url:'{{route("enrolls.bulkdeletes")}}',
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

