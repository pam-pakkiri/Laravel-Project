<section id="tools-box">
  @if ( !empty($tool_with_categories) )
      @foreach ($tool_with_categories as $key => $value)

        @if ( $page->ads_status && $advertisement->area3_status && $advertisement->area3 != null )
          <x-public.advertisement.area3 :advertisement="$advertisement" />
        @endif

        <div class="card mb-3">
            <div class="d-block card-header category-box text-{{ $value['align'] }} {{ ($value['background'] !== 'bg-white') ? $value['background'] . ' text-white' : 'bg-transparent' }}">
                <h3 class="card-title" id="{{ \Illuminate\Support\Str::slug($value['title'], '-') }}">
                  <a href="#{{ \Illuminate\Support\Str::slug($value['title'], '-') }}" title="{{ __($value['title']) }}">{{ __($value['title']) }}</a>
                </h3>
                <span>{{ __($value['description']) }}</span>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    @foreach ($value['pages'] as $key2 => $value2)
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <a class="card text-decoration-none cursor-pointer item-box" href="{{ (empty($value2['custom_tool_link'])) ? route('home') . '/' . $value2['slug'] : $value2['custom_tool_link'] }}" target="{{ $value2['target'] }}">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                      @if ( $general->icon_before_tool_name_status )
                                        <img class="avatar me-3 bg-transparent {{ ($general->lazy_loading) ? 'lazyload' : '' }}" data-src="{{ ($value2['icon_image']) ? $value2['icon_image'] : asset('assets/img/no-thumb.svg') }}" @if (!$general->lazy_loading) src="{{ ($value2['icon_image']) ? $value2['icon_image'] : asset('assets/img/no-thumb.svg') }}" @endif alt="{{ $value2['title'] }}">
                                      @endif
                                      <div class="fw-medium">{{ $value2['title'] }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      @endforeach

  @else

  @if ( $page->ads_status && $advertisement->area3_status && $advertisement->area3 != null )
    <x-public.advertisement.area3 :advertisement="$advertisement" />
  @endif
  
  <div class="row">
      @foreach ($tools as $key => $value)
      <div class="col-12 col-md-6 col-lg-4 mb-3">
          <a class="card text-decoration-none cursor-pointer item-box" href="{{ ( empty( $value['custom_tool_link'] ) ) ? route('home') . '/' . $value['slug'] : $value['custom_tool_link'] }}" target="{{ $value['target'] }}">
              <div class="card-body">
                  <div class="d-flex align-items-center">
                      <img class="avatar me-3 bg-transparent {{ ($general->lazy_loading) ? 'lazyload' : '' }}" data-src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}" @if (!$general->lazy_loading) src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}" @endif alt="{{ $value['title'] }}">
                      <div>
                          <div class="fw-medium">{{ $value['title'] }}</div>
                      </div>
                  </div>
              </div>
          </a>
      </div>
      @endforeach
  </div>
  @endif
</section>