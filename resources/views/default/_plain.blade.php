<div class="block">
    <div class="block-content pt-3">
        {{ Form::otext('plain', $value(), null, ['label' => __('Search'), 'helper' => isset($helper) ? $helper : null]) }}
    </div>
</div>