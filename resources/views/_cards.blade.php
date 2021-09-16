<div class="block block-rounded @if(isset($dark) && $dark) bg-primary-dark @endif mb-2">
    <div class="block-content">
        @if($value() !== null)
            {{ Form::hidden('filter', $value()) }}
        @endif
        <div class="row p-10 push">
            <div class="col-lg-12">
                <ul class="nav nav-pills">
                    @if(isset($cards))
                        @foreach($cards as $card)
                            {{ $card }}
                        @endforeach
                    @else
                        {{ $slot }}
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
