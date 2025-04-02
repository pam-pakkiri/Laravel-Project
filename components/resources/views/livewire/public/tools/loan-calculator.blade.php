<div>

      <form wire:submit.prevent="onLoanCalculator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Loan Amount') }}</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="any" wire:model.defer="amount" class="form-control">
          </div>
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Loan Term In Months') }}</label>
            <div class="input-group">
                <input type="number" step="any" wire:model.defer="months" class="form-control">
          </div>
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Interest Rate Per Year') }}</label>
            <div class="input-group">
                <input type="number" step="any" wire:model.defer="rate" class="form-control" required>
                <span class="input-group-text">%</span>
          </div>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onLoanCalculator">
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
                                <td class="fw-bold">{{ __('Monthly Payments') }}</td>
                                <td>${{ $data['monthly_payments'] }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Total Cost of Loan') }}</td>
                                <td>${{ $data['total_cost_of_loan'] }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Total Interest') }}</td>
                                <td>${{ $data['total_interest'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
      </form>
</div>