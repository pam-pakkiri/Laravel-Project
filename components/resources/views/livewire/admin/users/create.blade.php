<div>
    
    <form wire:submit.prevent="onCreateUser">
        <div class="modal-body">
            
			<div class="alert-message">
			  <!-- Session Status -->
			  <x-auth-session-status class="mb-4" :status="session('status')" />
										  
			  <!-- Validation Errors -->
			  <x-auth-validation-errors class="mb-4" :errors="$errors" />
			</div>

            <div class="form-group mb-3">
                <label for="fullname" class="form-label">Full name</label>
                <div class="input-group">
                    <input class="form-control @error('fullname') is-invalid @enderror" type="text" wire:model.defer="fullname" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <input class="form-control @error('email') is-invalid @enderror" type="text" wire:model.defer="email" required>
                </div>
            </div>
			
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" wire:model.defer="password" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onCreateUser">
                        <x-loading />
                    </div>
                    <span>{{ __('Add') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
