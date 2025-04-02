<div>
      <form wire:submit.prevent="onBase64ToImage">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

          <div class="form-group mb-3">
            <div class="form-label">{{ __('Base64 String') }}</div>
            <textarea class="form-control" rows="10" placeholder="{{ __('Paste your Base64 string') }}" wire:model.defer="base64_string"></textarea>
          </div>

          @if ( \App\Models\Admin\General::first()->captcha_status )
            <x-public.recaptcha />
          @endif
        
          <div class="form-group">
              <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
                <span>
                  <div wire:loading.inline wire:target="onBase64ToImage">
                    <x-loading />
                  </div>
                  <span>{{ __('Convert to Image') }}</span>
                </span>
              </button>
          </div>

      </form>

        <div class="modal fade" id="modalPreviewDownloadImage" tabindex="-1" role="dialog" aria-labelledby="modalPreviewDownloadImage" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">
                    <svg baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 36 36" class="icon me-1 my-auto"><path fill="#A4D06D" d="M16.688 25.728l-6.61-6.61 2.152-2.152 3.902 3.902 6.08-9.758 2.583 1.61"></path><path fill="#A4D06D" d="M18 35.875C8.144 35.875.125 27.855.125 18S8.145.125 18 .125 35.875 8.145 35.875 18 27.855 35.875 18 35.875zm0-33.468C9.402 2.407 2.407 9.402 2.407 18c0 8.598 6.995 15.593 15.593 15.593 8.598 0 15.593-6.995 15.593-15.593 0-8.598-6.995-15.593-15.593-15.593z"></path></svg>
                    <span>{{ __('Save your image') }}</span>
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group text-center mx-auto mb-3">
                        <a class="btn btn-success download-image">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg>
                            {{ __('Download Image') }}
                        </a>
                    </div>

                    <p><img class="preview-download-image img-fluid d-block m-auto"></p>
                    <p>{{ __('Note: This is a preview only. Click the "Download Image" button for the final image.') }}</p>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>

              </div>
            </div>
        </div>
        
        <script>
        (function( $ ) {
          "use strict";

            document.addEventListener('livewire:load', function () {

                window.addEventListener('showModal', event => {
                    jQuery('.download-image').attr( 'href', event.detail.download );
                    jQuery('.preview-download-image').attr('src', event.detail.preview);
                    jQuery('#' + event.detail.id).modal('show');
                });

            });

        })( jQuery );
        </script>
</div>