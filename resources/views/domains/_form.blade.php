<div class="mb-3">
    <label class="form-label">URL</label>
    <input type="url" name="url" class="form-control @error('url') is-invalid @enderror"
           value="{{ old('url', $domain->url ?? '') }}" placeholder="https://example.com">
    @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Method</label>
    <select name="method" class="form-select @error('method') is-invalid @enderror">
        @foreach(['GET', 'HEAD'] as $method)
            <option value="{{ $method }}" {{ old('method', $domain->method ?? 'GET') === $method ? 'selected' : '' }}>
                {{ $method }}
            </option>
        @endforeach
    </select>
    @error('method') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Check Interval (minutes)</label>
    <input type="number" name="check_interval_minutes" class="form-control @error('check_interval_minutes') is-invalid @enderror"
           value="{{ old('check_interval_minutes', $domain->check_interval_minutes ?? 5) }}" min="1" max="1440">
    @error('check_interval_minutes') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Timeout (seconds)</label>
    <input type="number" name="timeout_seconds" class="form-control @error('timeout_seconds') is-invalid @enderror"
           value="{{ old('timeout_seconds', $domain->timeout_seconds ?? 10) }}" min="1" max="60">
    @error('timeout_seconds') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <div class="form-check">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" class="form-check-input"
               {{ old('is_active', $domain->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label">Active</label>
    </div>
</div>