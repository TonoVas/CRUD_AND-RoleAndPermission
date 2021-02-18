<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('/img/sidebar-1.jpg') }}">
    <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-normal">
        {{ __('Dashboard') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @role('super-admin')
        <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
            <i class="fa fa-tachometer"></i>
                <p>{{ __('Dashboard') }}</p>
            </a>
        </li>
        @endrole
        <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
            <a class="nav-link" href="{{ url ('crud') }}">
            <i class="fa fa-table"></i>
                <p>{{ __('Usuarios') }}</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
            <a class="nav-link" href="{{ url ('product') }}"">
            <i class="fa fa-book"></i>
                <p>{{ __('Productos') }}</p>
            </a>
        </li>
        </ul>
    </div>
</div>
