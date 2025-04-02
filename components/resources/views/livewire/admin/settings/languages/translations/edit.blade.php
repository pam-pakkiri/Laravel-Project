<div>    
    <div class="row">
        <div class="col-12">

            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewTranslation"><i class="fas fa-plus fa-fw me-1"></i> {{ __('Add New Translation') }}</button>

            <form wire:submit.prevent="onImportTranslations" class="d-inline-block mb-3 btn p-0">
                <div class="form-group">
                    <button class="btn btn-lime">
                        <span>
                              <i wire:loading.remove wire:target="onImportTranslations" class="fas fa-file-import me-1"></i>
                              <i wire:loading wire:target="onImportTranslations" class="spinner-border spinner-border-sm me-1"></i>
                              <span>{{ __('Import new Translations from the Default Language (:dl)', ['dl' => \App\Models\Admin\Languages::where('default', true)->first()->name ]) }}</span>
                        </span>
                    </button>
                </div>
            </form>

            <div class="card">
                <div class="card-body">

                    <div class="alert alert-important alert-info" role="alert">
                        <strong>{{ __('You are translating :langNative language.', ['langNative' => $lang_name]) }}</strong>
                    </div>

                    <!-- begin:Form Search -->
                    <form id="formSearchTranslation">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" wire:model="searchQuery" placeholder="{{ __('Search here...') }}">
                        </div>
                    </form>
                    <!-- end:Form Search -->

                    <div class="table-responsive">
                        <form wire:submit.prevent="onUpdateTranslation">
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" wire:loading.attr="disabled">
                                    <span>
                                        <i wire:loading.remove wire:target="onUpdateTranslation" class="fas fa-save me-1"></i>
                                        <div wire:loading wire:target="onUpdateTranslation">
                                            <x-loading />
                                        </div>
                                        <span>{{ __('Save Changes') }}</span>
                                    </span>
                                </button>
                            </div>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Default Text') }}</th>
                                        <th>{{ __('Translation') }}</th>
                                        <th class="text-center">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ( !empty($translations) )

                                        @foreach ($translations as $index => $translation)

                                        <tr>
                                            <td class="align-middle"><input type="text" class="form-control" wire:model.defer="translations.{{ $index }}.key" disabled></td>
                                            <td class="align-middle"><input type="text" class="form-control" wire:model.defer="translations.{{ $index }}.value" wire:ignore></td>
                                            <td class="align-middle text-center"><a title="Delete" class="btn btn-danger" wire:click="onDeleteTranslation({{ $translation['id'] }})"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                        @endforeach

                                    @else
                                        <tr><td class="align-middle">{{ __('No record found') }}</td></tr>
                                    @endif

                                </tbody>
                            </table>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Begin::Add New Translation -->
    <div class="modal fade" id="addNewTranslation" tabindex="-1" role="dialog" aria-labelledby="addNewTranslationLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="addNewTranslationModalLabel">{{ __('Add New Translation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
            @livewire('admin.settings.languages.translations.create', ['lang_id' => Route::current()->parameter('lang_id') ])
          </div>
       </div>
    </div>
    <!-- End::Add New Translation -->

</div>
