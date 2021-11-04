<div class="block block-rounded mb-2 h-100">
    <div class="block-content">
        <div class="form-group">
            <label for="pagination">Pagination</label>
            <select name="pagination" class="form-control">
                @foreach(array_combine(config('aqf.paginations'), config('aqf.paginations')) as $value => $label)
                    <option value="{{ $value }}" @if($selectedPagination == $value) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
