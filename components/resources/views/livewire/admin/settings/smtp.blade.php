<div>

	<form wire:submit.prevent="onUpdateSMTP" wire:ignore>

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
		<div class="card">
			<div class="card-header bg-info text-white">
				<h3 class="card-title">{{ __('SMTP Configuration Settings') }}</h3>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-hover settings">

					<tr>
						<td class="align-middle"><label class="form-label">{{ __('Email From Address') }}</label></td>
						<td class="align-middle">
							<input class="form-control ms-auto" type="text" wire:model.defer="mail_from_address" placeholder="noreply@themeluxury.com">
							<small class="form-hint">{{ __('The email address to which you want to send the message. This email address will be used in the \'From\' field.') }}</small>
						</td>
					</tr>

					<tr>
						<td class="align-middle"><label class="form-label">{{ __('Email To Address') }}</label></td>
						<td class="align-middle">
							<input class="form-control ms-auto" type="text" wire:model.defer="mail_to_address" placeholder="admin@themeluxury.com">
							<small class="form-hint">{{ __('The email address to which you want to receive the message. This email address will be used in the \'To\' field.') }}</small>
						</td>
					</tr>

					<tr>
						<td class="align-middle"><label class="form-label">{{ __('Host') }}</label></td>
						<td class="align-middle">
							<input class="form-control ms-auto" type="text" wire:model.defer="host" placeholder="smtp.gmail.com">
							<small class="form-hint">{{ __('Your mail server.') }}</small>
						</td>
					</tr>

					<tr>
						<td class="align-middle"><label class="form-label">{{ __('Port') }}</label></td>
						<td class="align-middle">
							<input class="form-control ms-auto" type="text" wire:model.defer="port" placeholder="587">
							<small class="form-hint">{{ __('The port to your mail server.') }}</small>
						</td>
					</tr>

					<tr>
						<td class="align-middle"><label class="form-label">{{ __('Username') }}</label></td>
						<td class="align-middle">
							<input class="form-control ms-auto" type="text" wire:model.defer="username" placeholder="themeluxury@gmail.com">
							<small class="form-hint">{{ __('The username to login to your mail server.') }}</small>
						</td>
					</tr>

					<tr>
						<td class="align-middle"><label class="form-label">{{ __('Password') }}</label></td>
						<td class="align-middle">
							<input class="form-control ms-auto" type="password" wire:model.defer="password" placeholder="hpnsegxygohzob">
							<small class="form-hint">{{ __('The password to login to your mail server.') }}</small>
						</td>
					</tr>

					<tr>
						<td class="align-middle"><label class="form-label">{{ __('Encryption') }}</label></td>
						<td class="align-middle">
							<select class="form-control ms-auto" type="text" wire:model.defer="encryption">
								<option value="tls">TLS</option>
								<option value="ssl">SSL</option>
							</select>
							<small class="form-hint">{{ __('For most servers SSL/TLS is the recommended option.') }}</small>
						</td>
					</tr>

				</table>			

			</div>
		</div>

		<div class="form-group mt-4">
			<button class="btn btn-primary float-end" wire:loading.attr="disabled">
				<span>
					<div wire:loading.inline wire:target="onUpdateSMTP">
						<x-loading />
					</div>
					<span>{{ __('Save Changes') }}</span>
				</span>
			</button>
		</div>

	</form>

</div>