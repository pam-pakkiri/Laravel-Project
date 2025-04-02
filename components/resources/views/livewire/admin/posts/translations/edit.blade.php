<div>

    <div class="card">
        <div class="card-body">

          <div class="alert alert-important alert-info" role="alert">
              <strong>{{ __('You are editing the :langNative version', ['langNative' => $lang_name]) }} (<a target="_blank" href="{{ localization()->getLocalizedURL($locale, route('home') . '/blog/' . $slug, [], true) }}" class="text-light">{{ __('View post') }}</a>).</strong>
          </div>

            <form wire:submit.prevent="onEditPostTranslation">

				<div class="alert-message">
				  <!-- Session Status -->
				  <x-auth-session-status class="mb-4" :status="session('status')" />
											  
				  <!-- Validation Errors -->
				  <x-auth-validation-errors class="mb-4" :errors="$errors" />
				</div>
			
                <div class="card mb-3 cursor-pointer">
                    <div class="card-header card-header-light fw-bold">{{ __('SERP Preview') }}</div>
                    <div class="card-body">
                        <h5 class="text-primary h3 mb-0">{{ $page_title . ($sitename_status ? ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME') : '') }}</h5>
                        <span class="text-green">{{ ( $page_type == 'home' ) ? localization()->getLocalizedURL($locale, route('home') . '/', [], true) : localization()->getLocalizedURL($locale, route('home') . '/blog/' . $slug, [], true) }}</span>
                        <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($short_description, 160, $end = '...') }}</p>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="page-title" class="form-label">{{ __('Site Name') }}</label>
                    <select class="form-control" wire:model="sitename_status">
                        <option value="1">{{ __('Show') }}</option>
                        <option value="0">{{ __('Hide') }}</option>
                    </select>
                </div>
                
                <div class="form-group mb-3">
                    <label for="page-title" class="form-label">{{ __('Page Title') }}</label>
                    <input class="form-control @error('page_title') is-invalid @enderror" type="text" wire:model="page_title" required>
                    <small class="form-hint">{{ __('This is what will appear in the first line when this post shows up in the search results. It should be less than or equal to') }} <code>{{ __('60 characters') }}</code>.</small>
                </div>

                <div class="form-group mb-3">
                    <label for="short-description" class="form-label">{{ __('Short description') }}</label>
                    <input class="form-control" type="text" wire:model="short_description">
                    <small class="form-hint">{{ __('This is what will appear as the description when this post shows up in the search results. It should be less than or equal to') }}  <code>{{ __('160 characters') }}</code>.</small>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Heading') }}</label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" wire:model.defer="title" required>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Subheading') }}</label>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" wire:model.defer="subtitle">
                    </div>
                </div>

                <div class="form-group mb-3" wire:ignore>
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea class="description" rows="15" wire:model.defer="description"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Robots Meta') }}</label>
                    <select class="form-control" wire:model.defer="robots_meta">
                        <option value="1">{{ __('Index') }}</option>
                        <option value="0">{{ __('Noindex') }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary float-end" wire:loading.attr="disabled">
                        <span>
                            <div wire:loading.inline wire:target="onEditPostTranslation">
                                <x-loading />
                            </div>
                            <span>{{ __('Save Changes') }}</span>
                        </span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
    "use strict";

    document.addEventListener('livewire:load', function () {

        tinymce.init({
            selector: '.description',
            relative_urls: false,
            remove_script_host: false,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('description', editor.getContent(), true);
                });
            },
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker toc',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: "toc | insertfile undo redo | styleselect | bold italic | lignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
            file_picker_callback: function (callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                let type = 'image' === meta.filetype ? 'Images' : 'Files',
                    url  = '{{ url('/') }}/filemanager?editor=tinymce5&type=' + type;

                tinymce.activeEditor.windowManager.openUrl({
                    url : url,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
                //
            }
        });
	
    });

})( jQuery );
</script>