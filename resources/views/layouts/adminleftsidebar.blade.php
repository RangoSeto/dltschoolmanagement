    <!--Start Left Navbar-->
    <div class="wrappers">
        <nav class="navbar navbar-expand-md navbar-light">
        	<button type="button" class="navbar-toggler ms-auto mb-2" data-bs-toggle="collapse" data-bs-target="#nav">
        		<span class="navbar-toggler-icon"></span>
        	</button>

            <div id="nav" class="navbar-collapse collapse">
                <div class="container-fluid">
                    <div class="row">
                    	<!-- Start Left Sidebar -->
                        <div class="col-lg-2 col-md-3 fixed-top vh-100 overflow-auto sidebars">
                        	<ul class="navbar-nav flex-column mt-4">
	                            <li class="nav-item nav-categories">Main</li>
	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-tachometer-alt fa-md me-3"></i>Dashboard</a></li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks currents" data-bs-toggle="collapse" data-bs-target="#pagelayout"><i class="fas fa-cloud-download-alt fa-md me-3"></i> Download <i class="fas fa-angle-left mores"></i></a>

	                            <ul id="pagelayout" class="collapse ps-2">
	                                <li><a href="{{route('edulinks.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Education</a></li>
	                                <li><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Software</a></li>
	                            </ul>

	                            </li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#sidebarlayout"><i class="fas fa-file-alt fa-md me-3"></i>Form <i class="fas fa-angle-left mores"></i></a>

	                                <ul id="sidebarlayout" class="collapse ps-2">
	                                    <li><a href="{{route('attendances.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Att Form</a></li>
	                                    <li><a href="{{route('leaves.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Leave Form</a></li>
	                                    <li><a href="{{route('enrolls.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Enrolls</a></li>
	                                </ul>

	                            </li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-file-alt fa-md me-3"></i>Widgets</a></li>

	                            <li class="nav-item nav-categories">UI Features</li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#basicui"><i class="fas fa-file-alt fa-md me-3"></i>Articles <i class="fas fa-angle-left mores"></i></a>

	                                <ul id="basicui" class="collapse ps-2">
	                                    <li><a href="{{route('posts.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Post</a></li>
	                                    <li><a href="{{route('announcements.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Annoucement</a></li>

	                                </ul>

	                            </li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#advanceui"><i class="fas fa-users fa-md me-3"></i>Students <i class="fas fa-angle-left mores"></i></a>

	                                <ul id="advanceui" class="collapse ps-2">
	                                    <li><a href="{{route('students.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>All Students</a></li>

	                                </ul>

	                            </li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-file-alt fa-md me-3"></i>Popus</a></li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#iconelement"><i class="fas fa-share-alt-square fa-md me-3"></i>Apps <i class="fas fa-angle-left mores"></i></a>

	                                <ul id="iconelement" class="collapse ps-2">
	                                    <li><a href="{{route('contacts.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Contacts</a></li>
	                                    <li><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Todo</a></li>
	                                </ul>

	                            </li>

	                            <li class="nav-item nav-categories">Data Representation</li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#chartelement"><i class="fas fa-file-alt fa-md me-3"></i>Fixed Analysis <i class="fas fa-angle-left mores"></i></a>

	                                <ul id="chartelement" class="collapse ps-2">
	                                    <li><a href="{{route('days.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Day</a></li>
	                                    <li><a href="{{route('categories.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Categories</a></li>
	                                    <li><a href="{{route('stages.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Stage</a></li>
	                                    <li><a href="{{route('statuses.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Status</a></li>
	                                    <li><a href="{{route('tags.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Tags</a></li>
	                                    <li><a href="{{route('types.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Types</a></li>

	                                </ul>

	                            </li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#tableelement"><i class="fas fa-file-alt fa-md me-3"></i>Add On <i class="fas fa-angle-left mores"></i></a>

	                                <ul id="tableelement" class="collapse ps-2">
	                                    <li><a href="{{route('cities.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>City</a></li>
	                                    <li><a href="{{route('countries.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Country</a></li>
	                                    <li><a href="{{route('genders.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Gender</a></li>
	                                    <li><a href="{{route('relatives.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Relative</a></li>
	                                    <li><a href="{{route('roles.index')}}" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Roles</a></li>
	                                </ul>

	                            </li>

	                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks" data-bs-toggle="collapse" data-bs-target="#mapelement"><i class="fas fa-file-alt fa-md me-3"></i>Maps <i class="fas fa-angle-left mores"></i></a>

	                                <ul id="mapelement" class="collapse ps-2">
	                                    <li><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Google Map</a></li>
	                                    <li><a href="javascript:void(0);" class="nav-link text-white p-3 mb-2 sidebarlinks"><i class="fas fa-long-arrow-alt-right me-4"></i>Vector Map</a></li>
	                                </ul>

	                            </li>

	                        </ul>
                        </div>
                        <!-- End Left Sidebar -->

                        <!-- Start Top Sidebar -->
                        @include('layouts.adminnavbar')
                        <!-- End Top Sidebar -->
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!--End Left Navbar-->
