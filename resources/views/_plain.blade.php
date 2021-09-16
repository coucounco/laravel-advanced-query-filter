<div class="block @if(isset($dark) && $dark) bg-primary-dark @endif">
    <div class="block-content pt-3">
        {{ Form::otext('plain', $value(), null, ['label' => __('Search'), 'helper' => isset($helper) ? $helper : null]) }}
    </div>
</div>