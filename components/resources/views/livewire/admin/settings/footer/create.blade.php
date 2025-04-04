<div>

  <div class="alert alert-important alert-info" role="alert">
      <strong>{{ __('You are creating the :langNative version.', ['langNative' => localization()->getSupportedLocales()[$this->locale]->native()]) }}</strong>
  </div>
          
    <form wire:submit.prevent="onCreateFooterTranslation" class="row" wire:ignore>

		<div class="alert-message">
		  <!-- Session Status -->
		  <x-auth-session-status class="mb-4" :status="session('status')" />
									  
		  <!-- Validation Errors -->
		  <x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
			
        <!-- Begin:Footer Layouts -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="layout" class="form-label">{{ __('Footer Layouts') }}</label>
                        <div class="col">
                            <select id="layout" class="form-control" wire:model.defer="layout.{{ app()->getLocale() }}">
                                <option style="display:none;">{{ __('Choose a Layout...') }}</option>
                                <option value="none">{{ __('None') }}</option>
                                <option value="1">{{ __('1 Column') }}</option>
                                <option value="2">{{ __('2 Columns') }}</option>
                                <option value="3">{{ __('3 Columns') }}</option>
                                <option value="4">{{ __('4 Columns') }}</option>
                                <option value="5">{{ __('5 Columns') }}</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End:Footer Layouts -->

        @for ($i = 1; $i <= 5; $i++)    

            <div class="col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="widget{{ $i }}" class="form-label">{{ __('Widget') }} {{ $i }}</label>
                            <div class="col">
                                <textarea class="form-control" id="widget{{ $i }}" rows="15" wire:model.defer="widget{{ $i }}.{{ app()->getLocale() }}"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @endfor


        <!-- Begin:Bottom Text -->
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="bottom_text" class="form-label">{{ __('Bottom Text') }}</label>
                        <div class="col">
                            <textarea class="form-control" id="bottom_text" rows="15" wire:model.defer="bottom_text.{{ app()->getLocale() }}"></textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End:Bottom Text -->

        <div class="form-group">
            <button class="btn btn-primary float-end" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onCreateFooterTranslation">
                        <x-loading />
                    </div>
                    <span>{{ __('Create') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
    "use strict";

    document.addEventListener('livewire:load', function () {
        
        tinymce.init({
            selector: '#widget1',
            relative_urls: false,
            remove_script_host: false,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('widget1.{{ app()->getLocale() }}', editor.getContent(), true);
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

        tinymce.init({
		    selector: '#widget2',
            relative_urls: false,
            remove_script_host: false,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('widget2.{{ app()->getLocale() }}', editor.getContent(), true);
                });
            },
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | lignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
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

        tinymce.init({
            selector: '#widget3',
            relative_urls: false,
            remove_script_host: false,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('widget3.{{ app()->getLocale() }}', editor.getContent(), true);
                });
            },
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | lignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
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

        tinymce.init({
            selector: '#widget4',
            relative_urls: false,
            remove_script_host: false,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('widget4.{{ app()->getLocale() }}', editor.getContent(), true);
                });
            },
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | lignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
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

        tinymce.init({
            selector: '#widget5',
            relative_urls: false,
            remove_script_host: false,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('widget5.{{ app()->getLocale() }}', editor.getContent(), true);
                });
            },
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | lignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
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

        //Bottom Text
        tinymce.init({
            selector: '#bottom_text',
            relative_urls: false,
            remove_script_host: false,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('bottom_text.{{ app()->getLocale() }}', editor.getContent(), true);
                });
            },
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | lignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
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