<div>
    @if(!isset($menuToggle) || $menuToggle)
        <x-aqf-menu-toggle label="Filters">
            <form action="{{ QueryFilterUrl::url() }}" method="get" role="form" class="{{ (isset($inline) && $inline) ? 'form-inline' : '' }}" id="form-filters">
                @if(request()->has('view'))
                    <input type="hidden" name="view" value="{{ request()->input('view') }}">
                @endif
                <div class="mb-0">
                    {{ $slot }}
                </div>
            </form>
        </x-aqf-menu-toggle>
    @else
        <form action="{{ QueryFilterUrl::url() }}" method="get" role="form" class="{{ (isset($inline) && $inline) ? 'form-inline' : '' }}" id="form-filters">
            @if(request()->has('view'))
                <input type="hidden" name="view" value="{{ request()->input('view') }}">
            @endif
            <div class="mb-0">
                {{ $slot }}
            </div>
        </form>
    @endif
</div>
