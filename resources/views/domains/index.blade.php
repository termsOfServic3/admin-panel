@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">My Domains</h1>
    <a href="{{ route('domains.create') }}" class="btn btn-primary">+ Add Domain</a>
</div>

@if($domains->isEmpty())
    <div class="alert alert-info">No domains yet. Add your first one!</div>
@else
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>URL</th>
                <th>Method</th>
                <th>Interval</th>
                <th>Status</th>
                <th>Last Checked</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($domains as $domain)
            <tr>
                <td>
                    <a href="{{ route('domains.show', $domain) }}">{{ $domain->url }}</a>
                </td>
                <td>{{ $domain->method }}</td>
                <td>{{ $domain->check_interval_minutes }} min</td>
                <td>
                    @if($domain->checks_max_checked_at)
                        @if($domain->checks_max_http_code && $domain->checks_max_http_code < 400)
                            <span class="badge bg-success">UP</span>
                        @else
                            <span class="badge bg-danger">DOWN</span>
                        @endif
                    @else
                        <span class="badge bg-secondary">Not checked</span>
                    @endif
                </td>
                <td>
                    {{ $domain->last_checked_at?->diffForHumans() ?? '—' }}
                </td>
                <td>
                    <a href="{{ route('domains.edit', $domain) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('domains.destroy', $domain) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this domain?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $domains->links() }}
@endif
@endsection