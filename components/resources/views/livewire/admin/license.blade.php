<div>
    <form wire:submit.prevent="onUpdateLicense">
        <div class="card">
            <div class="card-body">
                <p>{!! __('A :license is only valid for 1 website. Running multiple websites on a single license is a copyright violation.', ['license' => '<a href="https://codecanyon.net/licenses/standard" target="_blank">single license</a>']) !!}</p>
                <p>{{ __('So in case you only have a single license and want to transfer it from one domain to another. Just reset the license, then you can use it on the new domain.') }}</p>
                
				<div class="alert-message">
				  <!-- Session Status -->
				  <x-auth-session-status class="mb-4" :status="session('status')" />
											  
				  <!-- Validation Errors -->
				  <x-auth-validation-errors class="mb-4" :errors="$errors" />
				</div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <tbody>
                        <tr>
                            <td class="align-middle bg-light fw-bold">{{ __('Purchase Code') }}</td>
                            <td class="align-middle">
                                <input type="text" class="form-control" wire:model.lazy="purchase_code">
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle bg-light fw-bold">{{ __('Domain') }}</td>
                            <td class="align-middle">
                                <input type="text" class="form-control" wire:model.lazy="domain" disabled>
                            </td>
                        </tr>
                      </tbody>
                    </table>
                </div>

                <div class="form-group mt-3 text-end">
                    <button class="btn btn-primary" wire:loading.attr="disabled">
                      <span>
                        <div wire:loading.inline wire:target="onUpdateLicense">
                          <x-loading />
                        </div>
                        <span>{{ __('Save Changes') }}</span>
                      </span>
                    </button>

                    <a href="https://envato.themeluxury.com/reset-license/" class="btn btn-danger" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M19.933 13.041a8 8 0 1 1 -9.925 -8.788c3.899 -1 7.935 1.007 9.425 4.747"></path> <path d="M20 4v5h-5"></path> </svg>
                        {{ __('Reset License') }}
                    </a>
                </div>

            </div>
        </div>
    </form>
</div>