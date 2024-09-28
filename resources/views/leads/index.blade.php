@extends('layouts.adminindex')
@section('caption','Lead List')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{route('students.create')}}" class="btn btn-info btn-sm rounded-0 me-2"> Student</a>
            <a href="{{route('leads.create')}}" class="btn btn-primary btn-sm rounded-0"> Create</a>

            <hr/>

            <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0 mb-3">Bulk Delete</a>

            <table id="mydata" class="table table-sm table-hover border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lead Number</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Pipe</th>
                        <th>By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $idx=>$lead)
                    <tr id="delete_{{$lead->id}}">
                        
                        <td>{{++$idx}}</td>
                        <td><a href="{{route('leads.show',$lead->id)}}">{{$lead->leadnumber}}</a></td>
                        <td>{{$lead->firstname}} {{$lead->lastname}}</td>
                        <td>{{$lead->gender['name']}}</td>
                        <td>{{$lead->age}}</td>
                        <td>{{$lead->email}}</td>
                        <td><span class="badge {{$lead->converted ? 'bg-success' : 'bg-danger'}}">Pipe</span></td>
                        <td>{{$lead->user['name']}}</td>
                        <td>{{$lead->created_at->format('d M Y')}}</td>
                        <td>{{$lead->updated_at->format('d M Y')}}</td>
                        <td>
                            <a href="{{route('leads.edit',$lead->id)}}" class="text-info"><i class="fas fa-pen"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!--End Page Content Area-->

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


            

        });
    </script>
@endsection