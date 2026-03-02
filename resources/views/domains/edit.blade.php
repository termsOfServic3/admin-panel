@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="h3 mb-4">Edit Domain</h1>

        <form action="{{ route('domains.update', $domain) }}" method="POST">
            @csrf
            @method('PUT')
            @include('domains._form')
            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        </form>
    </div>
</div>
@endsection