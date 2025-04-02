<div>

      <form wire:submit.prevent="onPasswordGenerator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
    
        <div class="form-group mb-3">
            <label class="form-label">{{ __('Password Length') }}</label>
            <select wire:model.defer="password_length" class="form-control form-select">
                <optgroup label="{{ __('Weak') }}">
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                </optgroup>
                <optgroup label="{{ __('Strong') }}">
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                </optgroup>
            </select>
        </div>

        <div class="form-group mb-3">
            <label class="form-check">
                <input class="form-check-input" type="checkbox" wire:model.defer="uppercase" />
                <span class="form-check-label">{{ __('Include Uppercase Text') }}</span>
            </label>

            <label class="form-check">
                <input class="form-check-input" type="checkbox" wire:model.defer="lowercase" />
                <span class="form-check-label">{{ __('Include Lowercase Text') }}</span>
            </label>
			
            <label class="form-check">
                <input class="form-check-input" type="checkbox" wire:model.defer="numbers" />
                <span class="form-check-label">{{ __('Include Numbers') }}</span>
            </label>

            <label class="form-check">
                <input class="form-check-input" type="checkbox" wire:model.defer="symbols" />
                <span class="form-check-label">{{ __('Include Symbols') }}</span>
            </label>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif

        <div class="form-group">
            <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onPasswordGenerator">
                  <x-loading />
                </div>
                <span>{{ __('Generate') }}</span>
              </span>
            </button>
        </div>

        @if ( !empty($data) )
            <div class="form-group mt-3">
                <label class="form-label">{{ __('Your New Password') }}</label>
                <div class="input-group input-group-flat mb-3">
                    <input type="text" id="text" class="form-control" value="{{ $data['text'] }}" />
                    <span class="input-group-text {{ ( Cookie::get('theme_mode') == 'theme-light' ) ? 'bg-white' : '' }}">
                      <a class="link-secondary cursor-pointer" value="copy" onclick="copyToClipboard()" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                      </a>
                    </span>
                </div>
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
