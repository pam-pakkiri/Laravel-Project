<div>

	<form wire:submit.prevent="onUpdateHeader" wire:ignore>

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
		<div class="card">
			<div class="card-body">
				<table class="table table table-hover table-bordered settings">

						<tr>
							<td class="align-middle"><label for="logo-light" class="fw-bold">{{ __('Logo Light') }}</label></td>
							<td class="align-middle">
								<div class="input-group">
									<span class="input-group-btn">
										<a data-input="logo-light" class="btn btn-primary mb-0 logo-light">
											<i class="fa fa-picture-o"></i> {{ __('Choose') }}
										</a>
									</span>
									<input id="logo-light" class="form-control ps-2" type="text" wire:model.defer="logo_light">
								</div>
								</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="logo-dark" class="fw-bold">{{ __('Logo Dark') }}</label></td>
							<td class="align-middle">
								<div class="input-group">
									<span class="input-group-btn">
										<a data-input="logo-dark" class="btn btn-primary mb-0 logo-dark">
											<i class="fa fa-picture-o"></i> {{ __('Choose') }}
										</a>
									</span>
									<input id="logo-dark" class="form-control ps-2" type="text" wire:model.defer="logo_dark">
								</div>
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="favicon" class="fw-bold">{{ __('Favicon') }}</label></td>
							<td class="align-middle">
								<div class="input-group">
									<span class="input-group-btn">
										<a data-input="favicon" class="btn btn-primary mb-0 favicon">
											<i class="fa fa-picture-o"></i> {{ __('Choose') }}
										</a>
									</span>
									<input id="favicon" class="form-control ps-2" type="text" wire:model.defer="favicon">
								</div>
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="sticky-header" class="fw-bold">{{ __('Sticky Header') }}</label></td>
							<td class="align-middle">
								<div class="form-check form-switch ps-0 mb-0">
									<input id="sticky-header" class="form-check-input ms-auto" type="checkbox" wire:model.defer="sticky_header">
								</div>
							</td>
						</tr>

				</table>
			</div>
		</div>

		<div class="form-group mt-4">
			<button class="btn btn-primary float-end" wire:loading.attr="disabled">
				<span>
					<div wire:loading.inline wire:target="onUpdateHeader">
						<x-loading />
					</div>
					<span>{{ __('Save Changes') }}</span>
				</span>
			</button>
		</div>

	</form>

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
	"use strict";

    document.addEventListener('livewire:load', function () {

		jQuery('.logo-light, .logo-dark, .favicon').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

		jQuery('input#logo-light').change(function() { 
			window.livewire.emit('onSetLogoLight', this.value)
		});

		jQuery('input#logo-dark').change(function() { 
			window.livewire.emit('onSetLogoDark', this.value)
		});

		jQuery('input#favicon').change(function() { 
			window.livewire.emit('onSetFavicon', this.value)
		});
	
    });

})( jQuery );
</script>