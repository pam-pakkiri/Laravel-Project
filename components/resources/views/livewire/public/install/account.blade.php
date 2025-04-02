<div>
        <p class="text-center">{{ __('Please fill in the login information for the admin account.') }}</p>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form wire:submit.prevent="onCreateAdminAccount">
            <div class="form-group mb-3">
                <label class="form-label" for="email">{{ __('Email') }}</label>
                <input type="text" wire:model.defer="email" id="email" class="form-control @error('email') is-invalid @enderror" />
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="password">{{ __('Password') }}</label>
                <input type="password" wire:model.defer="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" />
            </div>

            <div class="col-md-12 text-center">
                <button class="btn btn-primary mt-3 mb-0">
                    <span>
                        <div wire:loading wire:target="onCreateAdminAccount">
                            <x-loading />
                        </div>
                        <span>{{ __('Continue') }}</span>
                    </span>
                </button>
            </div>
      </form>
</div>
