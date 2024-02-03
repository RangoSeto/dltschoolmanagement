@extends('layouts.adminindex')
@section('caption','Role List')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{route('roles.create')}}" class="btn btn-primary btn-sm rounded-0"> Create</a>

            <hr/>

            <div class="col-md-12">
                <form action="" method="">
                    <div class="row justify-content-end">
                        <div class="col-md-2 col-sm-6 mb-2">
                            <div class="form-group">
                                <select name="filterstatus_id" id="filterstatus_id" class="form-control form-control-sm rounded-0">
                                    {{-- <option value="" selected>Choose Status...</option> --}}
                                    @foreach($filterstatuses as $id=>$name)
                                      <option value="{{$id}}" {{$id == request('filterstatus_id') ? 'selected' : ''}}>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="col-md -12">
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
                        @foreach($roles as $idx=>$role)
                        <tr>
                            {{-- <td>{{++$idx}}</td> --}}
                            <td>{{$idx+ $roles->firstItem()}}</td>
                            <td><img src="{{asset($role->image)}}" class="rounded-circle" alt="{{$role->name}}" width="20" height="20"><a href="{{route('roles.show',$role->id)}}">{{$role->name}}</a></td>
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input change-btn" {{$role->status_id === 3 ? 'checked' : '' }} data-id="{{$role->id}}" />
                                </div>
                            </td>
                            <td>{{$role->user['name']}}</td>
                            <td>{{$role->created_at->format('d M Y')}}</td>
                            <td>{{$role->updated_at->format('d M Y')}}</td>
                            <td>
                                <a href="{{route('roles.edit',$role->id)}}" class="text-info"><i class="fas fa-pen"></i></a>
                                <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <form id="formdelete-{{$idx}}" action="{{route('roles.destroy',$role->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $roles->links('pagination::bootstrap-4') }}

            </div>
        </div>

    </div>

    <!--End Page Content Area-->

@endsection


@section('css')

@endsection


@section('scripts')

    <script type="text/javascript">

        // Start Filter
        const getfilterstatus = document.getElementById('filterstatus_id');
        getfilterstatus.addEventListener('click',function(){
            // const getstatusid = this.value;
            // const getstatusid = this.options[this.selectedIndex].value;
            const getstatusid = this.value || this.options[this.selectedIndex].value; // 3 3
            // console.log(getstatusid);

            const getcururl = window.location.href;

            // console.log(getcururl);
            // console.log(getcururl.split('?'));
            // console.log(getcururl.split('?')[0]);
            window.location.href = getcururl.split('?')[0] + '?filterstatus_id='+getstatusid;

        });
        // End Filter

        $(document).ready(function(){

            // Start delete btn 
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
            // End delete btn 

            
            // Start Change Btn
            $('.change-btn').change(function(){
                const getid = $(this).data('id');
                const setstatus = $(this).prop('checked') === true ? 3 : 4;

                $.ajax({
                    url:'rolesstatus',
                    type:"GET",
                    dataType:"json",
                    data:{"id":getid,"status_id":setstatus},
                    success:function(response){
                        console.log(response.success);
                    }
                });
            });
            // End Change Btn

        });
    </script>
@endsection