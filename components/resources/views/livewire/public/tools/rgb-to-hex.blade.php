<div>

      <form wire:submit.prevent="onRgbToHex">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>{{ __('Red color (R):') }}</td>
                        <td><input type="number" class="form-control" wire:model.defer="red_color"></td>
                        <td><div id="slider" class="w-100" wire:ignore></div><input type="range" class="form-range d-flex align-items-center" wire:change="onSetRedColor($event.target.value)" value="{{ !empty($red_color) ? $red_color : '' }}" min="0" max="255" step="1"></td>
                    </tr>

                    <tr>
                        <td>{{ __('Green color (G):') }}</td>
                        <td><input type="number" class="form-control" wire:model.defer="green_color"></td>
                        <td><input type="range" class="form-range d-flex align-items-center" wire:change="onSetGreenColor($event.target.value)" value="{{ !empty($green_color) ? $green_color : '' }}" min="0" max="255" step="1"></td>
                    </tr>

                    <tr>
                        <td>{{ __('Blue color (B):') }}</td>
                        <td><input type="number" class="form-control" wire:model.defer="blue_color"></td>
                        <td><input type="range" class="form-range d-flex align-items-center" wire:change="onSetBlueColor($event.target.value)" value="{{ !empty($blue_color) ? $blue_color : '' }}" min="0" max="255" step="1"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onRgbToHex">
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
            <div class="table-responsive mt-3" wire:loading.remove wire:target="onRgbToHex">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>{{ __('Color preview:') }}</td>
                            <td><textarea class="form-control preview" disabled></textarea></td>
                        </tr>
                        <tr>
                            <td>{{ __('Hex color code:') }}</td>
                            <td>
                                <input type="text" class="form-control" wire:model.defer="hex_color" disabled>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

	</form>
	<script>
	(function( $ ) {
	  "use strict";

		document.addEventListener('livewire:load', function () {

			window.addEventListener('showPreview', event => {
				jQuery('.preview').css('background', event.detail.preview_color);
			});

		});

	})( jQuery );
	</script>
</div>