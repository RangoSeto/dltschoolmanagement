@extends('layouts.adminindex')
@section('caption','Contact List')
@section('content')


    <!--Start Page Content Area-->

    <div class="container-fluid">

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
                                <div class="form-group">
                                    <select name="filter" id="filter" class="form-control form-control-sm rounded-0">
                                        @foreach($relatives as $id=>$name)
                                          <option value="{{$id}}" {{$id == request('filter') ? 'selected' : ''}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-md-2 col-sm-6 mb-2">
                                <div class="input-group">
                                    <input type="text" name="search" id="search" class="form-control form-control-sm rounded-0" value="{{request('search')}}" placeholder="Search..." />
                                    <button type="button" id="btn-clear" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i></button>
                                    <button type="submit" id="btn-search" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
        
                        </div>
                    </form>
                </div>

            </div>

            <div class="col-md-12">
                <table id="mydata" class="table table-sm table-hover border">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                            </th>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                            <th>Relative</th>
                            <th>By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $idx=>$contact)
                        <tr id="delete_{{$contact->id}}">
                            <td>
                                <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$contact->id}}" />
                            </td>
                            <td>{{++$idx}}</td>
                            <td>{{$contact->firstname}}</td>
                            <td>{{$contact->lastname}}</td>
                            <td>{{$contact->birthday ? date('d M Y',strtotime($contact->birthday)) : ''}}</td>
                            <td>{{$contact->relative_id ? $contact->relative['name'] : ''}}</td>
                            <td>{{$contact->user['name']}}</td>
                            <td>{{$contact->created_at->format('d M Y')}}</td>
                            <td>{{$contact->updated_at->format('d M Y')}}</td>
                            <td>
                                <a href="javascript:void(0);" class="text-info editform" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$contact->id}}" data-firstname="{{$contact->firstname}}" data-lastname="{{$contact->lastname}}" data-birthday="{{$contact->birthday}}" data-relative="{{$contact->relative_id}}"><i class="fas fa-pen"></i></a>
                                <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <form id="formdelete-{{$idx}}" action="{{route('contacts.destroy',$contact->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    
                {{ $contacts->links() }}
                {{-- {{ $contacts->links('pagination::bootstrap-4') }} --}}
                {{-- {{ $contacts->links('pagination::bootstrap-5') }} --}}
                {{-- {{ $contacts->appends(request()->only('filter'))->links() }} --}}
                {{-- {{ $contacts->appends(request()->only('filter','search'))->links() }} --}}
                
    
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
                    <form id="" action="{{route('contacts.store')}}" method="POST">

                        {{ csrf_field() }}

                        <div class="row align-items-end">
                            <div class="col-md-6 form-group">
                                <label for="firstname">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" placeholder="Enter First name" value="{{old('firstname')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" placeholder="Enter Last name" value="{{old('lastname')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" name="birthday" id="birthday" class="form-control form-control-sm rounded-0"  value="{{old('birthday')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="relative_id">Relative <span class="text-danger">*</span></label>
                                <select type="text" name="relative_id" id="relative_id" class="form-control form-control-sm rounded-0">
                                    @foreach($relatives as $id=>$name)
                                    <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col d-flex justify-content-end">
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
                                    <div class="col-md-6 form-group">
                                        <label for="editfirstname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="firstname" id="editfirstname" class="form-control form-control-sm rounded-0">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="editlastname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" id="editlastname" class="form-control form-control-sm rounded-0">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="editbirthday">Birthday <span class="text-danger">*</span></label>
                                        <input type="date" name="birthday" id="editbirthday" class="form-control form-control-sm rounded-0">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="editrelative_id">Relative <span class="text-danger">*</span></label>
                                        <select type="text" name="relative_id" id="editrelative_id" class="form-control form-control-sm rounded-0">
                                            @foreach($relatives as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col d-flex justify-content-end mt-2">
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

{{-- sweet alert js1--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">

        // Start Filter 
        document.getElementById('filter').addEventListener('click',function(){
            let getfilterid = this.value || this.options[this.selectedIndex].value;
            window.location.href = window.location.href.split('?')[0]+'?filter='+getfilterid;
        });
        // End Filter 


        // Start btn  Clear
        document.getElementById('btn-clear').addEventListener('click',function(){
            const getfilter = document.getElementById('filter');
            const getsearch = document.getElementById('search');

            getfilter.selectedIndex = 0;
            getsearch.value = "";

            window.location.href = window.location.href.split("?")[0];

        });
        // End btn Clear


        // Start Auto Btn Clear
        const autoshowbtn = function(){
            let getbtnclear = document.getElementById('btn-clear');
            let geturlquery = window.location.search; // ?filter=6&search=9
            // const.log(geturlquery);
            let pattern = /[?&]search=/;

            if(pattern.test(geturlquery)){
                getbtnclear.style.display = "block";
            }else{
                getbtnclear.style.display = "none";
            }
        };

        autoshowbtn();
        // End Auto Btn Clear



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

                $('#editfirstname').val($(this).data('firstname'));
                $('#editlastname').val($(this).data('lastname'));
                $('#editbirthday').val($(this).data('birthday'));
                $('#editrelative_id').val($(this).data('relative'));

                const getid = $(this).data('id');
                $('#formaction').attr('action',`/contacts/${getid}`);

                e.preventDefault();

            });
            // End Edit Form

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
                            url:'{{route("contacts.bulkdeletes")}}',
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
