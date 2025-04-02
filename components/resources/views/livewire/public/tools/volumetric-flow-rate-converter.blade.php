<div>

      <form wire:submit.prevent="onVolumetricFlowRateConverter">

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
                <optgroup label="{{ __('Per second') }}">
                    <option value="cubic_kilometers_per_second">{{ __('Cubic kilometers per second (km³/s)') }}</option>
                    <option value="cubic_meters_per_second">{{ __('Cubic meters per second (m³/s)') }}</option>
                    <option value="cubic_decimeters_per_second">{{ __('Cubic decimeters per second (dm³/s)') }}</option>
                    <option value="cubic_centimetres_per_second">{{ __('Cubic centimetres per second (cm³/s)') }}</option>
                    <option value="cubic_millimeters_per_second">{{ __('Cubic millimeters per second (mm³/s)') }}</option>
                    <option value="cubic_inches_per_second">{{ __('Cubic inches per second (in³/s)') }}</option>
                    <option value="cubic_feet_per_second">{{ __('Cubic feet per second (ft³/s)') }}</option>
                    <option value="gallons_per_second_us_liquid">{{ __('Gallons per second (U.S. liquid)') }}</option>
                    <option value="gallons_per_second_imperial">{{ __('Gallons per second (Imperial)') }}</option>
                    <option value="liters_per_second">{{ __('Liters per second (l/s)') }}</option>
                    <option value="cubic_miles_per_second">{{ __('Cubic miles per second') }}</option>
                    <option value="acre_feet_per_second">{{ __('Acre-feet per second') }}</option>
                    <option value="bushels_per_second_us">{{ __('Bushels per second (U.S.)') }}</option>
                    <option value="bushels_per_second_imperial">{{ __('Bushels per second (Imperial)') }}</option>
                </optgroup>

                <optgroup label="{{ __('Per minute') }}">
                    <option value="cubic_kilometers_per_minute">{{ __('Cubic kilometers per minute (km³/m)') }}</option>
                    <option value="cubic_meters_per_minute">{{ __('Cubic meters per minute (m³/m)') }}</option>
                    <option value="cubic_decimeters_per_minute">{{ __('Cubic decimeters per minute (dm³/m)') }}</option>
                    <option value="cubic_centimetres_per_minute">{{ __('Cubic centimetres per minute (cm³/m)') }}</option>
                    <option value="cubic_millimeters_per_minute">{{ __('Cubic millimeters per minute (mm³/m)') }}</option>
                    <option value="cubic_inches_per_minute">{{ __('Cubic inches per minute (in³/m)') }}</option>
                    <option value="cubic_feet_per_minute">{{ __('Cubic feet per minute (ft³/m)') }}</option>
                    <option value="gallons_per_minute_us_liquid">{{ __('Gallons per minute (U.S. liquid)') }}</option>
                    <option value="gallons_per_minute_imperial">{{ __('Gallons per minute (Imperial)') }}</option>
                    <option value="liters_per_minute">{{ __('Liters per minute (l/m)') }}</option>
                    <option value="cubic_miles_per_minute">{{ __('Cubic miles per minute') }}</option>
                    <option value="acre_feet_per_minute">{{ __('Acre-feet per minute') }}</option>
                    <option value="bushels_per_minute_us">{{ __('Bushels per minute (U.S.)') }}</option>
                    <option value="bushels_per_minute_imperial">{{ __('Bushels per minute (Imperial)') }}</option>
                </optgroup>
            </select>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onVolumetricFlowRateConverter">
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