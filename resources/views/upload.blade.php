@extends('layouts.master')
@section('content')
@include('layouts.partials.messages')
<form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
@csrf  
        <h1 class="h3 mb-3 fw-normal">Upload</h1>
        <div class="form-group form-floating mb-3">
            <input type="file" class="form-control" name="csv" value="{{ old('csv') }}" placeholder="Upload csv" required="required" accept=".csv">
            <label for="floatingPassword">Upload Csv</label>
            @if ($errors->has('csv'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
        
    </form>
            
@endsection