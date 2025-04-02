<div>

      <form wire:submit.prevent="onMarginCalculator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Select type') }}</label>
            <div>
                <select class="form-control form-select" wire:model.defer="type">
                    <option value="profit">{{ __('Profit Margin Calculator') }}</option>
                    <option value="stock">{{ __('Stock Trading Margin Calculator') }}</option>
                    <option value="currency">{{ __('Currency Exchange Margin Calculator') }}</option>
                </select>
            </div>
        </div>

        @if ( $type == 'profit')
            <div class="form-group mb-3 ">
                <label class="form-label">{{ __('Cost') }}</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" step="any" wire:model.defer="cost" class="form-control" required>
              </div>
            </div>

            <div class="form-group mb-3 ">
                <label class="form-label">{{ __('Gross Margin') }}</label>
                <div class="input-group">
                  <input type="number" step="any" wire:model.defer="gross_margin" class="form-control" required>
                  <span class="input-group-text">%</span>
              </div>
            </div>
        @endif

        @if ( $type == 'stock')
            <div class="form-group mb-3 ">
                <label class="form-label">{{ __('Stock Price') }}</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" step="any" wire:model.defer="stock_price" class="form-control" required>
              </div>
            </div>

            <div class="form-group mb-3 ">
                <label class="form-label">{{ __('Number of Shares') }}</label>
                <div class="input-group">
                  <input type="number" step="any" wire:model.defer="number_of_shares" class="form-control" required>
                  <span class="input-group-text">%</span>
              </div>
            </div>

            <div class="form-group mb-3 ">
                <label class="form-label">{{ __('Margin Requirement') }}</label>
                <div class="input-group">
                  <input type="number" step="any" wire:model.defer="margin_requirement" class="form-control" required>
                  <span class="input-group-text">%</span>
              </div>
            </div>
        @endif

        @if ( $type == 'currency')
            <div class="form-group mb-3 ">
                <label class="form-label">{{ __('Exchange Rate') }}</label>
                <div class="input-group">
                    <input type="number" step="any" wire:model.defer="exchange_rate" class="form-control" required>
              </div>
            </div>

            <div class="form-group mb-3 ">
                <label class="form-label">{{ __('Margin Ratio') }}</label>
                <div class="input-group">
                    <select wire:model.defer="margin_ratio" class="form-control form-select">
                        <option value="1">1:1</option>
                        <option value="5">5:1</option>
                        <option value="10">10:1</option>
                        <option value="20">20:1</option>
                        <option value="25">25:1</option>
                        <option value="30">30:1</option>
                        <option value="40">40:1</option>
                        <option value="50">50:1</option>
                    </select>
              </div>
            </div>

            <div class="form-group mb-3 ">
                <label class="form-label">{{ __('Units') }}</label>
                <div class="input-group">
                  <input type="number" step="any" wire:model.defer="units" class="form-control" required>
              </div>
            </div>
        @endif

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onMarginCalculator">
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

                    @if ( !empty($data['profit']) )

                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">{{ __('Sale Revenue') }}</td>
                                    <td class="align-middle">${{ $data['profit']['sale_revenue'] }}</td>
                                </tr>

                                <tr>
                                    <td class="fw-bold">{{ __('Gross Profit') }}</td>
                                    <td class="align-middle">${{ $data['profit']['gross_profit'] }}</td>
                                </tr>

                                <tr>
                                    <td class="fw-bold">{{ __('Mark Up') }}</td>
                                    <td class="align-middle">{{ $data['profit']['mark_up'] }}%</td>
                                </tr>
                            </tbody>
                        </table>

                    @else
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">{{ __('Amount Required') }}</td>
                                    <td class="align-middle">${{ $data['amount_required'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        @endif
      </form>
</div>