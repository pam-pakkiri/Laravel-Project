<div>

      <form wire:submit.prevent="onCurrencyConverter">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Value') }}</label>
            <input type="number" wire:model.defer="from_value" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Convert From :from to Others', ['from' => ucfirst(str_replace('_', ' ', $convert_from)) ]) }}</label>
            <select wire:model.defer="convert_from" class="form-control form-select">
                <optgroup label="{{ __('Popular Currencies') }}">
                    <option value="EUR">{{ __('EUR - Euro') }}</option>
                    <option value="USD">{{ __('USD - US Dollar') }}</option>
                    <option value="GBP">{{ __('GBP - Pound Sterling') }}</option>
                    <option value="INR">{{ __('INR - Indian Rupee') }}</option>
                    <option value="AUD">{{ __('AUD - Australian Dollar') }}</option>
                    <option value="CAD">{{ __('CAD - Canadian Dollar') }}</option>
                    <option value="JPY">{{ __('JPY - Japanese yen') }}</option>
                </optgroup>
                <optgroup label="{{ __('Other Common Currencies') }}">
                    <option value="BGN">{{ __('BGN - Bulgarian Lev') }}</option>
                    <option value="BRL">{{ __('BRL - Brasilian Real') }}</option>
                    <option value="CHF">{{ __('CHF - Swiss Franc') }}</option>
                    <option value="CNY">{{ __('CNY - Chinese Yuan Renminbi') }}</option>
                    <option value="CZK">{{ __('CZK - Czech Koruna') }}</option>
                    <option value="DKK">{{ __('DKK - Danish Krone') }}</option>
                    <option value="HKD">{{ __('HKD - Hong Kong Dollar') }}</option>
                    <option value="HRK">{{ __('HRK - Croatian Kuna') }}</option>
                    <option value="HUF">{{ __('HUF - Hungarian Forint') }}</option>
                    <option value="IDR">{{ __('IDR - Indonesian Rupiah') }}</option>
                    <option value="ILS">{{ __('ILS - Israeli Shekel') }}</option>
                    <option value="KRW">{{ __('KRW - South Korean Won') }}</option>
                    <option value="LTL">{{ __('LTL - Lithuanian Litas') }}</option>
                    <option value="LVL">{{ __('LVL - Latvian Lats') }}</option>
                    <option value="MXN">{{ __('MXN - Mexican Peso') }}</option>
                    <option value="MYR">{{ __('MYR - Malaysian Ringgit') }}</option>
                    <option value="NOK">{{ __('NOK - Norwegian Krone') }}</option>
                    <option value="NZD">{{ __('NZD - New Zealand Dollar') }}</option>
                    <option value="PHP">{{ __('PHP - Philippine Peso') }}</option>
                    <option value="PLN">{{ __('PLN - Polish Zloty') }}</option>
                    <option value="RON">{{ __('RON - New Romanian Leu') }}</option>
                    <option value="RUB">{{ __('RUB - Russian Rouble') }}</option>
                    <option value="SEK">{{ __('SEK - Swedish Krona') }}</option>
                    <option value="SGD">{{ __('SGD - Singapore Dollar') }}</option>
                    <option value="THB">{{ __('THB - Thai Baht') }}</option>
                    <option value="TRY">{{ __('TRY - Turkish Lira') }}</option>
                    <option value="ZAR">{{ __('ZAR - South African Rand') }}</option>
                </optgroup>
            </select>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onCurrencyConverter">
                  <x-loading />
                </div>
                <span>{{ __('Convert') }}</span>
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
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <td class="fw-bold">{{ ucfirst(str_replace('_', ' ', $from_name)) }} {{ __('to') }} {{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

      </form>
</div>