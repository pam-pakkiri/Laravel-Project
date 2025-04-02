<div>

      <form wire:submit.prevent="onVolumeConverter">

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
                <option value="gallons">{{ __('Gallons') }}</option>
                <option value="quarts">{{ __('Quarts') }}</option>
                <option value="liters">{{ __('Liters') }}</option>
                <option value="pints">{{ __('Pints') }}</option>
                <option value="cups">{{ __('Cups') }}</option>
                <option value="ounces">{{ __('Ounces') }}</option>
                <option value="tablespoons">{{ __('Table Spoons') }}</option>
                <option value="teaspoons">{{ __('Tea Spoons') }}</option>
                <option value="milliliters">{{ __('Milliliters') }}</option>
            </select>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onVolumeConverter">
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