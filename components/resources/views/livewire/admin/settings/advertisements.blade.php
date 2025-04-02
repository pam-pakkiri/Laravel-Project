<div>

    <form wire:submit.prevent="onUpdateADS">

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <div class="row">
            <!-- Begin:Ads Area 1 -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group mb-3">

                            <div class="d-flex">
                                <label class="form-label">{{ __('Before the Title') }} </label>

                                <div class="form-check form-switch ps-3">
                                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="area1_status">
                                </div>
                            </div>

                            <div class="col">
                                <textarea class="form-control" wire:model.defer="area1" rows="5"></textarea>
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-group">

                                <div class="col-12 col-md-6 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
                                        <select name="align" class="form-control ps-3" wire:model.defer="area1_align">
                                            <option value="left">{{ __('Left') }}</option>
                                            <option value="right">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Margin') }}</button>
                                        <input type="number" class="form-control ps-3" wire:model.defer="area1_margin" value="10">
                                        <span class="input-group-text">{{ __('px') }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End:Ads Area 1 -->

            <!-- Begin:Ads Area 2 -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <div class="d-flex">
                                <label class="form-label">{{ __('After the Title') }} </label>

                                <div class="form-check form-switch ps-3">
                                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="area2_status">
                                </div>
                            </div>

                            <div class="col">
                                <textarea class="form-control" rows="5" wire:model.defer="area2"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">

                                <div class="col-12 col-md-6 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
                                        <select name="align" class="form-control ps-3" wire:model.defer="area2_align">
                                            <option value="left">{{ __('Left') }}</option>
                                            <option value="right">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Margin') }}</button>
                                        <input type="number" class="form-control ps-3" value="10" wire:model.defer="area2_margin">
                                        <span class="input-group-text">{{ __('px') }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End:Ads Area 2 -->

            <!-- Begin:Ads Area 3 -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <div class="d-flex">
                                <label class="form-label">{{ __('Above the toolbox') }} </label>

                                <div class="form-check form-switch ps-3">
                                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="area3_status">
                                </div>
                            </div>

                            <div class="col">
                                <textarea class="form-control" rows="5" wire:model.defer="area3"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">

                                <div class="col-12 col-md-6 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
                                        <select name="align" class="form-control ps-3" wire:model.defer="area3_align">
                                            <option value="left">{{ __('Left') }}</option>
                                            <option value="right">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Margin') }}</button>
                                        <input type="number" class="form-control ps-3" value="10" wire:model.defer="area3_margin">
                                        <span class="input-group-text">{{ __('px') }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End:Ads Area 3 -->

            <!-- Begin:Ads Area 4 -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <div class="d-flex">
                                <label class="form-label">{{ __('Before the Content') }} </label>

                                <div class="form-check form-switch ps-3">
                                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="area4_status">
                                </div>
                            </div>

                            <div class="col">
                                <textarea class="form-control" rows="5" wire:model.defer="area4"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">

                                <div class="col-12 col-md-6 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
                                        <select name="align" class="form-control ps-3" wire:model.defer="area4_align">
                                            <option value="left">{{ __('Left') }}</option>
                                            <option value="right">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Margin') }}</button>
                                        <input type="number" class="form-control ps-3" value="10" wire:model.defer="area4_margin">
                                        <span class="input-group-text">{{ __('px') }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End:Ads Area 4 -->

            <!-- Begin:Ads Area 5 -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <div class="d-flex">
                                <label class="form-label">{{ __('After the Content') }} </label>

                                <div class="form-check form-switch ps-3">
                                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="area5_status">
                                </div>
                            </div>

                            <div class="col">
                                <textarea class="form-control" rows="5" wire:model.defer="area5"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">

                                <div class="col-12 col-md-6 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
                                        <select name="align" class="form-control ps-3" wire:model.defer="area5_align">
                                            <option value="left">{{ __('Left') }}</option>
                                            <option value="right">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Margin') }}</button>
                                        <input type="number" class="form-control ps-3" value="10" wire:model.defer="area5_margin">
                                        <span class="input-group-text">{{ __('px') }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End:Ads Area 5 -->

            <!-- Begin:Ads Sidebar Top -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <div class="d-flex">
                                <label class="form-label">{{ __('Sidebar Top') }} </label>

                                <div class="form-check form-switch ps-3">
                                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="sidebar_top_status">
                                </div>
                            </div>

                            <div class="col">
                                <textarea class="form-control" rows="5" wire:model.defer="sidebar_top"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">

                                <div class="col-12 col-md-4 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Sticky') }}</button>
                                        <select class="form-control" wire:model.defer="sidebar_top_sticky">
                                            <option value="1">{{ __('Yes') }}</option>
                                            <option value="0">{{ __('No') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
                                        <select class="form-control ps-3" wire:model.defer="sidebar_top_align">
                                            <option value="left">{{ __('Left') }}</option>
                                            <option value="right">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Margin') }}</button>
                                        <input type="number" class="form-control ps-3" value="10" wire:model.defer="sidebar_top_margin">
                                        <span class="input-group-text">{{ __('px') }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End:Ads Sidebar Top -->

            <!-- Begin:Ads Sidebar Middle -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <div class="d-flex">
                                <label class="form-label">{{ __('Sidebar Middle') }} </label>

                                <div class="form-check form-switch ps-3">
                                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="sidebar_middle_status">
                                </div>
                            </div>

                            <div class="col">
                                <textarea class="form-control" rows="5" wire:model.defer="sidebar_middle"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">

                                <div class="col-12 col-md-4 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Sticky') }}</button>
                                        <select class="form-control" wire:model.defer="sidebar_middle_sticky">
                                            <option value="1">{{ __('Yes') }}</option>
                                            <option value="0">{{ __('No') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
                                        <select name="align" class="form-control ps-3" wire:model.defer="sidebar_middle_align">
                                            <option value="left">{{ __('Left') }}</option>
                                            <option value="right">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Margin') }}</button>
                                        <input type="number" class="form-control ps-3" value="10" wire:model.defer="sidebar_middle_margin">
                                        <span class="input-group-text">{{ __('px') }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End:Ads Sidebar Middle -->

            <!-- Begin:Ads Sidebar Bottom -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <div class="d-flex">
                                <label class="form-label">{{ __('Sidebar Bottom') }} </label>

                                <div class="form-check form-switch ps-3">
                                    <input class="form-check-input ms-auto" type="checkbox" wire:model.defer="sidebar_bottom_status">
                                </div>
                            </div>

                            <div class="col">
                                <textarea class="form-control" rows="5" wire:model.defer="sidebar_bottom"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">

                                <div class="col-12 col-md-4 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Sticky') }}</button>
                                        <select class="form-control" wire:model.defer="sidebar_bottom_sticky">
                                            <option value="1">{{ __('Yes') }}</option>
                                            <option value="0">{{ __('No') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 pe-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Align') }}</button>
                                        <select name="align" class="form-control ps-3" wire:model.defer="sidebar_bottom_align">
                                            <option value="left">{{ __('Left') }}</option>
                                            <option value="right">{{ __('Right') }}</option>
                                            <option value="center">{{ __('Center') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary mb-0" type="button">{{ __('Margin') }}</button>
                                        <input type="number" class="form-control ps-3" value="10" wire:model.defer="sidebar_bottom_margin">
                                        <span class="input-group-text">{{ __('px') }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End:Ads Sidebar Bottom -->

            <div class="form-group">
                <button class="btn btn-primary float-end" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onUpdateADS">
                            <x-loading />
                        </div>
                        <span>{{ __('Save Changes') }}</span>
                    </span>
                </button>
            </div>

        </div>

    </form>

</div>