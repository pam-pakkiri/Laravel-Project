<div>
    
    <form wire:submit.prevent="onImportAddonPackages">
        <div class="modal-body">
            
			<div class="alert-message">
			  <!-- Session Status -->
			  <x-auth-session-status class="mb-4" :status="session('status')" />
										  
			  <!-- Validation Errors -->
			  <x-auth-validation-errors class="mb-4" :errors="$errors" />
			</div>

            <div class="form-group">
                <div class="input-group">
                    <input class="form-control ps-2" type="file" wire:model.defer="addons" accept=".zip">
                </div>
                <small class="form-hint">{{ __('Please make sure that the Addon Packages are downloaded from authorized sites.') }}</small>
            </div>
			
        </div>

        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onImportAddonPackages">
                        <x-loading />
                    </div>
                    <span>{{ __('Import') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>


