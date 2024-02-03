@extends('layouts.adminindex')
@section('caption','City List')
@section('content')


    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">
            <form action="{{route('cities.store')}}" method="POST">

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
                            <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search..." value="{{request('filtername')}}" />
                            <button type="button" id="btn-search" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
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
                    @foreach($cities as $idx=>$city)
                    <tr>
                        {{-- <td>{{++$idx}}</td> --}}
                        <td>{{$idx+ $cities->firstItem()}}</td>
                        <td>{{$city->name}}</td>
                        <td>{{$city->user['name']}}</td>
                        <td>{{$city->created_at->format('d M Y')}}</td>
                        <td>{{$city->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$city->id}}" data-name="{{$city->name}}"><i class="fas fa-pen"></i></a>
                            <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <form id="formdelete-{{$idx}}" action="{{route('cities.destroy',$city->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $cities->links('pagination::bootstrap-4') }}

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

        // Start Filter
        const getfilterbtn = document.getElementById('btn-search');
        getfilterbtn.addEventListener('click',function(e){
            const getfiltername = document.getElementById('filtername').value;
            const getcururl = window.location.href;

            // console.log(getcururl); //http://127.0.0.1:8000/cities
            // console.log(getcururl.split('?')); // ['http://127.0.0.1:8000/cities','?filtername=yan']
            // console.log(getcururl.split('?')[0]); // http://127.0.0.1:8000/cities
            window.location.href = getcururl.split('?')[0] + '?filtername='+getfiltername; // ဒီမှာ splitမလုပ်လည်းရတယ်ရိုးရိုးဟာပဲရလာမှာမလို့


            e.preventDefault();

        });
        // End Filter

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
                $('#formaction').attr('action',`/cities/${getid}`);

                e.preventDefault();

            });
            // End Edit Form



        });

    </script>
@endsection

