<div>

    <form wire:submit.prevent="onSubmitURLs" class="row">
		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
		
        <!-- Begin:Submit URLs -->
        <div class="col-12 mb-3">
            <div class="card">
                <div class="d-block card-header bg-info text-white">
                    <h3 class="card-title">{{ __('Submit URLs') }}</h3>
                    <span>{{ __('Send URLs directly to the IndexNow API.') }}</span>
                </div>
                <div class="card-body">
                    <label class="form-label">{{ __('Insert URLs to send to the IndexNow API (one per line, up to 10,000):') }}</label>
                    <textarea class="form-control" wire:model.defer="urls" rows="10" placeholder="{{ route('home') }}"></textarea>
                    <small class="form-hint">{{ __('This feature will help your links get indexed faster on search engines.') }}</small>
                </div>
            </div>
        </div>
        <!-- End:Submit URLs -->

        <div class="form-group">
            <button class="btn btn-primary float-end" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onSubmitURLs">
                        <x-loading />
                    </div>
                    <span>{{ __('Submit URLs') }}</span>
                </span>
            </button>
        </div>

    </form>
    
</div>