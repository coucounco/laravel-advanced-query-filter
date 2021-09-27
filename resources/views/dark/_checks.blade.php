<div class="block block-rounded bg-primary-dark f mb-2 h-100">
    <div class="block-content">
        @if(isset($checks))
            @foreach($checks as $check)
                {{ $check }}
            @endforeach
        @else
            {{ $slot }}
        @endif
    </div>
</div>
