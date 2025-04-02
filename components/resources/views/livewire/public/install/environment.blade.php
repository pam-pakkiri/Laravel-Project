<div>
        <p class="text-center">{{ __('Below you should enter your database connection details. If you are not sure about these, contact your host.') }}</p>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form wire:submit.prevent="onCreateDatabase">

            <div class="form-group mb-3">
                <label class="form-label" for="purchase_code">{{ __('Purchase code') }} </label>
                <input type="text" wire:model.defer="purchase_code" id="purchase_code" class="form-control @error('purchase_code') is-invalid @enderror" required />
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="database_host">{{ __('Database Host') }}</label>
                <input type="text" wire:model.defer="database_host" id="database_host" class="form-control @error('database_host') is-invalid @enderror" required />
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="database_port">{{ __('Database Port') }}</label>
                <input type="text" wire:model.defer="database_port" id="database_port" class="form-control @error('database_port') is-invalid @enderror" required />
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="database_name">{{ __('Database Name') }}</label>
                <input type="text" wire:model.defer="database_name" id="database_name" class="form-control @error('database_name') is-invalid @enderror" required />
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="database_username">{{ __('Username') }}</label>
                <input type="text" wire:model.defer="database_username" id="database_username" class="form-control @error('database_username') is-invalid @enderror" required />
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="database_password">{{ __('Password') }}</label>
                <input type="password" wire:model.defer="database_password" id="database_password" class="form-control @error('database_password') is-invalid @enderror" autocomplete="off" />
            </div>

            <div class="col-md-12 text-center">
                <button class="btn btn-primary mt-3 mb-0">
                    <span>
                        <div wire:loading wire:target="onCreateDatabase">
                            <x-loading />
                        </div>
                        <span>{{ __('Save Changes') }}</span>
                    </span>
                </button>

                @if ( $continue )
                    <a class="btn btn-success mt-3 mb-0" href="{{ route('sw_account') }}">{{ __('Continue') }}</a>
                @endif

            </div>
        </form>
</div>
