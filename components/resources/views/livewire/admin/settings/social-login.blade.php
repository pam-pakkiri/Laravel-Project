<div>

    <form wire:submit.prevent="onUpdateSocialLogin" class="row">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <!-- Begin:Google Login -->
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">{{ __('Google Login') }} (<a href="https://docs.themeluxury.com/sumowebtools/getting-started/how-to-get-google-client-id-and-client-secret/" target="_blank" class="text-white">{{ __('How to get Google Client ID and Client Secret') }}</a>)</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover settings">

                            <tr>
                                <td class="align-middle w-25"><label class="fw-bold">{{ __('Status') }}</label></td>
                                <td class="align-middle">
                                    <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="google_login_status">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Google Client ID') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.defer="google_client_id">
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Google Client Secret') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.defer="google_client_secret">
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Google Callback URL') }}</label></td>
                                <td class="align-middle">
                                    <input class="form-control" value="{{ url('/') . env('GOOGLE_REDIRECT_URL') }}" disabled>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:Google Login -->

        <!-- Begin:Facebook Login -->
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">{{ __('Facebook Login') }} (<a href="https://docs.themeluxury.com/sumowebtools/getting-started/how-to-get-facebook-client-id-and-client-secret/" target="_blank" class="text-white">{{ __('How to get Facebook Client ID and Client Secret') }}</a>)</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover settings">
                            <tr>
                                <td class="align-middle w-25"><label class="fw-bold">{{ __('Status') }}</label></td>
                                <td class="align-middle">
                                    <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="facebook_login_status">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Facebook Client ID') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.defer="facebook_client_id">
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Facebook Client Secret') }}</label></td>
                                <td class="align-middle">
                                    <input type="text" class="form-control" wire:model.defer="facebook_client_secret">
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle"><label class="form-label">{{ __('Facebook Callback URL') }}</label></td>
                                <td class="align-middle">
                                    <input class="form-control" value="{{ url('/') . env('FACEBOOK_REDIRECT_URL') }}" disabled>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:Facebook Login -->

        <div class="form-group">
            <button class="btn btn-primary float-end" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onUpdateSocialLogin">
                        <x-loading />
                    </div>
                    <span>{{ __('Save Changes') }}</span>
                </span>
            </button>
        </div>

    </form>
    
</div>