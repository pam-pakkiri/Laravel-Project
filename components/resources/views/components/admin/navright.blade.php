<div class="collapse navbar-collapse mt-2" id="navbar">
    <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
    <ul class="navbar-nav justify-content-end">

        <li class="nav-item me-2">
            @if ( empty(Cookie::get('theme_mode')) || Cookie::get('theme_mode') === 'theme-light' )
                <button class="btn btn-icon btn-toggle-mode" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="{{ __('Enable dark mode') }}" data-bs-original-title="{{ __('Enable dark mode') }}" title="{{ __('Enable dark mode') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path></svg>
                </button>
            @else
                <button class="btn btn-icon btn-toggle-mode" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="{{ __('Enable light mode') }}" data-bs-original-title="{{ __('Enable light mode') }}" title="{{ __('Enable light mode') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="4"></circle><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path></svg>
                </button>
            @endif
        </li>

        <li class="nav-item dropdown d-none d-md-flex me-3">
            <a class="nav-link px-0 cursor-pointer" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path> <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path> </svg>
                <span class="badge bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-arrow">
                <div class="card">
                    <div class="card-body">
                        {{ __('Version') }}: <span class="badge bg-success">{{ Config::get('app.version') }}</span>
                        </table>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user cursor-pointer"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" aria-labelledby="dropdownMenuButton">
                <li>
                    <a href="{{ route('admin.profile.index') }}" class="dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                        {{ __('Profile') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M7 12h14l-3 -3m0 6l3 -3"></path></svg>
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
