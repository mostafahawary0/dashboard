@extends('dashboard.layout')

@section('title','Newspaper')

@section('content')

<main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row" style="{{__('lang.rtl')}}">
                        <div class="col-sm-6">
                            <h3 class="mb-0"> {{__('lang.dashboard')}}</h3>
                        </div>
                         
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->

            @if(Auth::guard('web')->user()->role == 1)
            <div class="container">
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
@endif
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row"> <!--begin::Col-->
                        <div class="col-lg-4 col-6"> <!--begin::Small Box Widget 1-->
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3>{{$news->count()}} </h3>
                                    <h4>{{__('lang.NNews')}}</h4>
                                </div>  
                            </div> <!--end::Small Box Widget 1-->
                        </div> <!--end::Col-->
                        <div class="col-lg-4 col-6"> <!--begin::Small Box Widget 2-->
                            <div class="small-box text-bg-success">
                                <div class="inner">
                                    <h3>{{$sections->count()}}</h3>
                                    <h4>{{__('lang.NSections')}}</h4>
                                </div>   
                            </div> <!--end::Small Box Widget 2-->
                        </div> <!--end::Col-->
                        <div class="col-lg-4 col-6"> <!--begin::Small Box Widget 3-->
                            <div class="small-box text-bg-danger">
                                <div class="inner">
                                    <h2>{{$users->count()}}</h2>
                                    <h4>{{__('lang.users')}}</h4>
                                </div> 
                            </div> <!--end::Small Box Widget 3-->
                        </div> <!--end::Col-->
                       
                    </div> <!--end::Row--> <!--begin::Row-->
                    @if(Auth::guard('web')->user()->role == 1)
                    <div class="row"> <!-- Start col -->
                        <div class="col-lg-12 connectedSortable">
                             



                            <div class="card direct-chat direct-chat-primary mb-4">
                                <div class="card-header">
                              
                                <div class="card-body"> <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages"> <!-- Message. Default to the start -->
                                 
                                    @foreach($news as $new)
@php
$name= __('lang.NameSection')
@endphp

                                    <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix"> 
                                                <span class="direct-chat-name float-start">
                                                  <b style="color:green; text-transform: capitalize;">  {{$new->user->name}} </b>
                                                </span> <span class="direct-chat-timestamp float-end">
                                                {{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}
                                                </span> </div> <!-- /.direct-chat-infos --> 
                                                <img class="direct-chat-img"
                                                 src="{{asset('admin/assets/img/User-Icon.jpg')}}" alt="message user image"> <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                              {{__('lang.addNew')}} <b>  ( {{$new->section->$name}} )</b>
                                            </div> <!-- /.direct-chat-text -->
                                        </div> <!-- /.direct-chat-msg --> <!-- Message to the end -->
                                     @endforeach

                                    </div> <!-- /.direct-chat-messages--> <!-- Contacts are loaded here -->
                                 
                                    {{$news->links('pagination::bootstrap-4')}}
                                    
                                </div> <!-- /.card-body -->
                              <!-- /.card-footer-->
                            </div> <!-- /.direct-chat -->
                        </div> <!-- /.Start col --> <!-- Start col -->

                        @endif
                        
                    </div> <!-- /.row (main row) -->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> <!--begin::Footer-->

@endsection