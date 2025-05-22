@props([
    'id',
    'title',
    'activePattern' => '',
    'items' => [],
])

@php
    $isActive = request()->is($activePattern);
@endphp

<li class="menu">
    <a href="#{{ $id }}" data-toggle="collapse"
       aria-expanded="{{ $isActive ? 'true' : 'false' }}"
       class="dropdown-toggle">
        <div>
            {{ $icon ?? '' }}
            <span>{{ $title }}</span>
        </div>
        <div>
            <svg class="feather feather-chevron-right {{ $isActive ? 'rotate-icon' : '' }}"
                 width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </div>
    </a>
    <ul class="collapse submenu list-unstyled {{ $isActive ? 'show' : '' }}" id="{{ $id }}" data-parent="#accordionExample">
        @foreach ($items as $item)
            <li class="{{ request()->routeIs($item['route']) ? 'active' : '' }}">
                <a href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
            </li>
        @endforeach
    </ul>
</li>
