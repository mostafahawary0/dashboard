
@extends('dashboard.layout')

@section('title',__('lang.users'))

@section('content')

<script>
function save()
{
field1 = document.getElementById('field1').value;
field3 = document.getElementById('field3').value;
x = true;

if(field1 == "")
{
document.getElementById('xfield1').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'> {{__('lang.Valid')}} </b>";
document.getElementById('field1').style.border = "1px solid #f00";
x = false;
}
else
{
document.getElementById('xfield1').innerHTML = "";
}

 
if(field3 == "")
{
document.getElementById('xfield3').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'>{{__('lang.Valid')}}  </b>";
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
 
<main class="app-main"  style="{{ __('lang.rtl') }} "> <!--begin::App Content Header-->

 <div class="container" style="padding:50px">  
    

 <div class="container-fluid py-2">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 py-3 px-0">
  
<li>
<a href="{{route('home')}}">{{__('lang.home')}} /</a>
</li>
<li  style="padding-left:10px; padding-right:10px;"> 
<a  href="{{route('users.index')}}">  
{{__('lang.users')}} / </li>
</a>
<li class="active">
<a > 
{{__('lang.Cusers')}}</a>
</li>

</ol>
</nav>
</div>

<div class="col-md-12"> <!--begin::Quick Example-->
                            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                                <div class="card-header">
                                    <div > <b> {{__('lang.Cusers')}}  </b></div>
                                </div> <!--end::Header--> <!--begin::Form-->
 
@if(session()->has('error'))

<div class="alert alert-danger">{{session('error')}}</div>

@endif



@if(session()->has('success'))

<div class="alert alert-success">{{session('success')}}</div>

@endif
                               
<form action="{{route('users.update',$user->id)}}"  method="POST"  onsubmit="return save()">
@method('PUT')
@csrf

<div class="card-body" >

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label">{{__('lang.name')}} </label>
<input type="text" name="name" id="field1"
class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}">
@error('name')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield1"></div>
</div>

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label">{{__('lang.email')}} </label>
<input type="text" name="email"  
class="form-control" value="{{$user->email}}" disabled>
  
 </div>

<div class="mb-3">
<label   class="form-label">{{__('lang.password')}} </label>
<input type="text" name="password" id="field3"
class="form-control @error('password') is-invalid @enderror" >
@error('password')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield3"></div>
</div>


<div class="mb-3">
<label  class="form-label"> {{__('lang.role')}} </label>
<select  name="role" class="form-control">



@if($user->role == 1)
 
<option  value="{{$user->role}}"> {{__('lang.admin')}} </option>

@else
 
@foreach(App\Models\permissions::where('uuid', $user->role)->get()->unique('uuid') as $permission)
@php
$name= __('lang.NamePermissions')
@endphp

<option  value="{{$user->role}}"> {{$permission->$name}} </option>
@endforeach
@endif

@foreach($sections->unique('uuid') as $section)
@php 
$name= __('lang.NamePermissions')
@endphp
<option value="{{$section->uuid}}"> {{$section->$name}} </option>
 @endforeach
 
 <option  value="1"> {{__('lang.admin')}} </option>
 
 </select>
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