@if(!isset($inline) || !$inline)
    <div class="mb-4">
        <x-aqf-submit :dark="$dark"/>
        <x-aqf-clear :dark="$dark"/>
    </div>
@else
    <x-aqf-submit :dark="$dark"/>
    <x-aqf-clear :dark="$dark"/>
@endif