<div class="block">
    <div class="block-content pt-3">
        @php
            $selected = request()->has('model') && isset(request()->model[$name]) ? request()->model[$name] : [];
        @endphp
        <label for="{{ 'model['.$name.']' }}">{{ ucfirst($name) }}</label>
        <select name="{{ 'model['.$name.']' }}" id="{{ 'model['.$name.']' }}" class="form-control" @if (!isset($multiselect) || $multiselect) multiple @endif>
            @foreach($list as $value => $label)
                <option value="{{ $value }}" @if($selected == $value) selected @endif>{{ $label }}</option>
            @endforeach
        </select>
    </div>
</div>
