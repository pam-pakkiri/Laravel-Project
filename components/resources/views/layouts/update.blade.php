<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ localization()->getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ $header->favicon }}">
    {!! SEO::generate() !!}

    <x-admin.headerAssets />
    
    @livewireStyles
</head>
<body class="antialiased {{ Cookie::get('theme_mode', $general->default_theme_mode) }}">

    <div class="wrapper">
      <div class="page page-center">
            <div class="page-body">
                <div class="container-tight py-4">

                    <div class="text-center mb-4">
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
                    </div>

                      <div class="row">
                        <div class="col">
                            @livewire('admin.update')
                        </div>
                      </div>
                </div>
            </div>
      </div>
    </div>

    <x-admin.footerAssets />
    
    @livewireScripts
</body>
</html>