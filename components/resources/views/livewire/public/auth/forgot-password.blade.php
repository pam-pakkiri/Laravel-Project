<div>
    <section id="reset-password-page">
        <div class="page page-center">
            <div class="container-tight">
                <form class="card card-md" wire:submit.prevent="onForgotPassword">

                    <div class="card-body">
                        <h2 class="text-center d-block pb-2">{{ __('Forgot Password!') }}</h2>
                        <p class="text-muted mb-4">{{ __('Please enter your email address. You will receive a link to create a new password via email.') }}</p>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('Email') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}" type="email" wire:model.defer="email" required autofocus />
                        </div>

                        @if ( \App\Models\Admin\General::first()->captcha_status )
                          <x-public.recaptcha />
                        @endif
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled">
                                <span>
                                  <div wire:loading wire:target="onForgotPassword">
                                    <x-loading />
                                  </div>
                                  <span>{{ __('Send') }}</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted mt-3">
                    {{ __('Back to') }} 
                    <a href="{{ route('login') }}" tabindex="-1"> {{ __('Sign in') }}</a>
                </div>
            </div>
        </div>
    </section>
</div>
