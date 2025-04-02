<div>

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="mb-3">
              <div class="row g-2">
                  <div class="col-12 col-md-2 d-flex align-items-center">
                      <span class="mx-auto">{{ __('What is') }}</span>
                  </div>
                  <div class="col-12 col-md-2">
                      <input type="number" class="form-control" wire:model.defer="percentage">
                  </div>
                  <div class="col-12 col-md-2 d-flex align-items-center">
                      <span class="mx-auto">{{ __('% of') }}</span>
                  </div>
                  <div class="col-12 col-md-2">
                      <input type="number" class="form-control" wire:model.defer="percentageOf">
                  </div>
                  <div class="col-12 col-md-2">
                    <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled" wire:click="onPercentageCalculator">
                      <span>
                        <div wire:loading.inline wire:click="onPercentageCalculator">
                          <x-loading />
                        </div>
                        <span>{{ __('Calculate') }}</span>
                      </span>
                    </button>
                  </div>
                  <div class="col-12 col-md-2">
                      <input type="text" class="form-control" wire:model.defer="percentageResult" disabled>
                  </div>
             </div>
        </div>
        <hr>
        <div class="mb-3">
              <div class="row g-2">
                  <div class="col-12 col-md-2">
                      <input type="number" class="form-control" wire:model.defer="percentageIs">
                  </div>
                  <div class="col-12 col-md-4 d-flex align-items-center">
                      <span class="mx-auto">{{ __('is what % of') }}</span>
                  </div>
                  <div class="col-12 col-md-2">
                      <input type="number" class="form-control" wire:model.defer="percentageWhat">
                  </div>
                  <div class="col-12 col-md-2">
                    <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled" wire:click="onPercentageWhatCalculator">
                      <span>
                        <div wire:loading.inline wire:click="onPercentageWhatCalculator">
                          <x-loading />
                        </div>
                        <span>{{ __('Calculate') }}</span>
                      </span>
                    </button>
                  </div>
                  <div class="col-12 col-md-2">
                      <input type="text" class="form-control" wire:model.defer="percentageWhatResult" disabled>
                  </div>
             </div>
        </div>
        <hr>
        <div class="mb-3">
              <div class="row g-2">
                  <div class="col-12 col-md-2">
                      <input type="number" class="form-control" wire:model.defer="isPercentage">
                  </div>
                  <div class="col-12 col-md-2 d-flex align-items-center">
                      <span class="mx-auto">{{ __('is') }}</span>
                  </div>
                  <div class="col-12 col-md-2">
                      <input type="number" class="form-control" wire:model.defer="isPercentageOf">
                  </div>
                  <div class="col-12 col-md-2 d-flex align-items-center">
                      <span class="mx-auto">{{ __('% of what?') }}</span>
                  </div>
                  <div class="col-12 col-md-2">
                    <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled" wire:click="onIsPercentageOfCalculator">
                      <span>
                        <div wire:loading.inline wire:click="onIsPercentageOfCalculator">
                          <x-loading />
                        </div>
                        <span>{{ __('Calculate') }}</span>
                      </span>
                    </button>
                  </div>
                  <div class="col-12 col-md-2">
                      <input type="text" class="form-control" wire:model.defer="isPercentageOfResult" disabled>
                  </div>
             </div>
        </div>
</div>