<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> @yield('title','Login')  </title> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{asset('admin/css/adminlte.css')}}">
    <!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
</head> <!--end::Head--> <!--begin::Body-->

 

<body class="login-page bg-body-secondary" style="{{ __ ('lang.rtl') }} {{ __ ('lang.FontB') }}">

<div class="btn-group" role="group"> 
<button type="button" class="btn  dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false">
<img  src="{{asset('admin/assets/img/lang.png')}}" style="width:20px;"> {{ __ ('lang.langauge') }}
</button>
<ul class="dropdown-menu">
<li> <a class="dropdown-item" href="{{route('languageConvert','en')}}"> English </a> </li>
<li> <a class="dropdown-item" href="{{route('languageConvert','ar')}}"> العربية </a> </li>
<li> <a class="dropdown-item" href="{{route('languageConvert','fr')}}"> Français</a> </li>
</ul>
</div>
 
    <div class="login-box">
        <div class="login-logo">  <b>{{ __ ('lang.login') }}</b>  </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                
@if($errors->any())
<div class="col-12">

@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}} </div>
@endforeach

</div>
@endif


@if(session()->has('error'))

<div class="alert alert-danger">{{session('error')}}</div>

@endif



@if(session()->has('success'))

<div class="alert alert-success">{{session('success')}}</div>

@endif


                 <form action="{{route('login.post')}}"method="post">
                @csrf
                    <div class="input-group mb-3"> 
                        <input type="email" class="form-control" placeholder="{{__('lang.email')}} " name="email">
                        <div class="input-group-text"> 
                            <span class="bi bi-envelope"></span> 
                        </div>
                    </div>
                    <div class="input-group mb-3"> 
                        <input type="password" class="form-control" placeholder="{{__('lang.password')}} " name="password">
                        <div class="input-group-text"> 
                            <span class="bi bi-lock-fill"></span> 
                    </div>
                    </div> <!--begin::Row-->
                    <div class="row">
                      
                        <div class="col-12">
                            <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">{{__('lang.login')}} </button> </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
             
             
            </div> <!-- /.login-card-body -->
        </div>
    </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{asset('admin/js/adminlte.js')}}"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->
</body><!--end::Body-->

</html>