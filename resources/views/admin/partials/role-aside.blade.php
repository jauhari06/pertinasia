<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item">
        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="nav-link">
            <i class="fa-solid fa-gauge fe-16"></i>
            <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
        </a>
    </li>
</ul>
<p class="text-muted nav-heading mt-4 mb-1">
    <span>Main Navigation</span>
</p>
<ul class="navbar-nav flex-fill w-100 mb-2">
    @foreach(session('user-menu') as $menu)
    @if (!empty($menu['children']))
    <li class="nav-item dropdown">
        <a href="#menu-{{ $menu['id'] }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fa {{ $menu['icon'] }} fe-16"></i>
            <span class="ml-3 item-text">{{ $menu['name'] }}</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="menu-{{ $menu['id'] }}">
            @foreach ($menu['children'] as $child)
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{ $child['route'] !== '#' ? route($child['route']) : '#' }}">
                    <span class="ml-3 item-text">{{ $child['name'] }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </li>
    @else
    <li class="nav-item">
        <a href="{{ $menu['route'] !== '#' ? route($menu['route']) : '#' }}" class="nav-link">
            <i class="fa {{ $menu['icon'] }} fe-16"></i>
            <span class="ml-3 item-text">{{ $menu['name'] }}</span>
        </a>
    </li>
    @endif
    @endforeach
</ul>