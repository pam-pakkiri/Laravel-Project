<aside class="navbar navbar-vertical navbar-expand-lg navbar-light shadow-sm">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand">
            <a href="{{ route('home') }}">
                @if ( Cookie::get('theme_mode') === 'theme-dark' )
                    <img src="{{ \App\Models\Admin\Header::orderBy('id', 'DESC')->first()->logo_dark }}" width="110" height="32" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @elseif( Cookie::get('theme_mode') === 'theme-light' )
                    <img src="{{ \App\Models\Admin\Header::orderBy('id', 'DESC')->first()->logo_light }}" width="110" height="32" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @else
                    <img src="{{ \App\Models\Admin\Header::orderBy('id', 'DESC')->first()->logo_light }}" width="110" height="32" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @endif
            </a>
        </h1>

        <div class="navbar-nav d-lg-none">
            <a class="nav-link cursor-pointer" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                <span class="avatar avatar-sm" style="background-image: url(https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=150&d=mm&r=g);"></span>
                <div class="d-none d-xl-block">
                    <div>{{ Auth::user()->fullname }}</div>
                    <div class="small text-muted">{{ ( Auth::user()->level == 1) ? __('Administrator') : __('Member') }}</div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="{{ route('admin.profile.index') }}" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('admin.logout') }}" class="dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M7 12h14l-3 -3m0 6l3 -3"></path></svg>
                    {{ __('Logout') }}
                </a>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbar-menu">

            <ul class="navbar-nav pt-lg-3">

                <li class="nav-item {{ Route::is('admin.dashboard.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="12" cy="13" r="2"></circle> <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line> <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('admin.posts.index', 'admin.posts.translations.index', 'admin.posts.translations.create', 'admin.posts.translations.edit') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.posts.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path> <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Posts') }}</span>
                    </a>
                </li>

               <li class="nav-item {{ Route::is('admin.pages.index', 'admin.pages.translations.index', 'admin.pages.translations.create', 'admin.pages.translations.edit', 'admin.pages.authentication.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.pages.index', 'admin.pages.authentication.index') ? 'show' : '' }}" data-bs-toggle="collapse" href="#pages" role="button" aria-expanded="false" aria-controls="pages">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="9" x2="10" y2="9" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="9" y1="17" x2="15" y2="17" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('Pages') }}</span>
                    </a>

                    <div id="pages" class="multi-collapse collapse {{ Route::is('admin.pages.index', 'admin.pages.translations.index', 'admin.pages.translations.create', 'admin.pages.translations.edit', 'admin.pages.authentication.index') ? 'show' : '' }}">

                        <a class="nav-link {{ Route::is('admin.pages.index', 'admin.pages.translations.index', 'admin.pages.translations.create', 'admin.pages.translations.edit') ? 'active' : '' }}" href="{{ route('admin.pages.index') }}">
                            {{ __('All Pages') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.pages.authentication.index') ? 'active' : '' }}" href="{{ route('admin.pages.authentication.index') }}">
                            {{ __('Authentication') }}
                        </a>
                    </div>
                </li>

                <li class="nav-item {{ Route::is( 'admin.tools.index', 'admin.tools.translations.index', 'admin.tools.translations.create', 'admin.tools.translations.edit', 'admin.tools.categories.index', 'admin.tools.history.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is( 'admin.tools.index', 'admin.tools.categories.index') ? 'show' : '' }}" data-bs-toggle="collapse" href="#tools" role="button" aria-expanded="false" aria-controls="tools">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tool" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5"></path> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Tools') }}</span>
                    </a>

                    <div id="tools" class="multi-collapse collapse {{ Route::is( 'admin.tools.index', 'admin.tools.translations.index', 'admin.tools.translations.create', 'admin.tools.translations.edit', 'admin.tools.categories.index', 'admin.tools.history.index') ? 'show' : '' }}">

                        <a class="nav-link {{ Route::is('admin.tools.index', 'admin.tools.translations.index', 'admin.tools.translations.create', 'admin.tools.translations.edit') ? 'active' : '' }}" href="{{ route('admin.tools.index') }}">
                            {{ __('All Tools') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.tools.categories.index') ? 'active' : '' }}" href="{{ route('admin.tools.categories.index') }}">
                            {{ __('Categories') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.tools.history.index') ? 'active' : '' }}" href="{{ route('admin.tools.history.index') }}">
                            {{ __('History') }}
                        </a>

                    </div>
                </li>
 
                <li class="nav-item {{ Route::is('admin.general.index', 'admin.menus.index', 'admin.header.index', 'admin.footer.index', 'admin.footer.translations.create', 'admin.footer.translations.edit', 'admin.apikeys.index', 'admin.proxy.index', 'admin.captcha.index', 'admin.sociallogin.index', 'admin.sidebars.index', 'admin.gdpr.index', 'admin.advertisements.index', 'admin.smtp.index', 'admin.languages.index', 'admin.languages.translations.edit', 'admin.redirects.index', 'admin.advanced.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.general.index', 'admin.menus.index', 'admin.header.index', 'admin.footer.index', 'admin.footer.translations.create', 'admin.footer.translations.edit', 'admin.apikeys.index', 'admin.proxy.index', 'admin.captcha.index', 'admin.sociallogin.index', 'admin.sidebars.index', 'admin.gdpr.index', 'admin.advertisements.index', 'admin.smtp.index', 'admin.languages.index', 'admin.languages.translations.edit', 'admin.redirects.index', 'admin.advanced.index') ? 'show' : '' }}" data-bs-toggle="collapse" href="#theme-settings" role="button" aria-expanded="false" aria-controls="theme-settings">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('Settings') }}</span>
                    </a>

                    <div id="theme-settings" class="multi-collapse collapse {{ Route::is('admin.general.index', 'admin.menus.index', 'admin.header.index', 'admin.footer.index', 'admin.footer.translations.create', 'admin.footer.translations.edit', 'admin.apikeys.index', 'admin.proxy.index', 'admin.captcha.index', 'admin.sociallogin.index', 'admin.sidebars.index', 'admin.gdpr.index', 'admin.advertisements.index', 'admin.smtp.index', 'admin.languages.index', 'admin.languages.translations.edit', 'admin.redirects.index', 'admin.advanced.index') ? 'show' : '' }}">
                        <a class="nav-link {{ Route::is('admin.general.index') ? 'active' : '' }}" href="{{ route('admin.general.index') }}">
                            {{ __('General') }}
                        </a>
                                        
                        <a class="nav-link {{ Route::is('admin.header.index') ? 'active' : '' }}" href="{{ route('admin.header.index') }}">
                            {{ __('Header') }}
                        </a>
                    
                        <a class="nav-link {{ Route::is('admin.footer.index', 'admin.footer.translations.create', 'admin.footer.translations.edit') ? 'active' : '' }}" href="{{ route('admin.footer.index') }}">
                            {{ __('Footer') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.menus.index') ? 'active' : '' }}" href="{{ route('admin.menus.index') }}">
                            {{ __('Menus') }}
                        </a>
                        
                        <a class="nav-link {{ Route::is('admin.sidebars.index') ? 'active' : '' }}" href="{{ route('admin.sidebars.index') }}">
                            {{ __('Sidebars') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.gdpr.index') ? 'active' : '' }}" href="{{ route('admin.gdpr.index') }}">
                            {{ __('GDPR Cookies') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.advertisements.index') ? 'active' : '' }}" href="{{ route('admin.advertisements.index') }}">
                            {{ __('Advertisements') }}
                        </a>
                    
                        <a class="nav-link {{ Route::is('admin.smtp.index') ? 'active' : '' }}" href="{{ route('admin.smtp.index') }}">
                            {{ __('SMTP') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.apikeys.index') ? 'active' : '' }}" href="{{ route('admin.apikeys.index') }}">
                            {{ __('API Keys') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.proxy.index') ? 'active' : '' }}" href="{{ route('admin.proxy.index') }}">
                            {{ __('Proxy') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.captcha.index') ? 'active' : '' }}" href="{{ route('admin.captcha.index') }}">
                            {{ __('Captcha') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.sociallogin.index') ? 'active' : '' }}" href="{{ route('admin.sociallogin.index') }}">
                            {{ __('Social Login') }}
                        </a>

                        <a class="nav-link {{ ( Route::is('admin.redirects.index') ) ? 'active' : '' }}" href="{{ route('admin.redirects.index') }}">
                            {{ __('Redirects') }}
                        </a>
                    
                        <a class="nav-link {{ ( Route::is('admin.languages.index') || Route::is('admin.languages.translations.edit') ) ? 'active' : '' }}" href="{{ route('admin.languages.index') }}">
                            {{ __('Languages') }}
                        </a>
                    
                        <a class="nav-link {{ ( Route::is('admin.advanced.index') ) ? 'active' : '' }}" href="{{ route('admin.advanced.index') }}">
                            {{ __('Advanced') }}
                        </a>
                    </div>
                </li>

               <li class="nav-item {{ Route::is('admin.indexing.submit', 'admin.indexing.history') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.indexing.submit', 'admin.indexing.history') ? 'show' : '' }}" data-bs-toggle="collapse" href="#indexing" role="button" aria-expanded="false" aria-controls="indexing">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path> <path d="M12 12h3.5"></path> <path d="M12 7v5"></path> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Instant Indexing') }}</span>
                    </a>

                    <div id="indexing" class="multi-collapse collapse {{ Route::is('admin.indexing.submit', 'admin.indexing.history') ? 'show' : '' }}">

                        <a class="nav-link {{ Route::is('admin.indexing.submit') ? 'active' : '' }}" href="{{ route('admin.indexing.submit') }}">
                            {{ __('Submit') }}
                        </a>

                        <a class="nav-link {{ Route::is('admin.indexing.history') ? 'active' : '' }}" href="{{ route('admin.indexing.history') }}">
                            {{ __('History') }}
                        </a>
                    </div>
                </li>

                <li class="nav-item {{ Route::is('admin.users.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="9" cy="7" r="4"></circle> <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path> <path d="M16 3.13a4 4 0 0 1 0 7.75"></path> <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Users') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('admin.report.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.report.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('Report') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('admin.cache.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.cache.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="4" width="18" height="4" rx="2" /><path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" /><line x1="10" y1="12" x2="14" y2="12" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('Cache') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('admin.sitemap.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.sitemap.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="3" y="15" width="6" height="6" rx="2"></rect> <rect x="15" y="15" width="6" height="6" rx="2"></rect> <rect x="9" y="3" width="6" height="6" rx="2"></rect> <path d="M6 15v-1a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v1"></path> <line x1="12" y1="9" x2="12" y2="12"></line> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('Sitemap') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('admin.license.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.license.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M14 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path> <path d="M21 12a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z"></path> <path d="M12.5 11.5l-4 4l1.5 1.5"></path> <path d="M12 15l-1.5 -1.5"></path> </svg>
                        </span>
                        <span class="nav-link-title">{{ __('License') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::is('admin.about.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.about.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>
                        </span>
                        <span class="nav-link-title">{{ __('About') }}</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</aside>
