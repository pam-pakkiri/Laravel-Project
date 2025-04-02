<div>

    <form wire:submit.prevent="onAddProxy">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ __('Type') }}</label>
            <select wire:model.defer="type" class="form-control" required>
                <option value selected style="display:none;">{{ __('Choose a proxy type...') }}</option>
                <option value="http">HTTP</option>
                <option value="https">HTTPs</option>
                <option value="socks4">SOCKS4</option>
                <option value="socks5">SOCKS5</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ __('Enter the Proxy list in the format:') }} <code>{{ __('ip:port:user:pass') }}</code> {{ __('or') }} <code>{{ __('ip:port') }}</code></label>
            <textarea class="form-control" wire:model.defer="proxies" placeholder="209.127.191.180:9279:ujhunzmy:60hcv08oz431" rows="10" required></textarea>
        </div>

        <div class="modal-footer p-0">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onAddProxy">
                        <x-loading />
                    </div>
                    <span>{{ __('Add new') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
