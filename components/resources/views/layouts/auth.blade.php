<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ localization()->getCurrentLocaleDirection() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ $header->favicon }}">

        {!! SEO::generate() !!}

        @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
          <link rel="alternate" hreflang="{{ $properties->key() }}" href="{{ localization()->getLocalizedURL($properties->key(), null, [], false) }}">
        @endforeach

        @if ( $general->page_load )
            <!-- Pace -->
            <script src="{{ asset('assets/js/pace.min.js') }}" defer></script>
        @endif

        @if ( $general->adblock_detection )
          <!-- Sweet Alert 2 -->
          <link rel="preload" href="{{ asset('assets/css/sweetalert2.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
          <noscript><link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}"></noscript>
        @endif

        <!-- Font Awesome -->
        <link rel="preload" href="{{ asset('assets/css/fontawesome.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}"></noscript>

        <!-- jQuery -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

        <!-- Theme CSS -->
        <link type="text/css" href="{{ asset('assets/css/main.'.localization()->getCurrentLocaleDirection().'.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link type="text/css" href="{{ asset('assets/css/custom.'.localization()->getCurrentLocaleDirection().'.css') }}" rel="stylesheet">
        
        @if ( !empty($general->font_family) )

  @if($general->font_family == 'Inter')
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
  @else
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{ urlencode($general->font_family) }}&display=swap">
  @endif

          <style>
            body, .card .card-body {
              font-family: {{ $general->font_family }} !important;
            }
          </style>

        @endif

        @if ( $advanced->header_status && $advanced->insert_header != null )
          {!! $advanced->insert_header !!}
        @endif

        @livewireStyles

    </head>
    <body class="antialiased {{ Cookie::get('theme_mode', $general->default_theme_mode) }}">

        @if ( $advanced->body_status && $advanced->insert_body != null )
          {!! $advanced->insert_body !!}
        @endif
        
        @if ( $general->maintenance_mode && ( !Auth::check() || Auth::user()->is_admin != 1 ) && !Route::is('admin.login') )
          
          @livewire('public.maintenance')

        @else

         <div class="page">

            <x-public.navbar :header="$header" :siteTitle="$siteTitle" :menus="$menus" :general="$general" />

            <!-- Begin::page-wrapper -->
            <div class="page-wrapper">

                  @if(Auth::user() && \App\Models\Admin\AuthPages::where('name', 'Verify Email')->first()->status && Auth::user()->email_verified_at == null)
                      <div class="alert alert-important alert-warning alert-dismissible mb-0 text-center rounded-0" role="alert">
                          {{ __('Your email address is not verified.') }} <a href="{{ route('verify.email') }}" class="alert-link text-decoration-underline">{{ __('Verify it here!') }}</a>
                      </div>
                  @endif

                  <!-- Begin::page-content -->
                  <div class="page-content my-auto">
                    <div class="container py-4">
                        <div class="row">
                            <div class="col-12">

                                @switch(true)
                                    @case( Route::is('login') )
                                            @if ( \App\Models\Admin\AuthPages::where('name', 'Login')->first()->status )
                                                @livewire('public.auth.login')
                                            @else
                                                @include('errors.disabled', ['message' => 'Login'])
                                            @endif
                                        @break

                                    @case( Route::is('admin.login') )
                                            @livewire('public.auth.admin-login')
                                        @break

                                    @case( Route::is('register') )
                                            @if ( \App\Models\Admin\AuthPages::where('name', 'Register')->first()->status )
                                                @livewire('public.auth.register')
                                            @else
                                                @include('errors.disabled', ['message' => 'Register'])
                                            @endif
                                        @break

                                    @case( Route::is('password.forgot') )
                                            @if ( \App\Models\Admin\AuthPages::where('name', 'Forgot Password')->first()->status )
                                                @livewire('public.auth.forgot-password')
                                            @else
                                                @include('errors.disabled', ['message' => 'Forgot Password'])
                                            @endif
                                        @break

                                    @case( Route::is('password.reset') )
                                            @if ( \App\Models\Admin\AuthPages::where('name', 'Reset Password')->first()->status )
                                                @livewire('public.auth.reset-password', [
                                                          'token' => request()->token,
                                                          'email' => request()->email
                                                        ])
                                            @else
                                                @include('errors.disabled', ['message' => 'Reset Password'])
                                            @endif
                                        @break

                                    @case( Route::is('verify.email') )
                                            @if ( \App\Models\Admin\AuthPages::where('name', 'Verify Email')->first()->status )
                                                @livewire('public.auth.verify-email')
                                            @else
                                                @include('errors.disabled', ['message' => 'Verify Email'])
                                            @endif
                                        @break

                                    @case( Route::is('user.profile') )
                                            @if ( \App\Models\Admin\AuthPages::where('name', 'Profile')->first()->status )
                                                @livewire('public.auth.profile')
                                            @else
                                                @include('errors.disabled', ['message' => 'Profile'])
                                            @endif
                                        @break

                                    @default
                                @endswitch
                            </div>
                        </div>
                    </div>

                  </div>
                  <!-- End::page-content -->
                  
            </div>
            <!-- End::page-wrapper -->

            <x-public.footer :footer="$footer" :general="$general" :socials="$socials" />

            <!-- Theme JS -->
            <script src="{{ asset('assets/js/main.min.js') }}"></script>

            @if ( $general->lazy_loading )
              <script src="{{ asset('assets/js/lazysizes.min.js') }}" async></script>
              <script src="{{ asset('assets/js/ls.unveilhooks.min.js') }}" async></script>
            @endif

            @if ( $general->back_to_top )
                <!-- Scroll back to top -->
                <div id="backtotop"> 
                    <a href="javascript:void(0)" class="backtotop"></a> 
                </div>

                <script> 
                    jQuery(document).ready(function ($) {
                        $("#backtotop").hide(); 
                        $(window).scroll(function () { 
                            if ($(this).scrollTop() > 500) { 
                                $('#backtotop').fadeIn(); 
                            } else { 
                                $('#backtotop').fadeOut(); 
                            } 
                        });   
                    });

                    jQuery('.backtotop').click(function () { 
                        jQuery('html, body').animate({ 
                            scrollTop: 0 
                        }, 'slow'); 
                    });
                </script> 
                <!-- End of Scroll back to top -->
            @endif

            @if ( $general->adblock_detection )

              <!-- Sweetalert2 -->
              <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

              <script>
              (function( $ ) {
                "use strict";

                    document.addEventListener("DOMContentLoaded", function () {
                      setTimeout(() => {
                        const el = document.querySelector(".ad-banner");

                        if (el && el.offsetHeight === 0) {
                          Swal.fire({
                            title: "You&#039;re blocking ads",
                            text: "Our website is made possible by displaying online ads to our visitors. Please consider supporting us by disabling your ad blocker.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "I have disabled Adblock",
                            cancelButtonText: "No, thanks!",
                          }).then((result) => {
                            if (result.isConfirmed) {
                              window.location.reload();
                            }
                          });
                        }
                      }, 100);
                    });

              })( jQuery );
              </script>

            @endif

            @if (Cookie::get('cookies') == null)

              @if ( $notice->status )

                    <div class="cookies-wrapper position-fixed {{ $notice->align }}">
                        <div class="{{ $notice->background }} {{ ($notice->background != 'bg-white') ? 'text-white' : 'text-dark' }} py-3 px-2 rounded shadow">
                            <div class="card-body">
                                <div class="mb-3">
                                    <img src="{{ asset('assets/img/cookie.svg') }}" alt="{{ __('Cookie') }}" width="65px" height="46px">
                                </div>

                                <div>
                                    <span class="text-start">{!! __(GrahamCampbell\Security\Facades\Security::clean($notice->notice)) !!}</span>
                                </div>
                            </div>

							@if ( $notice->button)
								<div class="text-center mt-2">
									<button id="acceptCookies" class="btn btn-success mb-0 text-capitalize text-white"> {{ __('Accept all cookies') }} </button>
								</div>
							 @endif
                        </div>
                    </div>

                  <script>
                     (function( $ ) {
                        "use strict";

                            jQuery("#acceptCookies").click(function(){
                                jQuery.ajax({
                                    type : 'get',
                                    url : '{{ url('/') }}/cookies/accept',
                                    success: function(e) {
                                        jQuery('.cookies-wrapper').remove();
                                    }
                                });
                            });

                    })( jQuery );
                  </script>
              @endif

            @endif

            @if ( $general->theme_mode )
              <script>
                 (function( $ ) {
                    "use strict";

                        jQuery(".btn-toggle-mode").click(function(){
                            jQuery.ajax({
                                type : 'get',
                                url : '{{ url('/') }}/theme/mode',
                                success: function(e) {
                                    window.location.reload();
                                }
                            });
                        });

                })( jQuery );
              </script>
            @endif
            
            @if ( $advanced->footer_status && $advanced->insert_footer != null )
              {!! $advanced->insert_footer !!}
            @endif

          </div>

          @livewireScripts
          
        @endif

    </body>
</html>