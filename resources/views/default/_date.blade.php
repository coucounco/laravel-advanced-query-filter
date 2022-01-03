<div class="block">
    <div class="block-content pt-3">
        <div class="form-group">
            <label for="date_{{ $name }}">Date</label>
            <input type="text" id="date_{{ $name }}" name="date[{{ $name }}]" value="{{ isset($selected) ? $selected : null }}" autocomplete="off" class="form-control form-control-lg" />
            <script type="text/javascript">
                $(function () {
                    $('#date_{{ $name }}').daterangepicker({
                        singleDatePicker: true,
                        autoApply: true,
                        autoUpdateInput: false,
                        opens: 'lefts',
                        locale: {
                            cancelLabel: 'Clear',
                            format: 'DD.MM.YYYY',
                        }
                    })
                        .on('apply.daterangepicker', function (ev, picker) {
                            $(this).val(picker.startDate.format('DD.MM.YYYY'));
                        })
                        .on('cancel.daterangepicker', function (ev, picker) {
                            $(this).val('');
                        });
                });
            </script>
        </div>
    </div>
</div>
