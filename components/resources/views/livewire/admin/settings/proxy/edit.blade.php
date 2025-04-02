<div>

    <form wire:submit.prevent="onEditProxy({{ $this->proxy_id }})">
	
		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ __('IP Address') }}</label>
            <input class="form-control" type="text" wire:model.defer="ip">
        </div>

        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ __('Port') }}</label>
            <input class="form-control" type="text" wire:model.defer="port">
		</div>

        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ __('Type') }}</label>
            <select wire:model.defer="type" class="form-control">
                <option value="http">HTTP</option>
                <option value="https">HTTPs</option>
                <option value="socks4">SOCKS4</option>
                <option value="socks5">SOCKS5</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ __('Username') }}</label>
            <input class="form-control" type="text" wire:model.defer="username">
        </div>

        <div class="form-group mb-3">
            <label for="name" class="form-label">Password</label>
            <input class="form-control" type="text" wire:model.defer="password">
        </div>

        <div class="modal-footer p-0">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onEditProxy">
                        <x-loading />
                    </div>
                    <span>{{ __('Save Changes') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>