<div>

      <form wire:submit.prevent="onConfidenceIntervalCalculator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Sample Mean (x)') }}</label>
            <div>
                <input type="number" wire:model.defer="sample_mean" class="form-control" required>
            </div>
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Sample Size (n)') }}</label>
            <div>
                <input type="number" wire:model.defer="sample_size" class="form-control" required>
            </div>
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Standard Deviation (s)') }}</label>
            <div>
                <input type="number" wire:model.defer="standrad_devation" class="form-control" required>
            </div>
        </div>

        <div class="form-group mb-3 ">
            <label class="form-label">{{ __('Confidence Level') }}</label>
            <div>
                <select class="form-control form-select" wire:model.defer="confidence_level">
                    <option value="99.9">99.9%</option>
                    <option value="99.5">99.5%</option>
                    <option value="99">99%</option>
                    <option value="95">95%</option>
                    <option value="90">90%</option>
                    <option value="85">85%</option>
                    <option value="80">80%</option>
                    <option value="75">75%</option>
                    <option value="70">70%</option>
                </select>
            </div>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group text-center">
            <button class="btn btn-info" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onConfidenceIntervalCalculator">
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
                <div class="col-12 col-md-4">
                    <table class="table table-bordered table-hover text-center">
                        <tbody>
                            <tr>
                                <td class="pb-2 p-3 bg-success text-white">
                                    <h3>x = {{ $this->sample_mean }}, {{ $this->confidence_level }}% CL</h3>
                                    <h3>[{{ $data['lower'] }}, {{ $data['upper'] }}]</h3>
                                    <p>{{ __('You can be :cl% confident that the population mean (μ) falls between :lower and :upper.', ['cl' => $this->confidence_level, 'lower' => $data['lower'], 'upper' => $data['upper']]) }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-12 col-md-8">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td class="py-3">{{ __('Lower Bound') }}</td>
                                <td class="align-middle">{{ $data['lower'] }}</td>
                            </tr>

                            <tr>
                                <td class="py-3">{{ __('Upper Bound') }}</td>
                                <td class="align-middle">{{ $data['upper'] }}</td>
                            </tr>

                            <tr>
                                <td class="py-3">{{ __('Margin of Error (E)') }}</td>
                                <td class="align-middle">{{ $data['margin'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
      </form>
</div>