<div>
    <section id="login-page">
        <div class="page page-center">
            <div class="container-tight">
                <form class="card card-md" wire:submit.prevent="onLogin">

                    <div class="card-header text-center d-block pb-2 pt-4 border-0">
                        <h2>{{ __('Welcome back!') }}</h2>
                        <p class="mb-0">{{ __('Login with your email address and password to keep connected with us.') }}</p>
                    </div>

                    <div class="card-body">

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('Email') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}" type="email" wire:model.defer="email" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('Password') }}</label>
                            <div class="input-group input-group-flat">
                                <input class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" type="password" wire:model.defer="password" required />
                            </div>
                        </div>

                        <!-- Remember me -->
                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" type="checkbox" wire:model.defer="remember_me" id="remember_me" />
                                <span class="form-check-label">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        @if ( \App\Models\Admin\General::first()->captcha_status )
                          <x-public.recaptcha />
                        @endif
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled">
                                <span>
                                  <div wire:loading wire:target="onLogin">
                                    <x-loading />
                                  </div>
                                  <span>{{ __('Sign in') }}</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
