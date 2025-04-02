<div>

    <form wire:submit.prevent="onAddLanguage">

        <div class="modal-body">
			<div class="alert-message">
			  <!-- Session Status -->
			  <x-auth-session-status class="mb-4" :status="session('status')" />
										  
			  <!-- Validation Errors -->
			  <x-auth-validation-errors class="mb-4" :errors="$errors" />
			</div>
            
            @php

                $languages = json_decode($languages, true);

            @endphp
        
		<div class="form-group mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input class="form-control" type="text" id="name" wire:model.defer="name">
            </div>

            <div class="form-group" wire:ignore>
                <label for="name" class="form-label">{{ __('Language') }}</label>
                <select id="lang_code" class="form-control" wire:model.defer="code">
                    <optgroup label="{{ __('Languages') }}">
                        @foreach ($languages as $key => $value)
                            <option value="{{ $key }}">{{ $value['name'] }}</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span>
                    <div wire:loading wire:target="onAddLanguage">
                        <x-loading />
                    </div>
                    <span>{{ __('Add new') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
