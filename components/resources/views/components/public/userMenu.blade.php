<div class="nav-item dropdown">
    <a class="nav-link d-flex lh-1 text-reset p-0 cursor-pointer" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
        <img class="avatar avatar-sm {{ ($general->lazy_loading) ? 'lazyload' : '' }}" alt="{{ __('Avatar') }}" data-src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}?s=150&d=mm&r=g" @if (!$general->lazy_loading) src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}?s=150&d=mm&r=g" @endif>
        <div class="d-none d-xl-block ps-2">
            <div>{{ $user->fullname }}</div>
            <div class="mt-1 small text-muted">{{ ( $user->is_admin == 1) ? __('Administrator') : __('Member') }}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        @if ( $user->is_admin == 1 )
            <a href="{{ route('admin.dashboard.index') }}" class="dropdown-item">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="13" r="2"></circle> <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line> <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path> </svg>
                {{ __('Admin Dashboard') }}
            </a>
        @endif

        @if ($profilePage->status)
            <a href="{{ route('user.profile') }}" class="dropdown-item">
                 <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                {{ __('Profile') }}
            </a>
        @endif
        
        <a href="{{ route('user.logout') }}" class="dropdown-item">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M7 12h14l-3 -3m0 6l3 -3"></path></svg>
            {{ __('Logout') }}
        </a>
    </div>
</div>