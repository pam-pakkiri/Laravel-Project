<div>

      <form wire:submit.prevent="onPaypalFeeCalculator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Enter An Amount (USD)') }}</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="any" wire:model.defer="amount" class="form-control" required>
          </div>
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Fee Rate') }}</label>
            <div>
                <select class="form-control form-select" wire:model.defer="fee">
                    <optgroup label="Domestic">
                        <option value="2.9||.30">2.9% + $.30 (via online transaction)</option>
                        <option value="2.7||.30">2.7% + $.30 (via store location)</option>
                        <option value="2.2||.30">2.2% + $.30 (Nonprofit)</option>
                        <option value="5||.05">5% + $.05 (Micropayment)</option>
                    </optgroup>
                    <optgroup label="International">
                        <option value="4.4||.30">4.4% + $.30 (via online transaction)</option>
                        <option value="4.2||.30">4.2% + $.30 (via store location)</option>
                        <option value="3.7||.30">3.7% + $.30 (Nonprofit)</option>
                        <option value="6.5||.05">6.5% + $.05 (Micropayment)</option>
                    </optgroup>
                    <optgroup label="Mobile Card Reader">
                        <option value="2.7||.00">2.7% (swiped &amp; check-in transactions)</option>
                        <option value="3.5||.15">3.5% + $.15 (keyed or scanned transactions)</option>
                        <option value="5.7||.00">4.2% (International +1.5% cross-border fee)</option>
                    </optgroup>
                    <optgroup label="Virtual Terminal">
                        <option value="3.1||.30">3.1% + $.30 (Domestic)</option>
                        <option value="4.6||.30">4.6% + $.30 (Cross-border)</option>
                    </optgroup>
                </select>
            </div>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onPaypalFeeCalculator">
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
                    <div class="table-responsive">
                        <table class="table text-center bg-muted text-white">
                            <tbody>
                                <tr>
                                    <td class="pb-2 p-4 border border-white">
                                        <p class="fw-bold h3">${{ $data['total_fee'] }}</p>
                                        <p>{{ __('Total fees') }}</p>
                                    </td>
                                    <td class="pb-2 p-4 border border-white">
                                        <p class="fw-bold h3">{{ __('You will receive') }}</p>
                                        <p>${{ $data['recieve_fee'] }} {{ __('If you invoice for') }} ${{ $this->amount }}</p>
                                    </td>
                                    <td class="pb-2 p-4 border border-white">
                                        <p class="fw-bold h3">${{ $data['ask_for'] }}</p>
                                        <p>{{ __('You should ask for If you need') }} ${{ $this->amount }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
      </form>
</div>