
@extends('dashboard.layout')

@section('title',__('lang.sections'))

@section('content')

<script>
function save()
{
field1 = document.getElementById('field1').value;
field2 = document.getElementById('field2').value;
 x = true;

if(field1 == "")
{
document.getElementById('xfield1').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'> {{__('lang.ValidTitle')}} </b>";
document.getElementById('field1').style.border = "1px solid #f00";
x = false;
}
else
{
document.getElementById('xfield1').innerHTML = "";
}

if(field2 == "")
{
document.getElementById('xfield2').innerHTML = " <b style='font-size:17px; font-weight:bold;  color:#f00;'> {{__('lang.ValidContnent')}} </b>";
document.getElementById('field2').style.border = "1px solid #f00";
x = false;
}
else
{
document.getElementById('xfield2').innerHTML = "";
}

 
return x;			
}

</script>
 

@php
$name= __('lang.NameSection')
@endphp
<main class="app-main"  style="{{ __('lang.rtl') }} "> <!--begin::App Content Header-->

 <div class="container" style="padding:50px">  
    

 <div class="container-fluid py-2">
 <nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 py-3 px-0">
  
<li>
<a href="{{route('home')}}">{{__('lang.home')}} /</a>
</li>
<li  style="padding-left:10px; padding-right:10px;"> 
<a  href="{{route('news',$sections->section_id)}}">  


@php
$name= __('lang.NameSection')
@endphp

 {{$sections->section->$name}} / 
</li>
</a>
<li class="active">
<a href="{{route('create.news',$sections->section_id)}}"> 
{{__('lang.CNews')}}  / </a>
</li>

<li class="active" style="padding-left:10px; padding-right:10px;">
{{__('lang.edit')}} 
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
                               
<form action="{{route('news.update',$sections->id)}}" method="POST"  enctype="multipart/form-data" onsubmit="return save()">
@method('PUT')
@csrf
<div class="card-body" >

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label">{{__('lang.title')}} </label>
<input type="text" name="title" id="field1"
class="form-control @error('title') is-invalid @enderror" value="{{$sections->title}}">
@error('title')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield1"></div>
</div>

<div class="mb-3">
<label for="exampleInputEmail1" class="form-label">{{__('lang.content')}} </label>
<textarea type="text" name="content" id="field2"
class="form-control @error('content') is-invalid @enderror" rows="6"> {{$sections->content}}</textarea>
@error('content')
<div class="alert alert-danger">{{ $message }}</div>
@enderror   
<div id="xfield2"></div>
</div>

<div class="mb-3">

<img src="{{asset('img/'.$sections->image)}}" style="width:100px; height:100px">
<label for="exampleInputEmail1" class="form-label">{{__('lang.image')}} </label>
<input type="file" name="img" id="field3"
class="form-control @error('img') is-invalid @enderror">
@error('img')
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