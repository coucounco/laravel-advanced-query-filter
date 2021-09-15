@if(!isset($menuToggle) || $menuToggle)
@menuToggle(['label' => 'Filters'])
@endif
    {{ Form::open(['url' => QueryFilterUrl::url(), 'method' => 'GET', 'role'=>'form', 'class' => (isset($inline) && $inline) ? 'form-inline' : '', 'id' => 'form-filters']) }}

        @if(request()->has('view'))
            {{ Form::hidden('view', request()->input('view')) }}
        @endif

        <div class="mb-0">
            {{ $slot }}
        </div>

        @if(!isset($inline) || !$inline)
            <div class="mb-4">
                <button class="btn @if(isset($dark) && $dark) btn-outline-primary @else btn-primary @endif" type="submit">{{ __('action.filter') }}</button>
                <a href="{{ QueryFilterUrl::cleanUrl() }}" class="btn @if(isset($dark) && $dark) btn-outline-secondary @else btn-light @endif">{{ __('action.clear') }}</a>
            </div>
        @else
            <button class="btn @if(isset($dark) && $dark) btn-outline-primary @else btn-primary @endif" type="submit">{{ __('action.filter') }}</button>
            <a href="{{ QueryFilterUrl::cleanUrl() }}" class="btn @if(isset($dark) && $dark) btn-outline-secondary @else btn-light @endif">{{ __('action.clear') }}</a>
        @endif

    {{ Form::close() }}
@if(!isset($menuToggle) || $menuToggle)
@endmenuToggle()
@endif
