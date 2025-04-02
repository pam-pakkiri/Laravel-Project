<div>

      <form wire:submit.prevent="onChargeConverter">

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
                <option value="coulomb">{{ __('coulomb (C)') }}</option>
                <option value="megacoulomb">{{ __('megacoulomb (MC)') }}</option>
                <option value="kilocoulomb">{{ __('kilocoulomb (kC)') }}</option>
                <option value="millicoulomb">{{ __('millicoulomb (mC)') }}</option>
                <option value="microcoulomb">{{ __('microcoulomb (µC)') }}</option>
                <option value="nanocoulomb">{{ __('nanocoulomb (nC)') }}</option>
                <option value="picocoulomb">{{ __('picocoulomb (pC)') }}</option>
                <option value="abcoulomb">{{ __('abcoulomb (abC)') }}</option>
                <option value="emu">{{ __('EMU of charge') }}</option>
                <option value="statcoulomb">{{ __('statcoulomb (stC)') }}</option>
                <option value="esu">{{ __('ESU of charge') }}</option>
                <option value="franklin">{{ __('franklin (Fr)') }}</option>
                <option value="ampere_hour">{{ __('ampere-hour (A*h)') }}</option>
                <option value="ampere_minute">{{ __('ampere-minute (A*min)') }}</option>
                <option value="ampere_second">{{ __('ampere-second (A*s)') }}</option>
                <option value="faraday">{{ __('faraday (based on carbon 12)') }}</option>
                <option value="elementary">{{ __('Elementary charge (e)') }}</option>
            </select>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onChargeConverter">
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