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

      @if ( $general->maintenance_mode && ( !Auth::check() || Auth::user()->is_admin != 1 ) && !Route::is('login') && !Route::is('admin.login') )
          
          @livewire('public.maintenance')

      @else

         <div class="page">

            <x-public.navbar :header="$header" :siteTitle="$siteTitle" :menus="$menus" :general="$general" />

            <!-- Begin::page-wrapper -->
            <div class="page-wrapper">
                  <!-- Begin::page-content -->
                  <div class="page-content">

                      @if(Auth::user() && \App\Models\Admin\AuthPages::where('name', 'Verify Email')->first()->status && Auth::user()->email_verified_at == null)
                          <div class="alert alert-important alert-warning alert-dismissible mb-0 text-center rounded-0" role="alert">
                            {{ __('Your email address is not verified.') }} <a href="{{ route('verify.email') }}" class="alert-link text-decoration-underline">{{ __('Verify it here!') }}</a>
                          </div>
                      @endif

                      @if ( $general->parallax_status )
                          <section id="parallax" class="text-white">
                              <div class="position-relative overflow-hidden text-center bg-light">
                                <span class="mask" style="
                                      @if ( $general->overlay_type == 'solid' )

                                      background: {{ $general->solid_color }};opacity: {{ $general->opacity }};

                                      @elseif( $general->overlay_type == 'gradient' )

                                      background: {{ $general->gradient_first_color }};
                                      background: -moz-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }}  );
                                      background: -webkit-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                                      background: linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                                      opacity: {{ $general->opacity }};

                                      @endif

                                "></span>

                                @if ( !empty($general->parallax_image) )
                                  <img alt="{{ __($pageTrans->title) }}" class="position-absolute start-0 top-0 w-100 parallax-image {{ ($general->lazy_loading) ? 'lazyload' : '' }}" data-src="{{ $general->parallax_image }}" @if (!$general->lazy_loading) src="{{ $general->parallax_image }}" @endif style="filter: blur({{ $general->blur }}px)">
                                @endif

                                <div class="container position-relative zindex-1">
                                    <div class="col text-center p-lg-5 mx-auto my-5">

                                        @if ( $page->ads_status && $advertisement->area1_status && $advertisement->area1 != null )
                                          <x-public.advertisement.area1 :advertisement="$advertisement" />
                                        @endif

                                        <h1 class="display-5 fw-normal">{{ __($pageTrans->title) }}</h1>
                                        <h2 class="fw-normal">{{ __($pageTrans->subtitle) }}</h2>

                                        @if ( $page->ads_status && $advertisement->area2_status && $advertisement->area2 != null )
                                          <x-public.advertisement.area2 :advertisement="$advertisement" />
                                        @endif
                                    </div>
                                </div>

                              </div>
                          </section>
                      @endif

                      <div class="container py-4">

                          <div class="row">
                              <div class="{{ ( $page->ads_status && ( ( $advertisement->sidebar_top_status && $advertisement->sidebar_top != null ) || ( $advertisement->sidebar_middle_status && $advertisement->sidebar_middle != null ) || ( $advertisement->sidebar_bottom_status && $advertisement->sidebar_bottom != null ) ) || $sidebar->tool_status || $sidebar->post_status ) ? 'col-lg-9' : 'col' }}">

                                  <div class="page-home">
                                    {{ $slot }}
                                  </div>

                                  <section id="content-box" class="mb-3 page-{{ $page->id }}">
                                      <div class="card">
                                          @if ( !$general->parallax_status )
                                              <div class="card-header d-block">
                                                    <h1 class="page-title">{{ __($pageTrans->title) }}</h1>
                                                    <p class="mb-0">{{ __($pageTrans->subtitle) }}</p>
                                              </div>
                                          @endif

                                          <div class="card-body {{ ($general->author_box_status) ? 'pb-0' : ''}}">
                                              @if ( Auth::user() && Auth::user()->is_admin )
                                                <div class="d-flex justify-content-center mb-3">
                                                  <a href="{{ route('admin.pages.translations.edit', $pageTrans->translations[0]['id']) }}" class="btn btn-primary">{{ __('Edit Page') }}</a>
                                                </div>
                                              @endif

                                              @if ( $page->ads_status && $advertisement->area4_status && $advertisement->area4 != null )
                                                <x-public.advertisement.area4 :advertisement="$advertisement" />
                                              @endif

                                              {!! $pageTrans->description !!}

                                              @if ( $page->ads_status && $advertisement->area5_status && $advertisement->area5 != null )
                                                <x-public.advertisement.area5 :advertisement="$advertisement" />
                                              @endif

                                              @switch( $page->type )

                                                  @case('report')
                                                        <div class="report">
                                                          @livewire('public.report')
                                                        </div>
                                                      @break

                                                  @case('contact')
                                                        <div class="contact">
                                                          @livewire('public.contact')
                                                        </div>
                                                      @break

                                                  @default
                                              @endswitch

                                            @if ( $general->share_icons_status )
                                              <div class="social-share text-center">
                                                <div class="is-divider"></div>
                                                <div class="share-icons relative">

                                                    <a wire:ignore href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                                        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}','facebook','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                        data-label="Facebook"
                                                        aria-label="Facebook"
                                                        rel="noopener noreferrer nofollow"
                                                        target="_blank"
                                                        class="btn btn-facebook btn-simple rounded p-2">
                                                        <i class="fab fa-facebook"></i>
                                                    </a>

                                                    <a wire:ignore href="https://twitter.com/intent/tweet?text={{ $pageTrans->title }}&url={{ url()->current() }}&counturl={{ url()->current() }}"
                                                        onclick="window.open('https://twitter.com/intent/tweet?text={{ $pageTrans->title }}&url={{ url()->current() }}&counturl={{ url()->current() }}','twitter','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                        aria-label="Twitter"
                                                        rel="noopener noreferrer nofollow"
                                                        target="_blank"
                                                        class="btn btn-twitter btn-simple rounded p-2">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>

                                                    <a wire:ignore href="https://www.pinterest.com/pin-builder/?url={{ url()->current() }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}"
                                                        onclick="window.open('https://www.pinterest.com/pin-builder/?url={{ url()->current() }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}','pinterest','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                        aria-label="Pinterest"
                                                        rel="noopener noreferrer nofollow"
                                                        target="_blank"
                                                        class="btn btn-pinterest btn-simple rounded p-2">
                                                        <i class="fab fa-pinterest"></i>
                                                    </a>

                                                    <a wire:ignore href="https://www.linkedin.com/shareArticle?mini=true&ro=true&title={{ $pageTrans->title }}&url={{ url()->current() }}"
                                                        onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&ro=true&title={{ $pageTrans->title }}&url={{ url()->current() }}','linkedin','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                        aria-label="Linkedin"
                                                        rel="noopener noreferrer nofollow"
                                                        target="_blank"
                                                        class="btn btn-linkedin btn-simple rounded p-2">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>

                                                    <a wire:ignore href="https://www.reddit.com/submit?url={{ url()->current() }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}"
                                                        onclick="window.open('https://www.reddit.com/submit?url={{ url()->current() }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}','reddit','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                        aria-label="Reddit"
                                                        rel="noopener noreferrer nofollow"
                                                        target="_blank"
                                                        class="btn btn-reddit btn-simple rounded p-2">
                                                        <i class="fab fa-reddit"></i>
                                                    </a>

                                                    <a wire:ignore href="https://tumblr.com/widgets/share/tool?canonicalUrl={{ url()->current() }}"
                                                        onclick="window.open('https://tumblr.com/widgets/share/tool?canonicalUrl={{ url()->current() }}','tumblr','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                                        aria-label="Tumblr"
                                                        target="_blank"
                                                        class="btn btn-tumblr btn-simple rounded p-2"
                                                        rel="noopener noreferrer nofollow">
                                                        <i class="fab fa-tumblr"></i>
                                                    </a>

                                                </div>
                                              </div>
                                            @endif

                                            @if ( $general->author_box_status )

                                              <hr class="horizontal dark">
                                              <div class="my-3">
                                                <div class="row">

                                                  <div class="col-lg-2">
                                                      <div class="position-relative mb-3">
                                                        <div class="blur-shadow-image">
                                                          <img class="w-100 rounded-3 shadow-sm {{ ($general->lazy_loading) ? 'lazyload' : '' }}" {{ ($general->lazy_loading) ? 'data-' : '' }}src="{{ $profile->avatar }}" alt="{{ __('Avatar') }}" width="100%" height="100%">
                                                        </div>
                                                      </div>
                                                  </div>

                                                  <div class="col-lg-10 ps-0">
                                                    <div class="card-body text-start py-0">

                                                      <div class="p-md-0 pt-3">
                                                        <h3 class="fw-bold mb-0">{{ $profile->fullname }}</h3>
                                                        <p class="text-uppercase text-sm mb-2">{{ $profile->position }}</p>
                                                      </div>

                                                      <p class="mb-3">{{ __($profile->bio) }}</p>

                                                      @if ( ($profile->social_status) && !empty($profile->user_socials) )

                                                        @foreach ($profile->user_socials as $element)

                                                          <a class="btn btn-{{ $element->name }} btn-simple mb-0 ps-1 pe-2 py-0" aria-label="{{ $element->name }}" href="{{ $element->url }}" target="blank">
                                                            <i class="fab fa-{{ $element->name }} fa-lg" aria-hidden="true"></i>
                                                          </a>

                                                        @endforeach

                                                      @endif

                                                    </div>
                                                  </div>

                                                </div>
                                              </div>

                                            @endif

                                          </div>
                                      </div>
                                  </section>
                              </div>

                              @if ( $page->ads_status && ( ( $advertisement->sidebar_top_status && $advertisement->sidebar_top != null ) || ( $advertisement->sidebar_middle_status && $advertisement->sidebar_middle != null ) || ( $advertisement->sidebar_bottom_status && $advertisement->sidebar_bottom != null ) ) || $sidebar->tool_status || $sidebar->post_status)
                                <div class="col-lg-3 ml-auto sidebars">
                                    <x-public.sidebar :page="$page" :general="$general" :advertisement="$advertisement" :sidebar="$sidebar" :recentPosts="$recent_posts" :popularTools="$popular_tools" :advanced="$advanced" />
                                </div>
                              @endif
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

            @if ( $general->search_box_status )
              <script>
                const searchIcon = document.getElementById('search-icon');
                const searchBox = document.getElementById('search-box');

                // Show/hide search box
                searchIcon.addEventListener('click', function () {
                  if (searchBox.style.display === 'none' || searchBox.style.display === '') {
                    searchBox.style.display = 'block';
                  } else {
                    searchBox.style.display = 'none';
                  }
                });

                // Hide search box when user clicks outside of it
                document.addEventListener('click', function (event) {
                  const isClickInsideSearchBox = searchBox.contains(event.target);
                  const isClickInsideSearchIcon = searchIcon.contains(event.target);
                  if (!isClickInsideSearchBox && !isClickInsideSearchIcon) {
                    searchBox.style.display = 'none';
                  }
                });
              </script>
            @endif

            @if ( $general->back_to_top )
                <!-- Scroll back to top -->
                <div id="backtotop"> 
                    <a href="#" class="backtotop"></a> 
                </div>

                <script type="text/javascript"> 
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
                                <span class="text-dark">{!! __(GrahamCampbell\Security\Facades\Security::clean($notice->notice)) !!}</span>
                            </div>

              							@if ( $notice->button)
              								<div class="text-center mt-3">
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