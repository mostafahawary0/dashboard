
@extends('dashboard.layout')

@section('title',__('lang.permissions'))

@section('content')

<script>
function save()
{
field1 = document.getElementById('field1').value;
field2 = document.getElementById('field2').value;
field3 = document.getElementById('field3').value;
 
x = true;

if(field1 == "")
{
document.getElementById('xfield1').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'> {{__('lang.ValidPrAR')}} </b>";
document.getElementById('field1').style.border = "1px solid #f00";
x = false;
}
else
{
document.getElementById('xfield1').innerHTML = "";
}

if(field2 == "")
{
document.getElementById('xfield2').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'> {{__('lang.ValidPrEN')}} </b>";
document.getElementById('field2').style.border = "1px solid #f00";
x = false;
}
else
{
document.getElementById('xfield2').innerHTML = "";
}

if(field3 == "")
{
document.getElementById('xfield3').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'>{{__('lang.ValidPrFR')}}  </b>";
document.getElementById('field3').style.border = "1px solid #f00";
x = false;
}
else
{
document.getElementById('xfield3').innerHTML = "";
}

 
 
return x;			
}

</script>
 <style>
    .b{
        font-weight:bold;
        color: #000;
    }
 </style>
<main class="app-main"  style="{{ __('lang.rtl') }} "> <!--begin::App Content Header-->

 <div class="container" style="padding:50px">  
    

 <div class="container-fluid py-2">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 py-3 px-0">
  
<li>
<a href="{{route('home')}}">{{__('lang.home')}} /</a>
</li>
<li  style="padding-left:10px; padding-right:10px;"> 
<a  href="{{route('permissions.index')}}">  
{{__('lang.permissions')}} / </li>
</a>
<li class="active">
<a > 
{{__('lang.CPermissions')}}</a>
</li>

</ol>
</nav>
</div>

<div class="col-md-12"> <!--begin::Quick Example-->
                            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                                <div class="card-header">
                                    <div > <b> {{__('lang.edit')}}  </b></div>
                                </div> <!--end::Header--> <!--begin::Form-->
 
@if(session()->has('error'))

<div class="alert alert-danger">{{session('error')}}</div>

@endif



@if(session()->has('success'))

<div class="alert alert-success">{{session('success')}}</div>

@endif


<div class="card-body" >
<div class="col-lg-12"> 
<div><label for="exampleInputEmail1" class="form-label b">{{__('lang.permissionsSection')}} </label></div>
@foreach($Namepermissions as $permissions)
@foreach(App\Models\section::where('id', $permissions->section_id)->get() as $section)

@php
$name= __('lang.NameSection')
@endphp
<button type="button" class="btn btn" style="font-size:14px;"
data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$permissions->id}}">
<i class="nav-icon bi bi-trash" style="color:red"></i>
</button>
{{$section->$name}}  

<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$permissions->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
        <form action="{{route('permissions.destroyOne',$permissions->id)}}" method="post">
          @method('DELETE')
          @csrf
        <button type="submit" class="btn btn-primary">{{__('lang.delete')}} </button>
         </form>
      </div>
    </div>
  </div>
</div>
<br>
@endforeach
 @endforeach
 <br>
<br>
 </div>
                               



<form action="{{route('permissions.updateAll',$permissions->uuid)}}" method="POST"  
enctype="multipart/form-data" onsubmit="return save()">
@csrf
@foreach($Namepermissions->unique('uuid') as $permissions)

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label b">{{__('lang.NUserPermissionsAR')}} </label>
<input type="text" name="nameAR" id="field1"
class="form-control @error('nameAR') is-invalid @enderror" value="{{$permissions->permissionsAR}}" placeholder="{{__('lang.PHPermissions')}}">
@error('nameAR')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield1"></div>
</div>

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label b">{{__('lang.NUserPermissionsEN')}} </label>
<input type="text" name="nameEN" id="field2"
class="form-control @error('nameEN') is-invalid @enderror" value="{{$permissions->permissionsEN}}" placeholder="{{__('lang.PHPermissions')}}">
@error('nameEN')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield2"></div>
</div>

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label b">{{__('lang.NUserPermissionsFR')}} </label>
<input type="text" name="nameFR" id="field3"
class="form-control @error('nameFR') is-invalid @enderror" value="{{$permissions->permissionsFR}}" placeholder="{{__('lang.PHPermissions')}}">
@error('nameFR')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield3"></div>
</div>

@endforeach

<div class="mb-3">
<div>
<label for="exampleInputEmail1" class="form-label b">{{__('lang.CSections')}} </label></div>


 @foreach($sections as $section)

 @php
$name= __('lang.NameSection')
@endphp
<input type="checkbox" class="item" name="section[]" value="{{$section->id}}">  {{$section->$name}}
 <br>
 @endforeach

 <div id="xfieldCheckbox"></div>
 
</div>


</div> <!--end::Body--> <!--begin::Footer-->

<div class="card-footer" style="background:#fff"> 
  <button type="submit" class="btn btn-primary">{{__('lang.submit')}}</button> 
</div> <!--end::Footer-->
</form> <!--end::Form-->


                            </div> <!--end::Quick Example--> <!--begin::Input Group-->
                        </div> <!--end::Col--> <!--begin::Col-->
                        </div> 
                        </div> 
</main>
                        @endsection