<div>

      <form wire:submit.prevent="onGstCalculator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group my-3">
            <label class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gst" wire:model.defer="gst" value="exclusive">
                <span class="form-check-label">{{ __('GST Exclusive') }}</span>
            </label>
            <label class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gst" wire:model.defer="gst" value="inclusive">
                <span class="form-check-label">{{ __('GST Inclusive') }}</span>
            </label>
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Amount') }}</label>
            <div>
                <input type="number" wire:model.defer="amount" class="form-control" required>
            </div>
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('GST Rate') }}</label>
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
                <div wire:loading.inline wire:target="onGstCalculator">
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
                                <td class="fw-bold">{{ __('Net amount') }}</td>
                                <td class="align-middle">${{ $data['net_amount'] }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('GST amount') }}</td>
                                <td class="align-middle">${{ $data['gst_amount'] }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Gross amount') }}</td>
                                <td class="align-middle">${{ $data['gross_amount'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
      </form>
</div>