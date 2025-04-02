<div>
      <form wire:submit.prevent="onIcoConverter">

        <div class="image-container mb-3">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            
            <div class="image-wrapper {{ ($convertType == 'remoteURL') ? 'show-remote-box' : '' }}">

                <div class="local-image-box dropzone d-flex flex-column p-3">
                    <div class="d-flex mt-auto mx-auto w-75">
                      <div class="row w-100">
                          <div class="col">
                            <div class="form-group">
                              <input type="file" class="form-control" wire:model.defer="local_image" accept=".jpg, .jpeg, .png, .bmp, .webp">
                            </div>
                          </div>
                          <p class="mt-3 text-center">{{ __('Maximum upload file size') }}: {{ \App\Models\Admin\General::first()->file_size }} {{ __(' MB') }}</p>
                      </div>
                    </div>

                    <div class="d-flex mt-auto flex-end">
                        <small class="ms-auto badge bg-cyan-lt cursor-pointer" wire:click="onConvertType('remoteURL')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /></svg>
                            {{ __('Use Remote URL') }}
                        </small>
                    </div>
                </div>

                <div class="remote-box d-flex flex-column">
                      <div class="d-flex mt-auto mx-auto w-75">
                        <div class="row w-100">
                            <div class="col">
                                <div class="input-group input-group-flat">
                                    <input type="text" id="remote_url" class="form-control" wire:model.defer="remote_url" placeholder="https://..." />
                                    <span class="input-group-text {{ ( Cookie::get('theme_mode') == 'theme-light' ) ? 'bg-white' : '' }}">
                                        <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /></svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                      </div>
					  
                      <div class="d-flex mt-auto flex-end">
                          <small class="ms-auto badge bg-cyan-lt cursor-pointer" wire:click="onConvertType('localImage')">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="19" x2="21" y2="19" /><rect x="5" y="6" width="14" height="10" rx="1" /></svg>
                              {{ __('Upload from device') }}
                          </small>
                      </div>
                </div>

            </div>
        </div>

          <div class="form-group my-3">
            <div class="form-label">{{ __('Icon size') }}</div>
            <select class="form-control form-select" wire:model.defer="icon_size">
                 <option value="16">16 x 16 {{ __('Pixel') }}</option>
                 <option value="24">24 x 24 {{ __('Pixel') }}</option>
                 <option value="32">32 x 32 {{ __('Pixel') }}</option>
                 <option value="48">48 x 48 {{ __('Pixel') }}</option>
                 <option value="64">64 x 64 {{ __('Pixel') }}</option>
                 <option value="96">96 x 96 {{ __('Pixel') }}</option>
                 <option value="128">128 x 128 {{ __('Pixel') }}</option>
                 <option value="192">192 x 192 {{ __('Pixel') }}</option>
                 <option value="256">256 x 256 {{ __('Pixel') }}</option>
                 <option value="all">{{ __('All sizes') }}</option>
            </select>
          </div>

          @if ( \App\Models\Admin\General::first()->captcha_status )
            <x-public.recaptcha />
          @endif
        
          <div class="form-group">
              <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
                <span>
                  <div wire:loading.inline wire:target="onIcoConverter">
                    <x-loading />
                  </div>
                  <span>{{ __('Convert') }}</span>
                </span>
              </button>
          </div>

        @if ( !empty($data) )  
            <div class="text-center mt-3" wire:loading.remove wire:target="onIcoConverter">
                <span class="avatar avatar-xl mb-3 border d-block mx-auto" style="background-image: url({{ $data['thumbnail'] }});"></span>
                <a href="{{ $data['thumbnail'] }}" class="btn btn-success" title="{{ __('Download') }}" download="{{ \App\Models\Admin\General::orderBy('id', 'DESC')->first()->prefix . time() }}">{{ __('Download') }}</a>
            </div>
        @endif 
		
      </form>

      <script>
      (function( $ ) {
        "use strict";

          document.addEventListener('livewire:load', function () {

          var el = document.getElementById('paste');

          if(el){

            el.addEventListener('click', function(paste) {

              paste = document.getElementById('paste');

              '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>' === paste.innerHTML ? (remote_url.value = "", paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect></svg>') : navigator.clipboard.readText().then(function(clipText) {

                @this.set('remote_url', clipText);

              }, paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>');

            });
          }
              
              jQuery('input#remote_url').change(function() { 
                window.livewire.emit('onSetRemoteURL', this.value)
              });

          });

      })( jQuery );
      </script>
</div>