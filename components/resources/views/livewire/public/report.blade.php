<div id="page-content" class="py-3">
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Validation Errors -->
  <x-auth-validation-errors class="mb-4" :errors="$errors" />

  <!-- Report Form -->
  <form id="formReportLinks" wire:submit.prevent="sendReport">
     
    <div class="form-group mb-3">
      <label for="report-links" class="col-form-label d-flex">{{ __('Enter URL to report') }}</label>
      <textarea id="report-links" wire:model.defer="links" class="form-control @error('links') is-invalid @enderror" rows="10" placeholder="Enter one URL per line then Submit" required></textarea>
    </div>

    @if ( \App\Models\Admin\General::first()->captcha_status )
      <x-public.recaptcha />
    @endif

    <button class="btn btn-primary mx-auto d-block">
        <span>
            <div wire:loading wire:target="sendReport">
                <x-loading />
            </div>
            <span>{{ __('Submit') }}</span>
        </span>
    </button>

  </form>
</div>
