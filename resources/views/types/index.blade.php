@extends('layouts.adminindex')
@section('caption','Type List')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
            <form action="{{route('types.store')}}" method="POST">
    
                {{ csrf_field() }}
        
                <div class="row align-items-end">

                    <div class="col-md-4 form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Type name" value="{{old('name')}}">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="status_id">Status <span class="text-danger">*</span></label>
                        <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                            @foreach($statuses as $status)
                            <option value="{{$status['id']}}">{{$status['name']}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="col-md-4">
                        <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                    </div>

                </div>
        
            </form>
        </div>

        <hr/>

        <div class="col-md-12">

            <table id="mydata" class="table table-sm table-hover border">
                <thead>
                    <tr>
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
                    @foreach($types as $idx=>$type)
                    <tr>
                        <td>{{++$idx}}</td>
                        <td>{{$type->name}}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input change-btn" {{$type->status_id === 3 ? 'checked' : ''}} data-id="{{$type->id}}" />
                            </div>
                        </td>
                        <td>{{$type->user['name']}}</td>
                        <td>{{$type->created_at->format('d M Y')}}</td>
                        <td>{{$type->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$type->id}}" data-name="{{$type->name}}" data-status="{{$type->status_id}}"><i class="fas fa-pen"></i></a>
                            <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <form id="formdelete-{{$idx}}" action="{{route('types.destroy',$type->id)}}" method="POST">
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


    <script type="text/javascript">

        $(document).ready(function(){

            // Start Edit Form 
            $(document).on('click','.editform',function(e){

                $('#editname').val($(this).attr('data-name'));
                $('#editstatus_id').val($(this).data('status'));

                const getid = $(this).attr('data-id');
                $('#formaction').attr('action',`/types/${getid}`);

                e.preventDefault();

            });
            // End Edit Form 


            // Start Delete Form 
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
            // End Delete Form 


            // for mytable
            $('#mydata').DataTable();


            // Start Change btn
            $('.change-btn').change(function(){

                var getid = $(this).data('id');
                // console.log(getid);
                var setstatus = $(this).prop('checked') === true ? 3 : 4;
                console.log(setstatus);

                $.ajax({
                    url:"typesstatus",
                    type:"GET",
                    dataType:"json",
                    data:{"id":getid,"status_id":setstatus},

                    success:function(response){
                        // console.log(response);
                        console.log(response.success);
                    }
                });

            });

            // End Change btn


        });
    </script>
@endsection

