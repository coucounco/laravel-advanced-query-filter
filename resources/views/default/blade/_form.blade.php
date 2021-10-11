<div>
    @if(!isset($menuToggle) || $menuToggle)
        <x-aqf-menu-toggle label="Filters">


            {{ Form::open(['url' => QueryFilterUrl::url(), 'method' => 'GET', 'role'=>'form', 'class' => (isset($inline) && $inline) ? 'form-inline' : '', 'id' => 'form-filters']) }}

            @if(request()->has('view'))
                {{ Form::hidden('view', request()->input('view')) }}
            @endif

            <div class="mb-0">
                {{ $slot }}
            </div>

            {{ Form::close() }}

        </x-aqf-menu-toggle>
    @else

        {{ Form::open(['url' => QueryFilterUrl::url(), 'method' => 'GET', 'role'=>'form', 'class' => (isset($inline) && $inline) ? 'form-inline' : '', 'id' => 'form-filters']) }}

        @if(request()->has('view'))
            {{ Form::hidden('view', request()->input('view')) }}
        @endif

        <div class="mb-0">
            {{ $slot }}
        </div>

        {{ Form::close() }}

    @endif




</div>
