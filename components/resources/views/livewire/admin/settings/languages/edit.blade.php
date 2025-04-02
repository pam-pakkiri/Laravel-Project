<div>

    <form wire:submit.prevent="onEditLanguage( {{ $lang_id }} )">
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
                <label for="edit_name" class="form-label">{{ __('Name') }}</label>
                <input class="form-control" type="text" id="edit_name" wire:model.defer="name">
            </div>

            <div class="form-group">
                <label for="edit_lang" class="form-label">{{ __('Language') }}</label>
                <select class="form-control" id="edit_lang" wire:model.defer="code">
                    @foreach ($languages as $key => $value)
                    <option value="{{ $key }}">{{ $value['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span>
                    <div wire:loading wire:target="onEditLanguage">
                        <x-loading />
                    </div>
                    <span>{{ __('Save Changes') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
