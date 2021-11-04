<div class="block">
    <div class="block-content pt-3">
        @php
            $selected = request()->has('m') && isset(request()->m[$name]) ? request()->m[$name] : [];
            $selectedMonth = $selected['m'] ?? (isset($date) ? $date->month : null) ?? \Illuminate\Support\Carbon::today()->month;
            $selectedYear = $selected['y'] ?? (isset($date) ? $date->year : null) ?? \Illuminate\Support\Carbon::today()->year;
            $years = range(2017, \Illuminate\Support\Carbon::today()->year);
            $years = array_combine($years, $years);
            $months = [];
            foreach(range(1, 12) as $i) {
                $months[$i] = \Illuminate\Support\Carbon::create($selectedYear, $i, 1)->format('F');
            }
        @endphp
        <label>Month</label>
        <div class="row gutters-tiny">
            <div class="col-md-8">
                <select name="{{ 'm['.$name.'][m]' }}" class="form-control">
                    @foreach($months as $value => $label)
                        <option value="{{ $value }}" @if($selectedMonth == $value) selected @endif>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="{{ 'm['.$name.'][y]' }}" class="form-control">
                    @foreach($years as $value => $label)
                        <option value="{{ $value }}" @if($selectedYear == $value) selected @endif>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
