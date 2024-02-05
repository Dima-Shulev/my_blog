@props(['links' => $links])
<ul class="navbar-nav  me-auto mb-2 mb-lg-0">
    @isset($links)
        @foreach($links as $item)
            <li class="nav">
                <a class="nav {{ active_link($item->url) }}" aria-current="page" href="{{route('show',[$item->url])}}">{{ $item->name }}</a>
            </li>
        @endforeach
    @endisset
