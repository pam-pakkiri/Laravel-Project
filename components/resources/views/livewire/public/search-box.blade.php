<div class="nav-item d-none d-md-flex me-2">
    <button id="search-icon" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="{{ __('Search box') }}" data-bs-original-title="{{ __('Search box') }}" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <circle cx="10" cy="10" r="7"></circle> <line x1="21" y1="21" x2="15" y2="15"></line> </svg>
    </button>

    <div id="search-box" class="search-box" wire:ignore.self>
        <div class="input-icon w-100">
            <span class="input-icon-addon">
                <span wire:loading.inline wire:target="onSearch" class="spinner-border spinner-border-sm me-2" role="status"></span>
                <svg wire:loading.remove wire:target="onSearch" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
            </span>
            <input type="text" class="form-control rounded-0" wire:model="searchQuery" wire:input="onSearch" placeholder="{{ __('Search for your tool') }}">
        </div>

        @if ( !empty($search_queries) && !empty($searchQuery) )
            <div class="card mb-3 rounded-0 overflow-auto" style="max-height: 18rem">
              <div class="card-body pb-0">
                <div class="row">
                    @foreach ($search_queries as $key => $value)
                      <div class="col-12 col-md-6 col-lg-4 mb-3">
                          <a class="card text-decoration-none cursor-pointer item-box" href="{{ (empty($value['custom_tool_link'])) ? route('home') . '/' . app()->getLocale() . '/' . $value['slug'] : $value['custom_tool_link'] }}" target="{{ $value['target'] }}">
                              <div class="card-body">
                                  <div class="d-flex align-items-center">
                                      <div class="fw-medium">{{ $value['title'] }}</div>
                                  </div>
                              </div>
                          </a>
                      </div>
                    @endforeach
                </div>
              </div>
            </div>
        @endif
    </div>
</div>