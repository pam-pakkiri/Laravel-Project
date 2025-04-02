<div>

    <form wire:submit.prevent="onUpdateDatabase" class="row">

        <!-- Begin:Update -->
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-4 p-sm-5">

                    <img src="{{ asset('assets/img/update.svg') }}" height="128" class="mb-n2">
                    <h2 class="mt-5">{{ __('Update') }}</h2>
                    <p class="text-muted">{{ __('Click the button below to update the database to the latest version!') }}</p>

					<div class="alert-message">
					  <!-- Session Status -->
					  <x-auth-session-status class="mb-4" :status="session('status')" />
												  
					  <!-- Validation Errors -->
					  <x-auth-validation-errors class="mb-4" :errors="$errors" />
					</div>

					<div class="form-group mb-0">
						<button class="btn btn-primary mx-auto d-block" wire:loading.attr="disabled">
						  <span>
							<div wire:loading.inline wire:target="onUpdateDatabase">
							  <x-loading />
							</div>
							<span>{{ __('Start') }}</span>
						  </span>
						</button>
					</div>

                </div>
            </div>
        </div>
        <!-- End:Update -->

    </form>

    <div class="text-center text-muted mt-3">
        {{ __('Go back to the') }}
        <a href="{{ route('home') }}" tabindex="-1"> {{ __('Homepage') }}</a>
    </div>

</div>
