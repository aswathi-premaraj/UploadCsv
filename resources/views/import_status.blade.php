@extends('layouts.app-master')

@section('content')
@include('layouts.partials.messages')
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        <table class="" id="DataTable" >
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">File Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Reason</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lists as $list)
                                        <tr>
                                                <th scope="col">{{$loop->iteration}}</th>
                                                <th scope="col">{{$list->file_name}}</th>
                                                <th scope="col">@if($list->status==0) Not finised @else finished @endif</th>
                                                <th scope="col">{{$list->reason}}</th>
                                                <th scope="col"><a href="{{route('list.csv',encrypt($list->id))}}">Click Here</a></th>
                                                
                                            </tr>  
                                            @endforeach
                                    </tbody>
                                </table>
        </div>
    @endsection