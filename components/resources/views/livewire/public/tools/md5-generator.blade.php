<div>

      <form wire:submit.prevent="onMd5Generator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
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
                <div wire:loading.inline wire:target="onMd5Generator">
                  <x-loading />
                </div>
                <span>{{ __('Generate') }}</span>
              </span>
            </button>
        </div>

        @if ( !empty($data) )
          <div class="input-group input-group-flat mt-3">
              <input type="text" class="form-control" id="text" value="{{ $data['text'] }}">
              <span class="input-group-text {{ ( Cookie::get('theme_mode') == 'theme-light' ) ? 'bg-white' : '' }}">
                <a class="link-secondary cursor-pointer" value="copy" onclick="copyToClipboard()" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                </a>
              </span>
          </div>
        @endif
      </form>
	  
	<script>
	  function copyToClipboard() {
		document.getElementById("text").select();
		document.execCommand('copy');
	  }
	</script>
</div>