<div class="block block-rounded @if(isset($dark) && $dark) bg-primary-dark @endif mb-2 h-100">
    <div class="block-content">
        {{ Form::oselect('pagination', array_combine(config('aqf.paginations'), config('aqf.paginations')), $selectedPagination, null, ['label' => 'Pagination']) }}
    </div>
</div>
