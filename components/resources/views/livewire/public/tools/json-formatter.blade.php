<div>   

      <form wire:submit.prevent="onJsonFormatter">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3"  wire:ignore>
           <div id="json" style="width:100%;height:400px;"></div>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onJsonFormatter">
                  <x-loading />
                </div>
                <span>{{ __('Format') }}</span>
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
          <div class="form-group position-relative mt-3">
              <div id="json_result" style="width:100%;height:400px;"></div>
          </div>
        @endif

      </form>
	  
		<script type="text/javascript" src="{{ asset('assets/js/jsoneditor.min.js') }}"></script>
		<link href="{{ asset('assets/css/jsoneditor.min.css') }}" rel="stylesheet">

		<script>
		(function( $ ) {
		  "use strict";

			document.addEventListener('livewire:load', function () {

				// Create the editor
				const container = document.getElementById("json");
				const options = {
					mode: 'code',
					mainMenuBar: false,
					onChangeText: function (json) {
					  window.livewire.emit('onSetJsonData', json)
					}
				};

				const editor = new JSONEditor(container, options);

				///
				window.addEventListener('onSample', event => {
					editor.setText( event.detail.json );
					window.livewire.emit('onSetJsonData', event.detail.json)
				});

				window.addEventListener('onReset', event => {
					editor.setText( event.detail.json );
					window.livewire.emit('onSetJsonData', event.detail.json)
				});

				//
				window.addEventListener('jsonResult', event => {

					const jsonContainer = document.getElementById("json_result");
					const jsonOptions = {
						mode: 'code',
						mainMenuBar: false,
					};

					const jsonEditor = new JSONEditor(jsonContainer, jsonOptions, $.parseJSON(event.detail.json));

				});

			});

		})( jQuery );
		</script>
</div>