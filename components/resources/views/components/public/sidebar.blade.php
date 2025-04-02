@if ( $page->ads_status && $advertisement->sidebar_top_status && $advertisement->sidebar_top != null )
    <div class="mb-3 {{ $advertisement->sidebar_top_sticky ? 'sticky-top' : '' }}">
        <x-public.advertisement.sidebar-top :advertisement="$advertisement" /> 
    </div>
@endif

@if ( $sidebar->tool_status )
    <div class="card mb-3 {{ $sidebar->tool_sticky ? 'sticky-top' : '' }}">
        <div class="card-header d-block text-{{ $sidebar->tool_align }} {{ ($sidebar->tool_background !== 'bg-white') ? $sidebar->tool_background . ' text-white' : 'bg-transparent' }}">
            <h3 class="card-title">{{ __('Popular Tools') }}</h3>
        </div>
        <div class="list-group list-group-flush list-group-hoverable">

            @foreach ($popularTools  as $key => $value)
                <div class="list-group-item">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path fill="#2fb344" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"/></svg>
                            <a href="{{ ( empty( $value['custom_tool_link'] ) ) ? route('home') . '/' . $value['slug'] : $value['custom_tool_link'] }}" target="{{ $value['target'] }}" class="text-body d-block">{{ $value['title'] }}</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endif

@if ( $page->ads_status && $advertisement->sidebar_middle_status && $advertisement->sidebar_middle != null )
    <div class="mb-3 {{ $advertisement->sidebar_middle_sticky ? 'sticky-top' : '' }}">
        <x-public.advertisement.sidebar-middle :advertisement="$advertisement" />
    </div>
@endif

@if ( $sidebar->post_status )
    <div class="card mb-3 {{ $sidebar->post_sticky ? 'sticky-top' : '' }}">
        <div class="card-header d-block text-{{ $sidebar->post_align }} {{ ($sidebar->post_background !== 'bg-white') ? $sidebar->post_background . ' text-white' : 'bg-transparent' }}">
            <h3 class="card-title">{{ __('Recent Posts') }}</h3>
        </div>
        <div class="list-group list-group-flush list-group-hoverable">
            
            @foreach ($recentPosts as $key => $value)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            @if ( $general->featured_images_in_sidebar_status )
                                <div class="col-auto">
                                    <a href="{{ route('home') . '/blog/' . $value['slug'] }}">
                                        <img class="avatar {{ ($general->lazy_loading) ? 'lazyload' : '' }}" data-src="{{ $value['featured_image'] }}" @if (!$general->lazy_loading) src="{{ $value['featured_image'] }}" @endif alt="{{ $value['title'] }}"></span>
                                    </a>
                                </div>
                            @endif
                            <div class="col text-truncate">
                                <a href="{{ route('home') . '/blog/' . $value['slug'] }}" class="text-body d-block text-nowrap" title="{{ $value['title'] }}" target="{{ $value['target'] }}">{{ $value['title'] }}</a>
                                <small class="d-block text-muted text-truncate mt-n1">{{ \Carbon\Carbon::parse( ($value['updated_at']) ? $value['updated_at'] : $value['created_at'] )->format('F j, Y') }}</small>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endif

@if ( $page->ads_status && $advertisement->sidebar_bottom_status && $advertisement->sidebar_bottom != null )
    <div class="mb-3 {{ $advertisement->sidebar_bottom_sticky ? 'sticky-top' : '' }}">
        <x-public.advertisement.sidebar-bottom :advertisement="$advertisement" />
    </div>
@endif