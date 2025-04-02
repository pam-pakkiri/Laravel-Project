<div>

      <form wire:submit.prevent="onProbabilityCalculator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Number of possible outcomes') }}</label>
            <div class="input-group">
                <input type="number" step="any" wire:model.defer="outcomes" class="form-control" required>
          </div>
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Number of events occured') }}</label>
            <div class="input-group">
              <input type="number" step="any" wire:model.defer="events_occured" class="form-control" required>
          </div>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onProbabilityCalculator">
                  <x-loading />
                </div>
                <span>{{ __('Calculate') }}</span>
              </span>
            </button>

            <button class="btn btn-lime" wire:click.prevent="onSample" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onSample">
                  <x-loading />
                </div>
                <span>{{ __('Sample') }}</span>
              </span>
            </button>

            <button class="btn btn-warning" wire:click.prevent="onReset" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onReset">
                  <x-loading />
                </div>
                <span>{{ __('Reset') }}</span>
              </span>
            </button>
        </div>

        @if ( !empty($data) )
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td class="fw-bold">{{ __('Probability of event that occurs') }}</td>
                                <td class="align-middle">{{ $data['occurs'] }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Probability of event that does not occurs') }}</td>
                                <td class="align-middle">{{ $data['not_occurs'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
      </form>
</div>