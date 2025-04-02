<div>
    <form wire:submit.prevent="onAddRedirect">
        <div class="modal-body">
			<div class="alert-message">
			  <!-- Session Status -->
			  <x-auth-session-status class="mb-4" :status="session('status')" />
										  
			  <!-- Validation Errors -->
			  <x-auth-validation-errors class="mb-4" :errors="$errors" />
			</div>

            <div class="form-group mb-3">
                <label for="old_slug" class="form-label">{{ __('Old Slug') }}</label>
                <input class="form-control" type="text" id="old_slug" wire:model.defer="old_slug">
            </div>

            <div class="form-group">
                <label for="new_slug" class="form-label">{{ __('New Slug or URL') }}</label>
                <input class="form-control" type="text" id="new_slug" wire:model.defer="new_slug">
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onAddRedirect">
                        <x-loading />
                    </div>
                    <span>{{ __('Create') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
