@extends('layouts.app-master')

@section('content')
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        <table class="" id="DataTable" >
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile No</th>
                                            <th scope="col">Street 1</th>
                                            <th scope="col">Street 2</th>
                                            <th scope="col">City</th>
                                            <th scope="col">State</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">Lead Source</th>
                                            <th scope="col">Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($lists)>0)
                                        @foreach($lists as $list)
                                        <tr>
                                                <th scope="col">{{$loop->iteration}}</th>
                                                <th scope="col">{{$list->first_name}}</th>
                                                <th scope="col">{{$list->last_name}}</th>
                                                <th scope="col">{{$list->email}}</th>
                                                <th scope="col">{{$list->mobile_no}}</th>
                                                <th scope="col">{{$list->street1}}</th>
                                                <th scope="col">{{$list->street2}}</th>
                                                <th scope="col">{{$list->city}}</th>
                                                <th scope="col">{{$list->state}}</th>
                                                <th scope="col">{{$list->country}}</th>
                                                <th scope="col">{{$list->lead_source}}</th>
                                                <th scope="col">{{$list->status}}</th>
                                                
                                            </tr>  
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="12">No data</td>
                                            </tr>
                                            @endif
                                    </tbody>
                                </table>
        </div>
    </body>
@endsection