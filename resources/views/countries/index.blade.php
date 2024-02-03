@extends('layouts.adminindex')
@section('caption','Country List')
@section('content')


    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
            <form action="{{route('countries.store')}}" method="POST">
    
                {{ csrf_field() }}
        
                <div class="row align-items-end">
                    <div class="col-md-6 form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter name" value="{{old('name')}}">
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
                    @foreach($countries as $idx=>$country)
                    <tr>
                        {{-- <td>{{++$idx}}</td> --}}
                        <td>{{$idx+ $countries->firstItem()}}</td>
                        <td>{{$country->name}}</td>
                        <td>{{$country->user['name']}}</td>
                        <td>{{$country->created_at->format('d M Y')}}</td>
                        <td>{{$country->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$country->id}}" data-name="{{$country->name}}"><i class="fas fa-pen"></i></a>
                            <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <form id="formdelete-{{$idx}}" action="{{route('countries.destroy',$country->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $countries->links('pagination::bootstrap-4') }}

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
    
@endsection


@section('scripts')

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
                $('#formaction').attr('action',`/countries/${getid}`);

                e.preventDefault();

            });
            // End Edit Form 

        });

    </script>
@endsection

