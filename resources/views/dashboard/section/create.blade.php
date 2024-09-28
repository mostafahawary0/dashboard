
@extends('dashboard.layout')

@section('title',__('lang.sections'))

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
document.getElementById('xfield1').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'> {{__('lang.ValidSecAR')}} </b>";
document.getElementById('field1').style.border = "1px solid #f00";
x = false;
}
else
{
document.getElementById('xfield1').innerHTML = "";
}

if(field2 == "")
{
document.getElementById('xfield2').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'> {{__('lang.ValidSecEN')}} </b>";
document.getElementById('field2').style.border = "1px solid #f00";
x = false;
}
else
{
document.getElementById('xfield2').innerHTML = "";
}

if(field3 == "")
{
document.getElementById('xfield3').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'>{{__('lang.ValidSecFR')}}  </b>";
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
<a  href="{{route('section.index')}}">  
{{__('lang.sections')}} / </li>
</a>
<li class="active">
<a > 
{{__('lang.CSections')}}</a>
</li>

</ol>
</nav>
</div>

<div class="col-md-12"> <!--begin::Quick Example-->
                            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
                                <div class="card-header">
                                    <div > <b> {{__('lang.AdNewSection')}}  </b></div>
                                </div> <!--end::Header--> <!--begin::Form-->
 
@if(session()->has('error'))

<div class="alert alert-danger">{{session('error')}}</div>

@endif



@if(session()->has('success'))

<div class="alert alert-success">{{session('success')}}</div>

@endif
                               
<form action="{{route('section.store')}}" method="POST"  onsubmit="return save()">
@csrf

<div class="card-body" >

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label">{{__('lang.CSectionsLangAR')}} </label>
<input type="text" name="nameAR" id="field1"
class="form-control @error('nameAR') is-invalid @enderror" value="{{old('nameAR')}}">
@error('nameAR')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield1"></div>
</div>

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label">{{__('lang.CSectionsLangEN')}} </label>
<input type="text" name="nameEN" id="field2"
class="form-control @error('nameEN') is-invalid @enderror" value="{{old('nameEN')}}">
@error('nameEN')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield2"></div>
</div>

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label">{{__('lang.CSectionsLangFR')}} </label>
<input type="text" name="nameFR" id="field3"
class="form-control @error('nameFR') is-invalid @enderror" value="{{old('nameFR')}}">
@error('nameFR')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield3"></div>
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