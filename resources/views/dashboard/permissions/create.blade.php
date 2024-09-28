
@extends('dashboard.layout')

@section('title',__('lang.permissions'))

@section('content')

<script>
function save()
{
field1 = document.getElementById('field1').value;
field2 = document.getElementById('field2').value;
field3 = document.getElementById('field3').value;
let checkboxes = document.querySelectorAll('input[name="section[]"]:checked');

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

 
if (checkboxes.length === 0) {
        document.getElementById('xfieldCheckbox').innerHTML = "<b style='font-size:17px; font-weight:bold; color:#f00;'>{{__('lang.ValiCheckbox')}} </b>";
        x = false;
    } else {
        document.getElementById('xfieldCheckbox').innerHTML = "";
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
                                    <div > <b> {{__('lang.CPermissions')}}  </b></div>
                                </div> <!--end::Header--> <!--begin::Form-->
 
@if(session()->has('error'))

<div class="alert alert-danger">{{session('error')}}</div>

@endif



@if(session()->has('success'))

<div class="alert alert-success">{{session('success')}}</div>

@endif
                               
<form action="{{route('permissions.store')}}" method="POST"  enctype="multipart/form-data" onsubmit="return save()">
@csrf

<div class="card-body" >

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label b">{{__('lang.NUserPermissionsAR')}} </label>
<input type="text" name="permissionsAR" id="field1"
class="form-control @error('permissionsAR') is-invalid @enderror" value="{{old('permissionsAR')}}" placeholder="{{__('lang.PHPermissions')}}">
@error('permissionsAR')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield1"></div>
</div>

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label b">{{__('lang.NUserPermissionsEN')}} </label>
<input type="text" name="permissionsEN" id="field2"
class="form-control @error('permissionsEN') is-invalid @enderror" value="{{old('permissionsEN')}}" placeholder="{{__('lang.PHPermissions')}}">
@error('permissionsEN')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield2"></div>
</div>

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label b">{{__('lang.NUserPermissionsFR')}} </label>
<input type="text" name="permissionsFR" id="field3"
class="form-control @error('permissionsFR') is-invalid @enderror" value="{{old('permissionsFR')}}" placeholder="{{__('lang.PHPermissions')}}">
@error('permissionsFR')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield3"></div>
</div>

<div class="mb-3">
<div>
<label for="exampleInputEmail1" class="form-label b">{{__('lang.permissionsSection')}} </label></div>

 
<input type="checkbox" class="select-all">{{__('lang.all')}} 
<br>
@foreach($sections as $section)

@php
$name= __('lang.NameSection')
@endphp

<input type="checkbox" class="item" name="section[]" value="{{$section->id}}">  {{$section->$name}}
<br>
 @endforeach
 
 @error('section')
<div class="alert alert-danger">{{ $message }}</div>
@enderror  
 <div id="xfieldCheckbox"></div>
 
</div>


</div> <!--end::Body--> <!--begin::Footer-->

<div class="card-footer"> 
  <button type="submit" class="btn btn-primary">{{__('lang.submit')}}</button> 
</div> <!--end::Footer-->
</form> <!--end::Form-->
                            </div> <!--end::Quick Example--> <!--begin::Input Group-->
                        </div> <!--end::Col--> <!--begin::Col-->
                        </div> 
                        </div> 
</main>
                        @endsection