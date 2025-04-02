    <header class="navbar navbar-expand-lg navbar-light d-print-none @if ($header->sticky_header) sticky-top @endif">
        <div class="container-xl">
            <button class="navbar-toggler collapsed" type="button" aria-label="{{ __('Toggler') }}" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand d-none-navbar-horizontal pe-0 pe-lg-3 m-auto" title="{{ __($siteTitle) }}" href="{{ route('home') }}">
                @if ( !empty($header->logo_light) )

                    @switch( Cookie::get('theme_mode', $general->default_theme_mode) )
                        @case('theme-dark')
                            <img src="{{ $header->logo_dark }}" width="110" height="32" alt="{{ __($siteTitle) }}" class="navbar-brand-image">
                            @break

                        @case('theme-light')
                            <img src="{{ $header->logo_light }}" width="110" height="32" alt="{{ __($siteTitle) }}" class="navbar-brand-image">
                            @break

                        @default
                            <img src="{{ $header->logo_light }}" width="110" height="32" alt="{{ __($siteTitle) }}" class="navbar-brand-image">
                    @endswitch
                    
                @else
                  {{ $siteTitle }}
                @endif
            </a>

            <div class="navbar-nav flex-row order-lg-last m-auto">
                @if ( $general->search_box_status )
                    <div class="m-auto">
                        @livewire('public.search-box')
                    </div>
                @endif

                @if ( $general->theme_mode )
                    <div class="nav-item me-2">
                        @if ( empty( Cookie::get('theme_mode', $general->default_theme_mode) ) || Cookie::get('theme_mode', $general->default_theme_mode) === 'theme-light' )
                            <button class="btn btn-icon btn-toggle-mode" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="{{ __('Enable dark mode') }}" data-bs-original-title="{{ __('Enable dark mode') }}" title="{{ __('Enable dark mode') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path></svg>
                            </button>
                        @else
                            <button class="btn btn-icon btn-toggle-mode" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="{{ __('Enable light mode') }}" data-bs-original-title="{{ __('Enable light mode') }}" title="{{ __('Enable light mode') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="4"></circle><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path></svg>
                            </button>
                        @endif
                    </div>
                @endif

                <!-- Begin::Navbar Right -->
                @foreach($menus as $key => $value)

                    @if ( $value['type'] == 'button' )

                      @if( count($value['children']) )
                            <li class="nav-item dropdown">
                                <a class="btn dropdown-toggle me-2 {{ $value['class'] }}" href="#navbarDropdownMenuButton{{ $key }}" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                   @if ( !empty($value['icon']) )
                                     <i class="{{ $value['icon'] }} icon"></i>
                                   @endif
                                   {{ __($value['text']) }}
                                </a>

                                <x-public.menu :childs="$value['children']" />
                            </li>

                      @else

                        <li class="nav-item">
                            <a class="btn me-2 {{ $value['class'] }}" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}">
                               @if ( !empty($value['icon']) )
                                 <i class="{{ $value['icon'] }} icon"></i>
                               @endif
                              {{ __($value['text']) }}
                            </a>
                        </li>

                      @endif

                  @endif

                @endforeach
                <!-- End::Navbar Right -->

                <!-- Begin::Login -->
                @php
                    $loginPage = \App\Models\Admin\AuthPages::where('name', 'Login')->first();
                    $profilePage = \App\Models\Admin\AuthPages::where('name', 'Profile')->first();
                    $registerPage = \App\Models\Admin\AuthPages::where('name', 'Register')->first();
                @endphp

                @auth
                    @include('components.public.userMenu', ['user' => Auth::user(), 'profilePage' => $profilePage])
                @else

                   @if ($loginPage && $loginPage->status)
                    <div class="nav-item me-2">
                        <a class="btn {{ ($registerPage && $registerPage->status) ? 'btn-default' : 'btn-success' }} border-0 shadow-none" href="{{ route('login')}}">{{ __('Login') }}</a>
                    </div>
                    @endif

                   @if ($registerPage && $registerPage->status)
                        <div class="nav-item">
                            <a class="btn btn-primary" href="{{ route('register')}}">{{ __('Register') }}</a>
                        </div>
                    @endif
                @endauth
                <!-- End::Login -->
                </div>

            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="d-flex flex-column flex-lg-row flex-fill align-items-stretch align-items-lg-center">
                    <ul class="navbar-nav">

                        <!-- Begin::Navbar Left -->
                        @foreach($menus as $key => $value)

                            @if ( $value['type'] == 'link' )

                              @if( count($value['children']) )
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#navbarDropdownMenuLink{{ $key }}" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                           @if ( !empty($value['icon']) )
                                             <i class="{{ $value['icon'] }} me-2"></i>
                                           @endif
                                           {{ __($value['text']) }}
                                        </a>

                                        <x-public.menu :childs="$value['children']" />
                                    </li>

                              @else

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}" target="{{ $value['target'] }}">
                                       @if ( !empty($value['icon']) )
                                         <i class="{{ $value['icon'] }} me-2"></i>
                                       @endif
                                      {{ __($value['text']) }}
                                    </a>
                                </li>

                              @endif

                            @endif

                        @endforeach
                        <!-- End::Navbar Left -->

                        <!-- Begin:Lang Menu -->
                        @if ( $general->language_switcher )

                          @php
                            $mobileLangMenu = '';
                          @endphp

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle cursor-pointer" data-bs-toggle="dropdown" href="#navbar-base" aria-label="{{ __('Open language menu') }}">
                                    <img src="{{ asset('assets/img/flags/' . localization()->getCurrentLocale() . '.svg') }}" width="16" height="10" class="lang-menu me-1 my-auto" alt="{{ localization()->getCurrentLocaleNative() }}"> 
                                    {{ localization()->getCurrentLocaleNative() }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                   @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                                      <a class="dropdown-item border-radius-md mb-1" rel="alternate" hreflang="{{ $properties->key() }}" href="{{ localization()->getLocalizedURL($properties->key(), null, [], false) }}">
                                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" alt="{{ $properties->native() }}" width="16" height="10" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
                                      </a>
                                   @endforeach
                                </div>
                            </li>
                          
                        @endif
                        <!-- End:Lang Menu -->
                    </ul>

                </div>
            </div>

        </div>

    </header>