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
                            <label class="form-label">
                                {{ __('Password') }}
                                @if ( $this->forgot_password_status )
                                    <span class="form-label-description">
                                      <a href="{{ route('password.forgot') }}">{{ __('I forgot password') }}</a>
                                    </span>
                                @endif
                            </label>
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

                    @if ( \App\Models\Admin\General::first()->google_login_status || \App\Models\Admin\General::first()->facebook_login_status )
                        <div class="hr-text">{{ __('or') }}</div>

                        <div class="card-body">
                            <div class="row">
                                @if ( \App\Models\Admin\General::first()->google_login_status )
                                    <div class="col-12">
                                        <a class="btn btn-google w-100 mb-2" href="{{ url('auth/google') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M17.788 5.108a9 9 0 1 0 3.212 6.892h-8"></path> </svg>
                                            {{ __('Login with Google') }}
                                        </a>
                                    </div>
                                @endif

                                @if ( \App\Models\Admin\General::first()->facebook_login_status )
                                    <div class="col-12">
                                        <a class="btn btn-facebook w-100 mb-2" href="{{ url('auth/facebook') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path> </svg>
                                            {{ __('Login with Facebook') }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </form>
                
                @if ( $this->forgot_password_status == true)
                    <div class="text-center text-muted mt-3">
                        {{ __('Don\'t have account yet?') }} 
                        <a href="{{ route('register') }}" tabindex="-1">{{ __('Sign up') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
