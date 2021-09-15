<div class="block @if(isset($dark) && $dark) bg-primary-dark @endif">
    <div class="block-content pt-3">
        @php
            $selected = request()->has('model') && isset(request()->model[$name]) ? request()->model[$name] : [];
        @endphp
        @if (!isset($multiselect) || $multiselect)
            {{ Form::cselectmultiple('model['.$name.']', $list, $selected, ['label' => __('label.'.$name)]) }}
        @else
            {{ Form::cselect('model['.$name.']', $list, $selected, ['label' => __('label.'.$name)]) }}
        @endif
    </div>
</div>
