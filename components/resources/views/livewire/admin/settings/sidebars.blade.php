<div>

    <form wire:submit.prevent="onUpdateSidebars">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <div class="row">
 
            <div class="col-12">

                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">{{ __('Recent Posts') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered settings">
                                <tr>
                                    <td class="align-middle w-25"><label for="status" class="fw-bold">{{ __('Status') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch ps-0 mb-0">
                                            <input class="form-check-input ms-auto" type="checkbox" wire:model="post_status">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle w-25"><label class="fw-bold">{{ __('Sticky') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch ps-0 mb-0">
                                            <input class="form-check-input ms-auto" type="checkbox" wire:model="post_sticky">
                                        </div>
                                    </td>
                                </tr>

                                @if( $post_status )
                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Number of posts you want to display') }}</label></td>
                                        <td class="align-middle">
                                            <input type="text" class="form-control" wire:model.defer="post_count">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Heading Align') }}</label></td>
                                        <td class="align-middle">
                                            <select class="form-control" wire:model.defer="post_align">
                                                <option value="start">{{ __('Left') }}</option>
                                                <option value="end">{{ __('Right') }}</option>
                                                <option value="center">{{ __('Center') }}</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Heading Background') }}</label></td>
                                        <td class="align-middle">
                                            <select name="align" class="form-control" wire:model.defer="post_background">
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
                                        </td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">{{ __('Popular Tools') }}</h3>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover table-bordered settings">
                                <tr>
                                    <td class="align-middle w-25"><label for="status" class="fw-bold">{{ __('Status') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch ps-0">
                                            <input class="form-check-input ms-auto" type="checkbox" wire:model="tool_status">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle w-25"><label class="fw-bold">{{ __('Sticky') }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check form-switch ps-0 mb-0">
                                            <input class="form-check-input ms-auto" type="checkbox" wire:model="tool_sticky">
                                        </div>
                                    </td>
                                </tr>

                                @if( $tool_status )

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Number of tools you want to display') }}</label></td>
                                        <td class="align-middle">
                                            <input type="text" class="form-control" wire:model.defer="tool_count">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Heading Align') }}</label></td>
                                        <td class="align-middle">
                                            <select class="form-control" wire:model.defer="tool_align">
                                                <option value="start">{{ __('Left') }}</option>
                                                <option value="end">{{ __('Right') }}</option>
                                                <option value="center">{{ __('Center') }}</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="align-middle"><label class="fw-bold">{{ __('Heading Background') }}</label></td>
                                        <td class="align-middle">
                                            <select name="align" class="form-control" wire:model.defer="tool_background">
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
                                        </td>
                                    </tr>
                                @endif

                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group mt-4">
                <button class="btn btn-primary float-end" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onUpdateSidebars">
                            <x-loading />
                        </div>
                        <span>{{ __('Save Changes') }}</span>
                    </span>
                </button>
            </div>

        </div>

    </form>

</div>