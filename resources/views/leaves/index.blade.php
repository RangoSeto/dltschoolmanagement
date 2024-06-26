@extends('layouts.adminindex')
@section('caption','Leave List')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{route('leaves.create')}}" class="btn btn-primary btn-sm rounded-0"> Create</a>

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
                                        <option value="" selected>Choose Class</option>
                                        @foreach($posts as $id=>$title)
                                          <option value="{{$id}}" {{$id == request('filter') ? 'selected' : ''}}>{{$title}}</option>
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

            <table id="mytable" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                        </th>
                        <th>No</th>
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Tag</th>
                        <th>Stage</th>
                        <th>By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $idx=>$leave)
                    <tr id="delete_{{$leave->id}}">
                        <td>
                            <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$leave->id}}" />
                        </td>
                        {{-- <td>{{++$idx}}</td> --}}
                        <td>{{$idx+ $leaves->firstItem()}}</td>
                        <td><a href="{{route('students.show',$leave->studenturl())}}">{{$leave->student($leave->user_id)}}</a></td>
                        <td><a href="{{route('posts.show',$leave->post_id)}}">{{$leave->post['title']}}</a></td>
                        <td>{{$leave->startdate}}</td>
                        <td>{{$leave->enddate}}</td>
                        <td>{{$leave->tagperson['name']}}</td>
                        <td>{{$leave->stage['name']}}</td>
                        <td>{{$leave['user']['name']}}</td>
                        <td>{{$leave->created_at->format('d M Y')}}</td>
                        <td>{{$leave->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="{{route('leaves.show',$leave->id)}}" class="text-primary"><i class="fas fa-book-reader"></i></a>
                            <a href="{{route('leaves.edit',$leave->id)}}" class="text-info ms-2"><i class="fas fa-pen"></i></a>
                            <a href="#" class="text-danger ms-2 delete-btns" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <form id="formdelete-{{$idx}}" action="{{route('leaves.destroy',$leave->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{$leaves->links()}}
            
        </div>

    </div>

    <!--End Page Content Area-->

@endsection

@section('css')
@endsection

@section('scripts')
{{-- sweet alert js1--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            // start delete btn alert
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
            // end delete btn alert


        // Start Filter 
        document.getElementById('filter').addEventListener('click',function(){
            let getfilterid = this.value || this.options[this.selectedIndex].value;
            // console.log(getfilterid);
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
                            url:'{{route("leaves.bulkdeletes")}}',
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

