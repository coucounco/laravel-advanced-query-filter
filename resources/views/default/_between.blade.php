@if(!isset($inline) || !$inline)
    <div class="card">
        <div class="card-body">
@endif
            @if(!isset($inline) || !$inline)
                <label for="between[{{ $name }}]">{{ $label ?? __('Range between') }}</label>
            @endif
            <div class="row gutters-tiny">
                <div class="col-sm-6">
                    <input type="number" name="between[{{ $name }}][min]" placeholder="Min" value="{{ $min ?? null }}"
                </div>
                <div class="col-sm-6">
                    <input type="number" name="between[{{ $name }}][max]" placeholder="Max" value="{{ $max ?? null }}"
                </div>
            </div>
@if(!isset($inline) || !$inline)
        </div>
    </div>
@endif
