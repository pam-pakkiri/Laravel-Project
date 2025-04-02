<div>

      <form wire:submit.prevent="onWordCounter">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
        
            <div class="form-group mb-3">
                <button type="button" class="btn">
                    <span>{{ __('Words') }}</span> 
                    <span class="badge bg-warning ms-2">{{ ( $data ) ? $data['words'] : 0 }}</span>
                </button>

                <button type="button" class="btn">
                    <span>{{ __('Characters') }}</span>
                    <span class="badge bg-success ms-2">{{ ( $data ) ? $data['characters'] : 0 }}</span>
                </button>

                <button type="button" class="btn">
                    <span>{{ __('Characters (with spaces)') }}</span>
                    <span class="badge bg-primary ms-2">{{ ( $data ) ? $data['characters_with_spaces'] : 0 }}</span>
                </button>

                <button type="button" class="btn">
                    <span>{{ __('Paragraphs') }}</span>
                    <span class="badge bg-danger ms-2">{{ ( $data ) ? $data['paragraphs'] : 0 }}</span>
                </button>
            </div>

            <div class="form-group mb-3">
                <textarea class="form-control" wire:model.defer="text" rows="10" placeholder="{{ __('Paste your content here...') }}" required></textarea>
            </div>

            @if ( \App\Models\Admin\General::first()->captcha_status )
              <x-public.recaptcha />
            @endif
            
            <div class="form-group">
                <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
                  <span>
                    <div wire:loading.inline wire:target="onWordCounter">
                      <x-loading />
                    </div>
                    <span>{{ __('Count') }}</span>
                  </span>
                </button>
            </div>

      </form>
</div>