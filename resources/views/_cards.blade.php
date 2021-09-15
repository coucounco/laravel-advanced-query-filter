<div class="block block-rounded @if(isset($dark) && $dark) bg-primary-dark @endif mb-2">
    <div class="block-content">
        @if(request()->has('filter'))
            {{ Form::hidden('filter', request()->filter) }}
        @endif
        <div class="row p-10 push">
            <div class="col-lg-12">
                <ul class="nav nav-pills">
                    @foreach($cards as $card)
                        {{ $card->render() }}
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
