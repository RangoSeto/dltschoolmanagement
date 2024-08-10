@include('layouts.adminheader')


<div id="app">

    <!--Start Site Setting-->
    <div id="sitesettings" class="sitesettings">
    	<div class="sitesettings-item"><a href="javascript:void(0);" id="sitetoggle" class="sitetoggle"><i class="fas fa-cog ani-rotates"></i></a></div>
    </div>
    <!--End Site Setting-->

    {{-- Start Left Side Bar --}}
    @include('layouts.adminleftsidebar')
    {{-- End Left Side Bar --}}


    <!--Start Content Area-->
    <section>
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-lg-10 col-md-9 pt-md-5 mt-md-3 ms-auto">

                    {{-- Start Inner Content Area  --}}
                    <div class="row">
                        {{-- <h5>@yield('caption')</h5> --}}
                        {{-- <h6>{{ucfirst(\Request::path())}}</h6> --}}

                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{\Request::root()}}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{url()->previous()}}">{{ \Str::title(preg_replace('/[[:punct:]]+[[:alnum:]]+/','',str_replace(\Request::root().'/','',url()->previous()))) }}</a></li>
                                <li class="breadcrumb-item active">{{ucfirst(\Request::path())}}</li>
                            </ol>
                        </nav>



                        @yield('content')
                    </div>
                    {{-- End Inner Content Area  --}}

                 </div>
            </div>
        </div>
    </section>
    <!--End Content Area-->

</div>


@include('layouts.adminfooter')


                  
{{-- <p>{{\Request::root()}}</p>  {{-- http://127.0.0.1:8000 --}}
{{-- <p>{{\Request::fullUrl()}}</p>  {{-- http://127.0.0.1:8000/edulinks?filter=2 (အပေါ်urlကဟာအကုန်ရတာ)--}}
{{-- <p>{{\Request::url()}}</p>  {{-- http://127.0.0.1:8000/edulinks (routeတွေပဲပါလာတာ ?နောက်ကဟာမပါလာဘူး) --}}
{{-- <p>{{\Request::getRequestUri()}}</p>  {{-- /edulinks?filter=2&search=1 (main domain name ကလွဲလို့ကျန်တာအကုန်ပါလာတာ) --}}
{{-- <p>{{\Request::getPathInfo()}}</p>  {{-- /posts/1/edit (main domain နောက်က route တွေကအကုန်ကျလာတယ် query ? တွေေတာ့မပါဘူး) --}}
{{-- <p>{{\Request::path()}}</p>  {{-- posts/1/edit (အပေါ်ကဟာနဲ့အတူတူပဲ ရှေ့ဆံုးမှာ / ေလးမပါတာပဲရှိတာ) --}}


{{-- <p>{{request()->root()}}</p>  {{-- http://127.0.0.1:8000 --}}
{{-- <p>{{request()->fullUrl()}}</p>  {{-- http://127.0.0.1:8000/edulinks?filter=2 (အပေါ်ကဟာအကုန်ရတာ)--}}
{{-- <p>{{request()->url()}}</p>  {{-- http://127.0.0.1:8000/edulinks (routeတွေပဲပါလာတာ ?နောက်ကဟာမပါလာဘူး) --}}
{{-- <p>{{request()->getRequestUri()}}</p>  {{-- /edulinks?filter=2&search=1 (main domain name ကလွဲလို့ကျန်တာအကုန်ပါလာတာ) --}}
{{-- <p>{{request()->getPathInfo()}}</p>  {{-- /posts/1/edit (main domain နောက်က route တွေကအကုန်ကျလာတယ် query ? တွေေတာ့မပါဘူး) --}}
{{-- <p>{{request()->path()}}</p>  {{-- posts/1/edit (အပေါ်ကဟာနဲ့အတူတူပဲ ရှေ့ဆံုးမှာ / ေလးမပါတာပဲရှိတာ) --}}

{{-- Request:: request() ကြိုက်တာသံုးလို့ရတယ် အတူတူပဲ  --}}

{{-- <p>{{url()->full()}}</p>  {{-- http://127.0.0.1:8000/edulinks?filter=2 (same to fullUrl() in request) --}}
{{-- <p>{{url()->current()}}</p>  {{-- http://127.0.0.1:8000/edulinks (same to url() in request) --}}
{{-- <p>{{url()->previous()}}</p> {{--   http://127.0.0.1:8000/edulinks (recent link) (full url အတိုင်းယူတယ် ဒါေပမယ့်၁ဆင့်နောက်ကျပီးမှပေးတယ်) --}}
