<div>

      <form wire:submit.prevent="onIlluminanceConverter">

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
                    <option value="microlux">{{ __('Microlux (µlx)') }}</option>
                    <option value="millilux">{{ __('Millilux (mlx)') }}</option>
                    <option value="lux">{{ __('Lux (lx)') }}</option>
                    <option value="kilolux">{{ __('Kilolux (klx)') }}</option>
                    <option value="lumen_per_square_meter">{{ __('Lumen per square meter (lm/m²)') }}</option>
                    <option value="lumen_per_square_centimeter">{{ __('Lumen per square centimeter (lm/cm²)') }}</option>
                    <option value="foot_candle">{{ __('Foot-candle (fc)') }}</option>
                    <option value="phot">{{ __('Phot (ph)') }}</option>
                    <option value="nox">{{ __('Nox') }}</option>
            </select>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onIlluminanceConverter">
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