<button class="btn btn-primary"
    type="button"
    onclick="javascript:export_{{ $name }}()">
    <i class="{{ $icon ?? 'fas fa-file-export' }}"></i>
    {{ $label ?? __('label.export') }}
</button>
<p class="text-muted small mb-0">{{ $helper ?? __('Click here to export data into a PDF.') }}</p>
<script>
    function export_{{ $name }}() {
        let form = document.getElementById('form-filters');
        let formdata = new FormData(form);
        @if(isset($prepareDataFunction))
            formdata = {{ $prepareDataFunction }}(formdata);
        @endif
        let data = new URLSearchParams(formdata).toString();
        window.location.href = '{{ $route }}' + '?' + data + '&export_pdf=' + '{{ $name }}';
    }
</script>
