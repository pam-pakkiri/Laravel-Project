<div>
    <section id="verify.email-page">
        <div class="page page-center">
            <div class="container-tight">
                <form class="card card-md" wire:submit.prevent="onResendEmail">

                    <div class="card-body">
                        <h2 class="text-center d-block pb-2">{{ __('Verify it\'s you') }}</h2>
                        <p class="text-muted mb-4">{{ __('Could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        @if ( \App\Models\Admin\General::first()->captcha_status )
                          <x-public.recaptcha />
                        @endif

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled">
                                <span>
                                  <div wire:loading wire:target="onResendEmail">
                                    <x-loading />
                                  </div>
                                  <span>{{ __('Resend Verification Email') }}</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
