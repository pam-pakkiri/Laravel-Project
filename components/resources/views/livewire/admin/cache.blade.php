<div>

    <form wire:submit.prevent="onClearCache" class="row">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <!-- Begin:Cache -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>{{ __('This feature will help you clear all stored caches.') }}</p>
                    <div class="form-group mb-0">
                        <button class="btn btn-primary" wire:loading.attr="disabled">
                            <span>
                                <div wire:loading.inline wire:target="onClearCache">
                                    <x-loading />
                                </div>
                                <span>{{ __('Clear all Cache') }}</span>
                            </span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <!-- End:Cache -->

    </form>

</div>
