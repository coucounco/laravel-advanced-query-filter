<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label for="plain">{{ $label ?? __('Search') }}</label>
            <input type="text" class="form-control" name="plain" value="{{ $value() }}" />
        </div>
    </div>
</div>