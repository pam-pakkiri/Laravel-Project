<div>

      <form wire:submit.prevent="onHexToRgb">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="input-group input-group-flat mb-3">
            <input type="text" class="form-control" wire:model.defer="hex_color" placeholder="{{ __('Paste your HEX color here...') }}" required>
            <span class="input-group-text {{ ( Cookie::get('theme_mode') == 'theme-light' ) ? 'bg-white' : '' }}">
                <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /></svg>
                </a>
            </span>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onHexToRgb">
                  <x-loading />
                </div>
                <span>{{ __('Convert') }}</span>
              </span>
            </button>

            <button class="btn btn-lime" wire:click.prevent="onSample" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onSample">
                  <x-loading />
                </div>
                <span>{{ __('Sample') }}</span>
              </span>
            </button>

            <button class="btn btn-warning" wire:click.prevent="onReset" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onReset">
                  <x-loading />
                </div>
                <span>{{ __('Reset') }}</span>
              </span>
            </button>
        </div>

        @if ( !empty($data) )
            <div class="form-group my-3" wire:loading.remove wire:target="onHexToRgb">
                <label class="form-label">{{ __('Red color (R):') }}</label>
                <input type="text" class="form-control" wire:model.defer="red_color" disabled>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Green color (G):') }}</label>
                <input type="text" class="form-control" wire:model.defer="green_color" disabled>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Blue color (B):') }}</label>
                <input type="text" class="form-control" wire:model.defer="blue_color" disabled>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('CSS color') }}:</label>
                <input type="text" class="form-control" wire:model.defer="css_color" disabled>
            </div>

            <div class="form-group">
                <label class="form-label">{{ __('Color preview:') }}</label>
                <textarea class="form-control preview" disabled></textarea>
            </div>
        @endif
        
      </form>
	  
		<script>
		(function( $ ) {
		  "use strict";

			document.addEventListener('livewire:load', function () {

				window.addEventListener('showPreview', event => {
					jQuery('.preview').css('background', event.detail.css_color);
				});

			});

		})( jQuery );
		</script>
</div>