@extends('layouts.adminindex')
@section('caption','Role Show')
@section('content')

    <!--Start Page Content Area-->

    <div class="container-fluid">

        <div class="col-md-12">

            <a href="{{route('roles.index')}}" class="btn btn-secondary btn-sm rounded-0"> Close</a>

            <hr/>

            <div class="row">
                <div class="col-md-4">

                    <div class="card rounded-0">
                        <div class="card-body">
                            <h5 class="card-title">{{$role->name}} | <span class="text-muted">{{$role->status["name"]}}</span></h5>
                        </div>

                        <ul class="list-group text-center">
                            <li class="list-group-item fw-bold"><img src="{{asset($role->image)}}" alt="{{$role->name}}" width="200"></li>
                        </ul>

                        <div class="card-body">
                           <div class="row">
                                <div class="col-md-6">
                                    <i class="fas fa-user fa-sm"></i> <span>{{$role["user"]["name"]}}</span>
                                </div>

                                <div class="col-md-6">
                                    <i class="fas fa-calendar fa-sm"></i> <span>{{date('d M Y',strtotime($role->updated_at))}} | {{date('h:i:s A',strtotime($role->updated_at))}}</span>
                                    <br/>
                                    <i class="fas fa-edit fa-sm"></i> <span>{{date('d M Y h:i:s A',strtotime($role->updated_at))}}</span>
                                </div>
                           </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="card-box rounded-0">

                        <ul class="list-group text-center rounded-0">
                            <li class="list-group-item active">Information</li>
                        </ul>

                        {{-- start remark  --}}
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Remark Here</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nothing to show</td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- end remark  --}}

                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--End Page Content Area-->

@endsection

@section('scripts')

@endsection