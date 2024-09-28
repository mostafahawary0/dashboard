
@extends('dashboard.layout')

@section('title',__('lang.news'))

@section('content')
<style>
  a{text-decoration:none; font-weight:bold;}
</style>
<main class="app-main"  style="{{ __('lang.rtl') }}"> <!--begin::App Content Header-->

@php
$name= __('lang.NameSection')
@endphp

 <div  style="padding:50px" >

<div class="container-fluid py-2">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 py-3 px-0">
  
<li>
<a href="{{route('home')}}">{{__('lang.home')}} /</a>
</li>
<li class="active" style="padding-left:10px; padding-right:10px;">  {{$sections->$name}} / </li>

<li>
<a href="{{route('create.news',$sections->id)}}"> 
{{__('lang.CNews')}} </a>
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
                    <div> <h4> <b>  {{$sections->$name}} </b> </h4>
                        
                        </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-responsive">


                    <div class="container mt-5">
    <h4>      <i data-lte-icon="maximize" class="bi bi-search"></i>  {{__('lang.Search')}}</h4>
    <input type="text" id="search" class="form-control" placeholder="{{__('lang.SNews')}}">
    <ul id="results" class="list-group mt-3"></ul>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
 $(document).ready(function() {
    $('#search').on('keyup', function() {
        var query = $(this).val();

        if (query !== "") {
            $.ajax({
                url: "{{ route('news.search') }}",
                type: 'GET',
                data: { query: query },
                success: function(data) {
                    $('#results').empty();

                    data.forEach(function(item) {
                        var link = '<a href="' + '{{ route("news.edit", ":id") }}'.replace(':id', item.id) + '" class="list-group-item list-group-item-action">' + item.title + '</a>';
                        $('#results').append(link);
                    });
                }
            });
        } else {
            $('#results').empty();
        }
    });
});

</script>


 
@php 
use App\Models\news;
$value = news::where('section_id' , $sections->id)->get() 
@endphp
<br>
<div> <h6> {{__('lang.NNews')}}: {{$value->count()}} </h6> </div>

 
                      <table class="table mb-0 table-striped">
                        <thead>
                          <tr>
                            <th>{{__('lang.title')}} </th>
                            <th>{{__('lang.image')}} </th>
                            <th>{{__('lang.publisher')}} </th>
                            <th>{{__('lang.time')}} </th>
                            <th style="text-align:center;" colspan="2">{{__('lang.settings')}} </th>
                          </tr>
                        </thead>
                        <tbody>

                        @foreach($news as $new)
<tr>
<td style="font-size:18px">{{$new->title}}</td>
<td >
<img src="{{asset('img/'.$new->image)}}" style="width:50px; height:50px">
</td>

<td>
{{$new->user->name}} 
</td>

 
<td >{{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</td>
 

<td style=" text-align:center;">
<a href="{{route('news.edit',$new->id)}}" type="button" class="btn btn-primary" style="font-size:14px;">
<i class="nav-icon bi bi-pencil-square"></i> {{__('lang.edit')}} </a>
</td>
<td style="text-align:center;">                         
                          
<button type="button" class="btn btn-danger" style="font-size:14px;"
data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$new->id}}">
<i class="nav-icon bi bi-trash"></i>
{{__('lang.delete')}} 
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$new->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
        <form action="{{route('news.destroy',$new->id)}}" method="post">
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
                      {{$news->links('pagination::bootstrap-4')}}
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