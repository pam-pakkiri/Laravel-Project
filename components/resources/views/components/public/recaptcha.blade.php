<div class="form-group mb-3">
  <div data-callback="onReCaptchaCallback" class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}" wire:ignore></div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        var onReCaptchaCallback = function() {
            @this.set('recaptcha', grecaptcha.getResponse());
        }

        window.addEventListener('resetReCaptcha', event => {
            grecaptcha.reset();
        });
    </script>
</div>