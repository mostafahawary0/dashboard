
@extends('dashboard.layout')

@section('title',__('lang.sections'))

@section('content')
<style>
  a{text-decoration:none; font-weight:bold;}
</style>
<main class="app-main"  style="{{ __('lang.rtl') }}"> <!--begin::App Content Header-->

 <div  style="padding:50px" >

<div class="container-fluid py-2">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 py-3 px-0">
  
<li><a href="{{route('home')}}" style="padding-left:10px; padding-right:10px;">{{__('lang.home')}} / </a></li>
 <li> {{__('lang.CPass')}} </li>

</ol>  
</nav>
</div>

  

            <section class="pt-0"> 
          <div class="container-fluid">

          <div class="col-lg-12">
                <div class="card">
              

                  <div class="card-body pt-10">

                    
 

@if(session()->has('error'))

<div class="alert alert-danger">{{session('error')}}</div>

@endif



@if(session()->has('success'))

<div class="alert alert-success">{{session('success')}}</div>

@endif

    <form action="{{route('update.password')}}" method="POST" enctype="multipart/form-data">
    @csrf

               
        <h5 class="h4 mb-0"> {{__('lang.CPass')}} </h5> <br>

  
      <input   type="hidden" name="email"  
      value="{{Auth::user()->email}}" type="text">
  
 

    <div class="mb-3">
    <label class="form-label">{{__('lang.OPass')}} </label>
     <input name="old" class="form-control @error('old') is-invalid @enderror"  type="password">
    @error('old')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror   
  </div>
 
                         
    <div class="mb-3">
    <label class="form-label">{{__('lang.NPass')}}  </label>
    <input  name="new"  class="form-control @error('new') is-invalid @enderror"  type="password">
        @error('new')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror 
    </div>
                 
    <div class="mb-3">
    <label class="form-label">{{__('lang.COPass')}}  </label>
    <input  name="confirm"  class="form-control @error('confirm') is-invalid @enderror"  type="password">
        @error('confirm')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror 
    </div>
                 
                

                      <button class="btn btn-primary" type="submit">{{__('lang.submit')}} </button>
                   
                    </form>

                  </div>
                </div>
              </div>

            
</div> 
          @endsection  
