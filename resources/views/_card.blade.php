<li class="nav-item col text-center">
    <a class="p-lg-2 nav-link mb-4 mb-sm-0 @if(request()->has('filter') && request()->filter == $filter) active @endif @if(!request()->has('filter') && $default) active @endif border"
       href="{{ QueryFilterUrl::filter($filter) }}" data-category-link="all">
        {!! $label !!}<br>
    </a>
</li>
