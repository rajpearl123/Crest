<div class="col-12 col-lg-4 user-sidebar p-4 bg-light rounded">
    
    <ul class="list-group">
        <li class="list-group-item {{ request()->is('profile') ? 'active' : '' }}">
            <a href="" class="d-flex align-items-center">
                <i class="bi bi-person me-2"></i> {{ __('Profile Info') }}
            </a>
        </li>
        <li class="list-group-item {{ request()->is('messages') ? 'active' : '' }}">
            <a href="{{route('messages')}}" class="d-flex align-items-center">
                <i class="bi bi-heart me-2"></i> {{ __('Messages') }}
            </a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('logout') }}" class="text-danger d-flex align-items-center"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>