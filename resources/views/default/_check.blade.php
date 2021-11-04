<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="hidden" name="{{ 'check['.$check.']' }}" value="{{ 0 }}" />
    <input type="checkbox" name="{{ 'check['.$check.']' }}" value="{{ 1 }}" @if(request()->has('check') && isset(request()->check[$check]) ? request()->check[$check] : $default) checked @endif />
</div>
