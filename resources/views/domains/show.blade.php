@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">{{ $domain->url }}</h1>
        <small class="text-muted">{{ $domain->method }} · every {{ $domain->check_interval_minutes }} min</small>
    </div>
    <div>
        <a href="{{ route('domains.edit', $domain) }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="{{ route('domains.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Checked At</th>
            <th>Status</th>
            <th>HTTP Code</th>
            <th>Response Time</th>
            <th>Error</th>
        </tr>
    </thead>
    <tbody>
        @forelse($checks as $check)
        <tr>
            <td>{{ $check->checked_at->format('Y-m-d H:i:s') }}</td>
            <td>
                <span class="badge bg-{{ $check->status === 'UP' ? 'success' : 'danger' }}">
                    {{ $check->status }}
                </span>
            </td>
            <td>{{ $check->http_code ?? '—' }}</td>
            <td>{{ $check->response_time_ms ?? '—' }} ms</td>
            <td class="text-danger small">{{ $check->error_message ?? '—' }}</td>
        </tr>
        @empty
            <tr><td colspan="5" class="text-center">No checks yet.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $checks->links() }}
@endsection