<nav class="app-header navbar navbar-expand bg-body" > <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="{{route('home')}}" class="nav-link">
                    {{ __ ('lang.home') }}
                    </a> </li>
                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->

<li class="nav-item"> 
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
</li>

                   
                    
                    <li class="nav-item"> 
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                             <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> 
                             <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> 
                            </li> 
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> 
                        <img src="{{asset('admin/assets/img/User-Icon.jpg')}}" class="user-image rounded-circle shadow" alt="User Image"> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                 <img src="{{asset('admin/assets/img/User-Icon.jpg')}}" class="rounded-circle shadow" alt="User Image">
                                <p>
                                {{Auth::user()->name}} 
                                </p>
                            </li> <!--end::User Image--> <!--begin::Menu Body-->
                            <!--end::Menu Body--> <!--begin::Menu Footer-->
                            <li class="user-footer text-center">   
                            <a href="{{route('logout')}}" class="btn btn-default btn-flat float-end">Sign out</a>
                         </li> <!--end::Menu Footer-->
                        </ul>
                    </li> <!--end::User Menu Dropdown-->
                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->





        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
            <div class="sidebar-brand"> <!--begin::Brand Link--> 
                <a href="{{route('home')}}" class="brand-link"> <!--begin::Brand Image--> 
                <img src="{{asset('admin/assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text-->
                 <span class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" style="{{__('lang.rtl')}}"
                    data-lte-toggle="treeview" role="menu" data-accordion="false">
                    
                       <li class="nav-header" style="color:#fff">{{__('lang.dashboard')}}</li>

                        <li class="nav-item"> <a href="{{route('home')}}" class="nav-link">
                             <i class="nav-icon bi bi-speedometer"></i>
                        <p>{{__('lang.home')}}</p>
                        </a> 
                        </li>

         

                        @if(Auth::guard('web')->user()->role != 1)

                        <li class="nav-item"> <a href="#" class="nav-link">
                             <i class="nav-icon bi bi-newspaper"></i>
                                <p>
                                {{__('lang.news')}}
                                    <i class="nav-arrow bi bi-chevron-right" ></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
         
                          

@foreach(\App\Models\permissions::where('uuid',Auth::guard('web')->user()->role)->get() as $permission)

@php
$name= __('lang.NameSection')
@endphp

<li class="nav-item"> 
<a href="{{route('news',$permission->section->id)}}" class="nav-link"> 
<i class="nav-icon bi bi-circle"></i>
<p>{{$permission->section->$name}}</p>
</a>
</li>
 @endforeach
                            
                            </ul>
                        </li>

                    @endif



        @if(Auth::guard('web')->user()->role == 1)
 
       
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                                <p>
                                {{__('lang.StSection')}}
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> 
                                    <a href="{{route('section.create')}}" class="nav-link"> 
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>{{__('lang.CSections')}}</p>
                                    </a>
                                 </li>
                                
                                <li class="nav-item"> 
                                    <a href="{{route('section.index')}}" class="nav-link"> 
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>{{__('lang.sections')}}</p>
                                    </a>
                                 </li>
                                
                            </ul>
                        </li>
                      

                        <li class="nav-item"> <a href="#" class="nav-link"> 
                            <i class="nav-icon bi bi-person"></i>
                                <p>
                                {{__('lang.users')}}
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item"> 
                                <a href="{{route('users.index')}}" class="nav-link"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__('lang.users')}}</p>
                                </a>
                                </li>

                                <li class="nav-item"> 
                                <a href="{{route('users.create')}}" class="nav-link"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__('lang.AdUsers')}}</p>
                                </a>
                                </li>

                                <li class="nav-item"> 
                                <a href="{{route('permissions.index')}}" class="nav-link"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__('lang.permissions')}}</p>
                                </a>
                                </li>
                                
                                <li class="nav-item"> 
                                <a href="{{route('permissions.create')}}" class="nav-link"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__('lang.CPermissions')}}</p>
                                </a>
                                </li>

                                </ul>
                                </li>     
                             
                                
                        <li class="nav-item"> <a href="#" class="nav-link">
                             <i class="nav-icon bi bi-newspaper"></i>
                                <p>
                                {{__('lang.news')}}
                                    <i class="nav-arrow bi bi-chevron-right" ></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            @foreach(\App\Models\section::get() as $section)
                            
                            @php
                            $name= __('lang.NameSection')
                            @endphp

                
            <li class="nav-item"> 
            <a href="{{route('news',$section->id)}}"class="nav-link"> 
            <i class="nav-icon bi bi-circle"></i>
            <p>
            {{$section->$name}}
            </p>
            </a>
            </li>

 

                                 @endforeach
                                 
                            </ul>
                        </li>
                        @endif

                        <li class="nav-item"> 
                            <a href="{{route('password')}}" class="nav-link">
                             <i class="nav-icon bi bi-gear"></i>
                        <p>{{__('lang.settings')}}</p>
                        </a> 
                        </li>



                    </ul> <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar--> <!--begin::App Main-->