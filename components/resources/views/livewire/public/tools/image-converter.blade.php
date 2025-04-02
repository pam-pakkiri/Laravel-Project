<div>

        <div class="image-container mb-3">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            
            <div class="image-wrapper {{ ($convertType == 'remoteURL') ? 'show-remote-box' : '' }}">

                <div action="/" class="local-image-box dropzone cursor-pointer">
                    <div class="dropzone-box">
                        <div class="dz-message">
                            <div class="m-4 text-center">
                                <h3 class="text-muted">{{ __('Drag and drop an image here') }}</h3>
                                <p>- {{ __('or') }} - </p>
                                <a class="btn btn-success cursor-pointer">{{ __('Choose an image') }}</a>
                                <p class="mt-3">{{ __('Maximum upload file size') }}: {{ \App\Models\Admin\General::first()->file_size }} {{ __(' MB') }}</p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <small class="ms-auto badge bg-cyan-lt cursor-pointer" wire:click="onConvertType('remoteURL')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /></svg>
                                {{ __('Use Remote URL') }}
                            </small>
                        </div>
                    </div>
                </div>

                <form class="remote-box d-flex flex-column" wire:submit.prevent="onAddRemoteURL">
                    <div class="d-flex mt-auto mx-auto w-75">
                        <div class="row w-100">
                            <div class="col">
                                <div class="input-group input-group-flat">
                                    <input type="text" class="form-control" wire:model.defer="remote_url" placeholder="https://..." required />
                                    <span class="input-group-text {{ ( Cookie::get('theme_mode') == 'theme-light' ) ? 'bg-white' : '' }}">
                                        <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /></svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success" type="submit" wire:loading.attr="disabled">
                                  <span>
                                    <div wire:loading.inline wire:target="onAddRemoteURL">
										<x-loading />
                                    </div>
                                    <span>{{ __('Add') }}</span>
                                  </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mt-auto flex-end">
                        <small class="ms-auto badge bg-cyan-lt cursor-pointer" wire:click="onConvertType('localImage')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="19" x2="21" y2="19" /><rect x="5" y="6" width="14" height="10" rx="1" /></svg>
                            {{ __('Upload from device') }}
                        </small>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-6" wire:ignore>
                <div id="preview-image">
                    <img id="image" class="img-fluid" src="{{ asset('assets/img/preview-image.jpg') }}">
                </div>
            </div>

            <div class="col-lg-6">
                <form wire:submit.prevent="onImageConverter">
                    <fieldset class="form-fieldset d-flex flex-column bd-highlight shadow-sm">
                        <strong>{{ __('Select new format') }}</strong>

                        <div class="d-inline-flex my-3">
                            <select class="form-control form-select" wire:model.defer="image_format">
                                <option value="jpg">JPG</option>
                                <option value="png">PNG</option>
                                <option value="gif">GIF</option>
                                <option value="bmp">BMP</option>
                                <option value="webp">WEBP</option>
                            </select>
                        </div>
                    </fieldset>

                    @if ( \App\Models\Admin\General::first()->captcha_status )
                      <x-public.recaptcha />
                    @endif

                    <div class="text-center">
                        <button class="btn btn-azure" wire:loading.attr="disabled">
                          <span>
                            <div wire:loading.inline wire:target="onImageConverter">
                              <x-loading />
                            </div>
                            <span>{{ __('Convert Image') }}</span>
                          </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modalPreviewDownloadImage" tabindex="-1" role="dialog" aria-labelledby="modalPreviewDownloadImage" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">
                    <svg baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 36 36" class="icon me-1 my-auto"><path fill="#A4D06D" d="M16.688 25.728l-6.61-6.61 2.152-2.152 3.902 3.902 6.08-9.758 2.583 1.61"></path><path fill="#A4D06D" d="M18 35.875C8.144 35.875.125 27.855.125 18S8.145.125 18 .125 35.875 8.145 35.875 18 27.855 35.875 18 35.875zm0-33.468C9.402 2.407 2.407 9.402 2.407 18c0 8.598 6.995 15.593 15.593 15.593 8.598 0 15.593-6.995 15.593-15.593 0-8.598-6.995-15.593-15.593-15.593z"></path></svg>
                    <span>{{ __('Save your image') }}</span>
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group text-center mx-auto mb-3">
                        <a class="btn btn-success download-image">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg>
                            {{ __('Download Image') }}
                        </a>
                    </div>

                    <p><img class="preview-download-image img-fluid d-block m-auto"></p>
                    <p>{{ __('Note: This is a preview only. Click the "Download Image" button for the final image.') }}</p>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>

              </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/dropzone.min.js') }}"></script>
        <link href="{{ asset('assets/css/dropzone.min.css') }}" rel="stylesheet">

        <script>
        (function( $ ) {
          "use strict";

            Dropzone.autoDiscover = false;

            document.addEventListener('livewire:load', function () {

                var el = document.getElementById('paste');

                if(el){

                    el.addEventListener('click', function(paste) {

                        paste = document.getElementById('paste');

                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>' === paste.innerHTML ? (remote_url.value = "", paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect></svg>') : navigator.clipboard.readText().then(function(clipText) {

                            @this.set('remote_url', clipText);

                        }, paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>');

                    });
                }
                
                var errors = false;
                
                var myDropzone = new Dropzone(".dropzone", { 
                   maxFilesize: {{ \App\Models\Admin\General::first()->file_size }},
                   autoProcessQueue: false,
                   maxFiles:1,
                   acceptedFiles: "image/*",
                   previewsContainer: false,
                   thumbnailWidth: null,
                   thumbnailHeight: null,
                   addedfile: function (file) {
                        errors = false;
                        if (this.files.length > 1) {
                          this.removeFile(this.files[0]);
                        }
                   },
                   error: function (file, message) {
                        this.removeFile(file);
                        alert(message);
                        errors = true;
                   },
                   thumbnail: function(file, dataUrl) {

                        if(errors) return;

                        // start file reader
                        let result = document.querySelector('#preview-image'), cropper = '';
                        const reader = new FileReader();
                        reader.onload = (e)=> {
                            // create new image
                            let img          = document.createElement('img');
                            img.id           = 'image';
                            img.className    = 'img-fluid';
                            img.src          = dataUrl;
                            result.innerHTML = '';
                            result.appendChild(img);
                            window.livewire.emit('onSetImageData', dataUrl);

                        };
                        reader.readAsDataURL(file);
                   }
                });

                window.addEventListener('onSetRemoteURL', event => {
                    let result       = document.querySelector('#preview-image');
                    let img          = document.createElement('img');
                    img.id           = 'image';
                    img.className    = 'img-fluid w-100';
                    img.src          = event.detail.url;
                    result.innerHTML = '';
                    result.appendChild(img);
                });

                window.addEventListener('showModal', event => {
                    jQuery('.download-image').attr( 'href', event.detail.download );
                    jQuery('.preview-download-image').attr('src', event.detail.preview);
                    jQuery('#' + event.detail.id).modal('show');
                });

            });

        })( jQuery );
        </script>
</div>