@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="h3 mb-4">Add Domain</h1>

        <form action="{{ route('domains.store') }}" method="POST">
            @csrf
            @include('domains._form')
            <button type="submit" class="btn btn-primary w-100">Add Domain</button>
        </form>
    </div>
</div>
@endsection