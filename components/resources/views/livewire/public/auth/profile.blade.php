<div>
    <section id="reset-password-page">
        <div class="page-wrapper page-center">
            <div class="container-xl">

                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col"> 
                            <h1 class="page-title text-center d-block"> {{ __('User Profile') }} </h1> 
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <div class="avatar avatar-xl position-relative">
                                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=150&d=mm&r=g" class="w-100 shadow-sm rounded">
                                            <a href="https://gravatar.com" class="btn btn-sm btn-icon-only btn-light position-absolute bottom-0 end-0 mb-n2 me-n2 shadow-none edit-avatar" target="_blank">
                                                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Edit Image') }}"></i>
                                            </a>
                                        </div>
                                        <div class="mt-3">
                                            <h4 class="fw-bold">{{ Auth::user()->fullname }}</h4>
                                        </div>
                                    </div>

                                    <div class="list-group list-group-flush border">
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col fw-bold text-secondary">{{ __('Join Date') }}: <span class="float-end text-secondary">{{ \Carbon\Carbon::parse( Auth::user()->created_at )->format('F j, Y') }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
                                    <form role="form" wire:submit.prevent="onUpdateProfile">

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">{{ __('Full name') }}:</label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="fullname" wire:model.defer.lazy="fullname" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">{{ __('Email') }} (*):</label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="email" name="user_email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">{{ __('New Password') }} (*):</label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter password') }}" type="password" wire:model.defer="password" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">{{ __('Confirm New Password') }} (*):</label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Enter confirm password') }}" type="password" wire:model.defer="password_confirmation" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button type="submit" class="btn btn-primary btn-submit" wire:loading.attr="disabled">
                                                    <span>
                                                      <div wire:loading wire:target="onUpdateProfile">
                                                        <x-loading />
                                                      </div>
                                                      <span>{{ __('Save Changes') }}</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
