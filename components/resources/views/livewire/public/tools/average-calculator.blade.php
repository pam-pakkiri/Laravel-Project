<div>

      <form wire:submit.prevent="onAverageCalculator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
  
        <div class="d-flex my-3">
            <label class="form-label">{{ __('Enter the values') }}</label>
            <div class="ps-3">
                <button class="btn btn-sm btn-icon btn-success mb-0" wire:click.prevent="onAddNumber( {{ $i }} )" title="{{ __('Add new') }}">
                    <i class="fas fa-plus fa-fw "></i>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <div class="input-group input-group-flat">
                    <input type="number" class="form-control @error('numbers.0') is-invalid @enderror" wire:model.defer="numbers.0" required>
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <div class="input-group input-group-flat">
                    <input type="number" class="form-control @error('numbers.1') is-invalid @enderror" wire:model.defer="numbers.1" required>
                </div>
            </div>

            @foreach($inputs as $key => $value)
                <div class="col-12 col-md-6 mb-3">
                    <div class="input-group">
                        <input type="number" class="form-control @error('numbers.' . $value) is-invalid @enderror" wire:model.defer="numbers.{{ $value }}" required>
                        <button class="btn btn-danger mb-0" wire:click.prevent="onDeleteNumber({{ $key }}, {{ $value }})" title="{{ __('Delete') }}">
                            <i class="fas fa-trash fa-fw "></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group">
            <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onAverageCalculator">
                        <x-loading />
                    </div>
                    <span>{{ __('Calculate') }}</span>
                </span>
            </button>
        </div>

        @if ( !empty($data) )  
            <div class="row mt-3">
                <div class="col-12 col-md-4">
                    <table class="table table-bordered table-striped text-center">
                        <tbody>
                            <tr>
                                <td class="pb-2 p-4 bg-success text-white">
                                    <h3>{{ __('Average Value') }}</h3>
                                    <h2>{{ $data['average'] }}</h2>
                                </td>
                            </tr>

                            <tr>
                                <td class="py-3">{{ __('Arithmetic:') }} {{ $data['average'] }}</td>
                            </tr>

                            <tr>
                                <td class="py-3">{{ __('Geometric:') }} {{ $data['geometric'] }}</td>
                            </tr>

                            <tr>
                                <td class="py-3">{{ __('Harmonic:') }} {{ $data['harmonic'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-12 col-md-8">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td class="fw-bold">{{ __('Sum') }}</td>
                                <td>{{ $data['sum'] }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Count') }}</td>
                                <td>{{ $data['count'] }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Median') }}</td>
                                <td>{{ $data['median'] }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Geometric Mean') }}</td>
                                <td>{{ $data['geometric'] }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Largest') }}</td>
                                <td>{{ $data['largest'] }}</td>
                            </tr>
                            
                            <tr>
                                <td class="fw-bold">{{ __('Smallest') }}</td>
                                <td>{{ $data['smallest'] }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Range') }}</td>
                                <td>{{ $data['range'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

      </form>
</div>