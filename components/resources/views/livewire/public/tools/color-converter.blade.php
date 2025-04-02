<div>

      <form wire:submit.prevent="onColorConverter">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
    
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Enter your Color') }}</label>
                    <input type="text" class="form-control" wire:model.defer="color" />
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn">{{ __('RGB') }}</a>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ ($data) ? $data['rgb'] : '' }}" readonly />
                            <a onclick="copyToClipboard(this)" class="btn btn-icon cursor-pointer" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn">{{ __('HEX') }}</a>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ ($data) ? $data['hex'] : '' }}" readonly />
                            <a onclick="copyToClipboard(this)" class="btn btn-icon cursor-pointer" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn">{{ __('HSL') }}</a>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ ($data) ? $data['hsl'] : '' }}" readonly />
                            <a onclick="copyToClipboard(this)" class="btn btn-icon cursor-pointer" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn">{{ __('HSV') }}</a>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ ($data) ? $data['hsv'] : '' }}" readonly />
                            <a onclick="copyToClipboard(this)" class="btn btn-icon cursor-pointer" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-auto">
                        <a class="btn">{{ __('CMYK') }}</a>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ ($data) ? $data['cmyk'] : '' }}" readonly />
                            <a onclick="copyToClipboard(this)" class="btn btn-icon cursor-pointer" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12 col-md-6">
                <div class="border" style="height: 325px; background-color: {{ ($data) ? $data['rgb'] : '' }};"></div>
            </div>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group">
            <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onColorConverter">
                  <x-loading />
                </div>
                <span>{{ __('Convert') }}</span>
              </span>
            </button>
        </div>

      </form>
	  
      <script>
          function copyToClipboard(element) {
              var text = element.parentElement.querySelector('input');
              text.select();
              document.execCommand("copy");
          }
      </script>
</div>
