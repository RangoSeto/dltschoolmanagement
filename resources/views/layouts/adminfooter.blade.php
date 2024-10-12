
    <!--Start Footer Section-->
    <footer class="footers">
    	<div class="container-fluid">
    		<div class="row border-top pt-3">
    			<div class="col-lg-10 col-md-8 ms-auto">
    				<div class="row border-top pt-3">
    					<div class="col-lg-6 text-center">
    						<ul class="list-inline">
    							<li class="list-inline-item me-2">
    								<a href="#" class="text-dark">Data Land Technology Co.,Ltd</a>
    							</li>
    							<li class="list-inline-item me-2">
    								<a href="#" class="text-dark">About</a>
    							</li>
    							<li class="list-inline-item me-2">
    								<a href="#" class="text-dark">Contact</a>
    							</li>
    						</ul>
    					</div>
    					<div class="col-lg-6 text-center">
    						<p>&copy; <span id="getyear"></span> Copyright, All Rights Reserved</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </footer>
    <!--End Footer Section-->

    <!--Start Right Navbar-->
    <div class="right-panels">

		<form action="" method="">
			<input type="text" name="usersearch" id="usersearch" class="form-control form-control-sm rounded-0 mb-2" placeholder="Search..." />
		</form>
    	
		<ul id="onoffusers" class="list-group list-group-flush">

			@foreach($onlineusers as $onlineuser)
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<div>
						<div class="small">{{ $onlineuser->name }}</div>
						<div class="text-muted">{{ \Carbon\Carbon::parse($onlineuser->last_active)->format('h:m:s a') }}</div>
					</div>
					<div class="text-success">
						<i class="fas fa-circle fa-xs"></i>
					</div>
				</li>
			@endforeach

		</ul>

    	<hr/>

    	<div class="themecolors">
    		<a href="javascript"><i class="fas fa-square text-primary shadow fa-lg"></i></a>
    		<a href="javascript"><i class="fas fa-square text-secondary shadow fa-lg"></i></a>
    		<a href="javascript"><i class="fas fa-square text-info shadow fa-lg"></i></a>
    		<a href="javascript"><i class="fas fa-square text-success shadow fa-lg"></i></a>
    		<a href="javascript"><i class="fas fa-square text-warning shadow fa-lg"></i></a>
    		<a href="javascript"><i class="fas fa-square text-danger shadow fa-lg"></i></a>
    		<a href="javascript"><i class="fas fa-square text-muted shadow fa-lg"></i></a>
    		<a href="javascript"><i class="fas fa-square text-white shadow fa-lg"></i></a>
    		<a href="javascript"><i class="fas fa-square text-dark shadow fa-lg"></i></a>
    		<a href="javascript"><i class="fas fa-square text-light shadow fa-lg"></i></a>
    	</div>
    </div>
    <!--End Right Navbar-->


	{{-- START MODAL AREA  --}}
		{{-- Start Quicksearch Modal  --}}
			<div id="quicksearchmodal" class="modal fade">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content rounded-0">
						<div class="modal-header">
							<h6 class="modal-title">Result</h6>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>

						<div class="modal-body">
							<ul class="list-group">

							</ul>
						</div>

						<div class="modal-footer">

						</div>
					</div>
				</div>
			</div>
		{{-- End Quicksearch Modal  --}}
	{{-- END MODAL AREA  --}}

        <!--bootstrap css1 js1-->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> --}}

        <!--jquery js 1-->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript"></script>

        <!-- jqueryui css1 js1 -->
        <script src="{{asset('assets/libs/jquery-ui-1.13.2.custom/jquery-ui.min.js')}}" type="text/javascript"></script>

		{{-- axios js1  --}}
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <!-- Google Chart -->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<!-- chartjs js1 -->
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		<!-- Raphael must be included before justgage -->
		<!-- https://github.com/toorshia/justgage#getting-started -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.9/justgage.min.js"></script>

		{{-- toastr css1 js1  --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
		<script>
			toastr.options = {
				"progressBar":true,
				"closeButton":true
			}
		</script>

		
			@if(Session::has('success'))
				<script>toastr.success('{{session()->get('success')}}', 'Successful')</script>
			@endif

			@if(session()->has('info'))
				<script>toastr.info('{{session()->get('info')}}', 'Information')</script>
			@endif

			@if(session()->has('error'))
				<script>toastr.error("{{session()->get('error')}}", 'Inconceivable')</script>
			@endif

			@if($errors)
				@foreach($errors->all() as $error)
					<script>toastr.error('{{$error}}','Warning!',{timeOut:3000})</script>
				@endforeach
			@endif

        <!--custom js-->
        {{-- <script src="{{asset('assets/dist/js/app.js')}}" type="text/javascript"></script> --}}
		@vite(['public/assets/dist/js/app.js'])

		{{-- extra js --}}
		@yield('scripts')

		<script>

			// Start Quick Search
			$('#quicksearch-btn').on('click',function(e){
				e.preventDefault();

				quicksearch();
			});

			async function quicksearch(){
				const getsearch = $('#quicksearch').val();
				
				await $.post('{{route("students.quicksearch")}}',
					{
						_token : $('meta[name="csrf-token"]').attr('content'),
						keyword:getsearch
					}
				,function(response){
					// console.log(response);
					showresulttodom(response);
				});

			}

			function showresulttodom(response){
				console.log(response);

				let newlis = "";

				$("#quicksearchmodal").modal("show"); // toggle

				if(response.datas.length <= 0){
					newlis += `<li class="list-group-item">No Data</li>`;
				}else{
					for(let x=0; x < response.datas.length; x++){
						newlis += `<li class="list-group-item"><a href="{{URL::to('students/${response.datas[x].id}')}}">${response.datas[x].regnumber} / ${response.datas[x].firstname} ${response.datas[x].lastname}</a></li>`;
					}
				}

				$("#quicksearchmodal .modal-body ul.list-group").html(newlis);
				// clear form 
				// $("#quicksearchform")[0].reset();
				$("#quicksearchform").trigger("reset");

			}
			// End Quick Search


			// Start OnOffuser Search

			var getusersearch = document.getElementById('usersearch');
			var getonoffusers = document.getElementById('onoffusers');
			var getonoffuserlis = getonoffusers.getElementsByTagName('li');
			// console.log(getonoffusers); //HTML Collection

			getusersearch.addEventListener('keyup',filter);

			function filter(){
				// console.log(this.value);

				var filter = this.value.toLowerCase();
				// console.log(filter);

				for(var x=0; x < getonoffuserlis.length; x++){
					// console.log(getli[x]);
					// console.log(getli[x].querySelector('a').innerText.toLowerCase());
					// console.log(getli[x].getElementsByTagName('a')[0].textContent.toLowerCase());

					var getlink = getonoffuserlis[x].getElementsByTagName('div')[1];

					var getdivtext = getlink.innerText.toLowerCase();

					if(getdivtext.indexOf(filter) > -1){
						getonoffuserlis[x].classList.remove('d-none');
					}else{
						getonoffuserlis[x].classList.add('d-none');
					}


				}
			}

			// End OnOffuser Search



            // Start Dynamic Select Option 
            // $(document).on('change','.country_id',function(){
                                
			// 	const getcountryid = $(this).val();
			// 	// console.log(getcountryid);
				
			// 	let opforcity = "";
			// 	let opforregion = "";
				
			// 	$.ajax({
			// 		url:`/api/filter/cities/${getcountryid}`,
			// 		type:"GET",
			// 		dataType:'json',
			// 		success:function(response){
			// 			// console.log(response);
					
			// 			$('.city_id').empty();
					
			// 			opforcity += `<option selected disabled>Choose a city</option>`;
					
			// 			for(let x = 0; x < response.data.length; x++){
			// 				opforcity += `<option value="${response.data[x].id}">${response.data[x].name}</option>`;
			// 			}
					
			// 			$('.city_id').append(opforcity);
			// 		},
			// 		error:function(response){
			// 			console.log("Error : ",response);
			// 		}
			// 	});
			// });
				
			// End Dynamic Select Option 

		</script>
    </body>
</html>
