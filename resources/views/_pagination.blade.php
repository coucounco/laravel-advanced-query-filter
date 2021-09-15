@php
    $default = isset($default) ? $default : PAGINATION_DEFAULT;
    $value = request()->has('pagination') ? request()->input('pagination') : $default;
@endphp
<div class="block block-rounded @if(isset($dark) && $dark) bg-primary-dark @endif mb-2 h-100">
    <div class="block-content">
        {{ Form::oselect('pagination', [
                10 => 10,
                25 => 25,
                50 => 50,
                75 => 75,
                100 => 100,
                150 => 150,
                200 => 200,
                250 => 250,
            ], $value, null, ['label' => 'Pagination']) }}
    </div>
</div>
