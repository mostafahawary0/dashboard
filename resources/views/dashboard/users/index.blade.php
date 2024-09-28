
@extends('dashboard.layout')

@section('title',__('lang.users'))

@section('content')
<style>
  a{text-decoration:none; font-weight:bold;}
</style>
<main class="app-main"  style="{{ __('lang.rtl') }}"> <!--begin::App Content Header-->

 <div  style="padding:50px" >

<div class="container-fluid py-2">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 py-3 px-0">
  
<li>
<a href="{{route('home')}}">{{__('lang.home')}} /</a>
</li>
<li class="active" style="padding-left:10px; padding-right:10px;"> {{__('lang.users')}} / </li>

<li >
<a href="{{route('users.create')}}"> 
{{__('lang.Cusers')}}</a>
</li>

</ol>
</nav>
</div>

       

@if(session()->has('error'))
<div class="alert alert-danger">{{session('error')}}</div>
@endif



@if(session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif

            <section class="tables py-0">
          <div class="container-fluid">
            <div class="row gy-4">
      
              <div class="col-lg-12">
                <div class="card mb-0">
                  <div class="card-header" style="{{__('lang.rtl')}}">
                    <div> <b> {{__('lang.sections')}}  </b> </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">



 
@php 
use App\Models\user;
$value = user::get() 
@endphp
<br>
<div> <h6> {{__('lang.users')}}: {{$value->count()}} </h6> </div>


                      <table class="table mb-0 table-striped">
                        <thead>
                          <tr>
                            <th>{{__('lang.name')}} </th>
                            <th>{{__('lang.email')}} </th>
                            <th>{{__('lang.permissions')}} </th>
                            <th style="text-align:center;" colspan="2">{{__('lang.settings')}} </th>
                          </tr>
                        </thead>
                        <tbody>

                        @foreach($sections as $section)
<tr>
<td style="font-size:18px">{{$section->name}}</td>
<td style="font-size:18px">{{$section->email}}</td>
<td style="font-size:18px">
@if($section->role == 1)
{{__('lang.admin')}} 

@else
 
 @foreach(App\Models\permissions::where('uuid', $section->role)->get()->unique('uuid') as $permission)

 @php
$name= __('lang.NamePermissions')
@endphp

<a href=""> {{$permission->$name}} </a>
 @endforeach
@endif


</td>
<td style=" text-align:center;">
<a href="{{route('users.edit',$section->id)}}" type="button" class="btn btn-primary" style="font-size:14px;">
<i class="nav-icon bi bi-pencil-square"></i> {{__('lang.edit')}} </a>
</td>
<td style="text-align:center;">                         
                          
<button type="button" class="btn btn-danger" style="font-size:14px;"
data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$section->id}}">
<i class="nav-icon bi bi-trash"></i>
{{__('lang.delete')}} 
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$section->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
       <i class="fa fa-trash" aria-hidden="true" style="color:#E95F71;"></i>  
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      {{__('lang.ArSDelete')}} 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('lang.no')}} </button>
        <form action="{{route('users.destroy',$section->id)}}" method="post">
          @method('DELETE')
          @csrf
        <button type="submit" class="btn btn-primary">{{__('lang.delete')}} </button>
         </form>
      </div>
    </div>
  </div>
</div>




                          </td>
                          </tr>
                          @endforeach
                          
                         
                        </tbody>
                      </table>
                      {{$sections->links('pagination::bootstrap-4')}}
                    </div>
                  </div>
                </div>
              </div>
         
            </div>
          </div>
        </section>



</div>
</div>
            
</main>
        
@endsection