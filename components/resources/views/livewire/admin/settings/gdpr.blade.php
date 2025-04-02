<div>

	<form wire:submit.prevent="onUpdateNotice">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
		<!-- Begin:GDPR Privacy Notice -->
		<div class="col-12 mb-4">
			<div class="card">
				<div class="card-body">

					<div class="form-group mb-3">
						
						<div class="d-flex">
							<label for="ads-area-1" class="form-label">{{ __('GDPR Privacy Notice') }}</label>
							<div class="form-check form-switch ps-3">
								<input class="form-check-input ms-auto" type="checkbox" wire:model.defer="status">
							</div>
						</div>

						<div class="col">
							<textarea class="form-control" rows="8" wire:model.defer="notice"></textarea>
						</div>
					</div>
					
					<div class="row">
						<div class="input-group">

							<div class="col-12 col-md-4 pe-md-4 mb-3">
								<div class="input-group">
									<button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
									<select name="align" class="form-control ps-3" wire:model.defer="align">
										<option value="text-start">{{ __('Left') }}</option>
										<option value="text-end">{{ __('Right') }}</option>
										<option value="text-center">{{ __('Center') }}</option>
									</select>
								</div>
							</div>

							<div class="col-12 col-md-4 pe-md-4 mb-3">
								<div class="input-group">
									<button class="btn btn-secondary mb-0" type="button">{{ __('Background Color') }}</button>
		                            <select name="align" class="form-control" wire:model.defer="background">
		                                <optgroup label="{{ __('Base colors') }}">
		                                    <option value="bg-white">{{ __('White') }}</option>
		                                    <option value="bg-blue">{{ __('Blue') }}</option>
		                                    <option value="bg-azure">{{ __('Azure') }}</option>
		                                    <option value="bg-indigo">{{ __('Indigo') }}</option>
		                                    <option value="bg-purple">{{ __('Purple') }}</option>
		                                    <option value="bg-pink">{{ __('Pink') }}</option>
		                                    <option value="bg-red">{{ __('Red') }}</option>
		                                    <option value="bg-orange">{{ __('Orange') }}</option>
		                                    <option value="bg-yellow">{{ __('Yellow') }}</option>
		                                    <option value="bg-lime">{{ __('Lime') }}</option>
		                                    <option value="bg-green">{{ __('Green') }}</option>
		                                    <option value="bg-teal">{{ __('Teal') }}</option>
		                                    <option value="bg-cyan">{{ __('Cyan') }}</option>
		                                </optgroup>
		                                <optgroup label="{{ __('Light colors') }}">
		                                    <option value="bg-blue-lt">{{ __('Blue') }}</option>
		                                    <option value="bg-azure-lt">{{ __('Azure') }}</option>
		                                    <option value="bg-indigo-lt">{{ __('Indigo') }}</option>
		                                    <option value="bg-purple-lt">{{ __('Purple') }}</option>
		                                    <option value="bg-pink-lt">{{ __('Pink') }}</option>
		                                    <option value="bg-red-lt">{{ __('Red') }}</option>
		                                    <option value="bg-orange-lt">{{ __('Orange') }}</option>
		                                    <option value="bg-yellow-lt">{{ __('Yellow') }}</option>
		                                    <option value="bg-lime-lt">{{ __('Lime') }}</option>
		                                    <option value="bg-green-lt">{{ __('Green') }}</option>
		                                    <option value="bg-teal-lt">{{ __('Teal') }}</option>
		                                    <option value="bg-cyan-lt">{{ __('Cyan') }}</option>
		                                </optgroup>
		                            </select>
								</div>
							</div>

							<div class="col-12 col-md-4">
								<div class="input-group">
									<button class="btn btn-secondary mb-0" type="button">{{ __('Enable Button') }}</button>
									<select class="form-control ps-3" wire:model.defer="button">
										<option value="1">{{ __('Yes') }}</option>
										<option value="0">{{ __('No') }}</option>
									</select>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End:GDPR Privacy Notice -->

		<div class="form-group mt-3">
			<button class="btn btn-primary float-end" wire:loading.attr="disabled">
				<span>
					<div wire:loading.inline wire:target="onUpdateNotice">
						<x-loading />
					</div>
					<span>{{ __('Save Changes') }}</span>
				</span>
			</button>
		</div>

	</form>

</div>