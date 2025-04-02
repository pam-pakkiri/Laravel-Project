<div>
	<form wire:submit.prevent="onUpdate">
	
		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
		<div class="card mb-3">
			<div class="card-header bg-info text-white">
				<h3 class="card-title">{{ __('Insert Global') }}</h3>
			</div>

			<div class="card-body">
				<!-- Begin:Insert Header -->
				<div class="col-12 mb-3">
					<div class="card">
						<div class="card-body">

							<div class="form-group mb-3">
								
								<div class="d-flex">
									<label for="insert-header" class="form-label">{{ __('Insert Header') }} </label>

									<div class="form-check form-switch ps-3">
										<input class="form-check-input ms-auto" type="checkbox" wire:model.defer="header_status" checked>
									</div>
								</div>

								<div class="col">
									<textarea class="form-control" id="insert-header" wire:model.defer="insert_header" rows="8"></textarea>
								</div>
							</div>
							<small class="form-hint">{{ __('Add custom scripts inside HEAD tag. You need to have') }} <code class="fw-bold">{{ __('SCRIPT') }}</code> {{ __('or') }} <code class="fw-bold">{{ __('STYLE') }}</code> {{ __('tag around scripts.') }}</small>

						</div>
					</div>
				</div>
				<!-- End:Insert Header -->

				<!-- Begin:Insert Body -->
				<div class="col-12 mb-3">
					<div class="card">
						<div class="card-body">

							<div class="form-group mb-3">

								<div class="d-flex">
									<label for="insert-body" class="form-label">{{ __('Insert Body') }} </label>

									<div class="form-check form-switch ps-3">
										<input class="form-check-input ms-auto" type="checkbox" wire:model.defer="body_status" checked>
									</div>
								</div>

								<div class="col">
									<textarea class="form-control" id="insert-body" wire:model.defer="insert_body" rows="8"></textarea>
								</div>
							</div>
							<small class="form-hint">{{ __('Add custom scripts inside BODY tag. You need to have') }} <code class="fw-bold">{{ __('SCRIPT') }}</code> {{ __('or') }} <code class="fw-bold">{{ __('STYLE') }}</code> {{ __('tag around scripts.') }}</small>

						</div>
					</div>
				</div>
				<!-- End:Insert Body -->

				<!-- Begin:Insert Footer -->
				<div class="col-12">
					<div class="card">
						<div class="card-body">

							<div class="form-group mb-3">
								
								<div class="d-flex">
									<label for="insert_footer" class="form-label">{{ __('Insert Footer') }} </label>

									<div class="form-check form-switch ps-3">
										<input class="form-check-input ms-auto" type="checkbox" wire:model.defer="footer_status" checked>
									</div>
								</div>

								<div class="col">
									<textarea class="form-control" id="insert_footer" wire:model.defer="insert_footer" rows="8"></textarea>
								</div>
							</div>
							<small class="form-hint">{{ __('Add custom scripts you might want to be loaded in the footer of your website. You need to have') }} <code class="fw-bold">{{ __('SCRIPT') }}</code> {{ __('or') }} <code class="fw-bold">{{ __('STYLE') }}</code> {{ __('tag around scripts.') }}</small>

						</div>
					</div>
				</div>
				<!-- End:Insert Footer -->
			</div>
		</div>

		<div class="card">
			<div class="card-header bg-info text-white">
				<h3 class="card-title">{{ __('LibreOffice (This feature is only for PDF tools)') }}</h3>
			</div>

			<div class="card-body">
				<table class="table table-bordered table-hover settings">
				    <tbody>
				        <tr>
				            <td class="align-middle">
				            	<label class="form-label mb-0">{{ __('Remote LibreOffice') }}</label>
				            </td>
				            <td class="w-75">
				                <div class="form-switch ps-0">
				                    <input class="form-check-input ms-auto" type="checkbox" wire:model="remote_libreoffice">
				                </div>
				            </td>
				        </tr>
				    </tbody>
				</table>
			</div>
		</div>
		
		<div class="form-group mt-4">
			<button class="btn btn-primary float-end" wire:loading.attr="disabled">
				<span>
					<div wire:loading.inline wire:target="onUpdate">
						<x-loading />
					</div>
					<span>{{ __('Save Changes') }}</span>
				</span>
			</button>
		</div>

	</form>
	
</div>