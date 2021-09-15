<div class="block @if(isset($dark) && $dark) bg-primary-dark @endif">
    <div class="block-content pt-3">
        {{ Form::otext('plain', request()->has('plain') ? request()->input('plain') : '', null, ['label' => __('Search'), 'helper' => isset($helper) ? $helper : null]) }}
    </div>
</div>
