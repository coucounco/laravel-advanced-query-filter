<div class="block block-rounded @if(isset($dark) && $dark) bg-primary-dark @endif mb-2 h-100">
    <div class="block-content">
        @foreach($checks as $check)
            {{ $check->render() }}
        @endforeach
    </div>
</div>
