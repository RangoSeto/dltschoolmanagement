@extends('layouts.adminindex')
@section('caption','Gender List')
@section('content')


    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
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

        <div class="col-md-12">

            <table id="mydata" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($genders as $idx=>$gender)
                    <tr>
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
                    @endforeach
                </tbody>
            </table>
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
@endsection


@section('scripts')

{{-- datatable css1 js1  --}}
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/javascript"></script>

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

        });

    </script>
@endsection

