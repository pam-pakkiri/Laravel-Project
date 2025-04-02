<div>

    @php

        $fontawesome = json_decode($fontawesome);

    @endphp
    
    <div class="row">

        <div class="col-12 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">

                    <form wire:submit.prevent="addToMenu">

						<div class="alert-message">
						  <!-- Session Status -->
						  <x-auth-session-status class="mb-4" :status="session('status')" />
													  
						  <!-- Validation Errors -->
						  <x-auth-validation-errors class="mb-4" :errors="$errors" />
						</div>
			
                        <div class="form-group mb-3">
                            <label for="url" class="form-label">{{ __('Menu items') }}</label>
                            <select class="form-control" wire:model.defer="menu_items">
                                <option value selected style="display:none;">{{ __('Choose an item...') }}</option>
                                <option value="custom">{{ __('Custom') }}</option>
                                @if ( !empty($pages) )
                                    <optgroup label="{{ __('Pages') }}">
                                        @foreach ($pages as $page)
                                            <option value="{{ $page['slug'] }}">{{ __( $page['title'] ) }}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                                
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="text" class="form-label">{{ __('Link Text') }}</label>
                            <input class="form-control" type="text" id="text" wire:model.defer="text">
                        </div>

                        @if ( $menu_items == 'custom' )
                            <div class="form-group mb-3">
                                <label for="url" class="form-label">{{ __('URL') }}</label>
                                <input class="form-control" type="text" id="url" wire:model.defer="url">
                            </div>
                        @endif

                        <div class="form-group mb-3" wire:ignore.self>
                            <label for="fa-select" class="form-label">{{ __('Add icons?') }} (<a href="https://fontawesome.com/v5.15/icons" class="text-primary" target="_blank">{{ __('Browse Font Awesome') }}</a>)</label>
                            <select id="fa-select" class="form-control fa-select" wire:model.defer="icon">
                                <option value>{{ __('None') }}</option>
                                <optgroup label="{{ __('Font Awesome') }}">
                                    @foreach ($fontawesome->icons as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="type" class="form-label">{{ __('Type') }}</label>
                            <select class="form-control" wire:model="type">
                                <option value="link">{{ __('Link') }}</option>
                                <option value="button">{{ __('Button') }}</option>
                            </select>
                        </div>

                        @if ( $type == 'link' )

                            <div class="form-group mb-3">
                                <label for="type" class="form-label">{{ __('Target') }}</label>
                                <select class="form-control" wire:model.defer="target">
                                    <option value="_self">{{ __('_self') }}</option>
                                    <option value="_blank">{{ __('_blank') }}</option>
                                </select>
                            </div>

                        @endif

                        @if ( $type == 'button' )

                            <div class="form-group mb-3">
                                <label for="type" class="form-label">{{ __('Class') }}</label>
                                <select class="form-control" wire:model.defer="class">
                                    <optgroup label="{{ __('Default Buttons') }}">
                                        <option value="btn-default">{{ __('Default') }}</option>
                                        <option value="btn-primary">{{ __('Primary') }}</option>
                                        <option value="btn-secondary">{{ __('Secondary') }}</option>
                                        <option value="btn-info">{{ __('Info') }}</option>
                                        <option value="btn-success">{{ __('Success') }}</option>
                                        <option value="btn-danger">{{ __('Danger') }}</option>
                                        <option value="btn-warning">{{ __('Warning') }}</option>
                                    </optgroup>
                                    <optgroup label="{{ __('Outline Buttons') }}">
                                        <option value="btn-outline-default">{{ __('Default') }}</option>
                                        <option value="btn-outline-primary">{{ __('Primary') }}</option>
                                        <option value="btn-outline-secondary">{{ __('Secondary') }}</option>
                                        <option value="btn-outline-info">{{ __('Info') }}</option>
                                        <option value="btn-outline-success">{{ __('Success') }}</option>
                                        <option value="btn-outline-danger">{{ __('Danger') }}</option>
                                        <option value="btn-outline-warning">{{ __('Warning') }}</option>
                                        </optgroup>
                                </select>
                            </div>

                        @endif

                        <div class="form-group">
                            <button class="btn btn-info float-end" wire:loading.attr="disabled">
                                <span>
                                    <div wire:loading.inline wire:target="addToMenu">
                                        <x-loading />
                                    </div>
                                    <span>{{ __('Add to Menu') }}</span>
                                </span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="nestable" class="dd mw-100">

                        @php
                            function get_menu($menus, $class = 'dd-list') {

                                $html = '<ol class="'.$class.'">';

                                foreach($menus as $key => $value) {
                                    $html .= '<li class="dd-item" data-id="'.$value['id'].'">
                                                    <div class="float-end btn-handle">
                                                        <button class="badge bg-primary border-0" wire:click.prevent="editMenu('.$value['id'].')">'.__('Edit').'</button>
                                                        <button class="badge bg-danger border-0" wire:click.prevent="removeMenu('.$value['id'].')">'.__('Delete').'</button>
                                                    </div>

                                                    <div class="dd-handle">
                                                        <span><i class="'.$value['icon'].' pe-1"></i>'.$value['text'].'</span>
                                                        <small class="url">'.$value['url'].'</small>
                                                    </div>';

                                                    if( !empty($value['children']) ) {
                                                        $html .= get_menu($value['children'],'children');
                                                    }

                                    $html .'</li>';
                                }

                                $html .= '</ol>';

                                return $html;
                            }

                            echo get_menu($menus);

                        @endphp

                    </div>

                    <div class="col-auto">
                        <button class="btn btn-primary float-end mt-3" id="onUpdateMenus" wire:loading.attr="disabled">
                          <span>
                            <div wire:loading.inline wire:target="onUpdateMenus">
                              <x-loading />
                            </div>
                            <span>{{ __('Save Changes') }}</span>
                          </span>
                        </button>
                    </div>
                        
                </div>
            </div>
        </div>

    </div>

</div>

<style>

.dd .btn-handle {
    transform: translate(-10%, 50%);
}

.btn-handle button{
    cursor: pointer;
}

.dd .dd-handle .url {
    font-weight: 400;
    margin-left: 10px;
}

.dd-handle{
    background-color: transparent;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    height: 50px;
    padding: 14px 25px;
    cursor: move;
    color: var(--tblr-card-title-color);
}

.dd-empty,.dd-placeholder,
.dd-empty {
    background-color: transparent;
}

.dd-handle:hover {
    background: transparent;
}

.dd-item>button.dd-collapse:before {
    content: '';
}
</style>
<script>
(function( $ ) {
    "use strict";

    jQuery(document).ready(function(){

        jQuery('#fa-select').on('change', function (e) {
            var data = jQuery(this).find(":selected").val();
            @this.set('icon', data);
        });

        jQuery('#nestable').nestable({ serialize: true, maxDepth: 3 });

        jQuery('#onUpdateMenus').click(function(e){
            e.preventDefault();
            var data = jQuery('#nestable').nestable('serialize');
            window.livewire.emit('onUpdateMenus', data)

        });

    });

})( jQuery );
</script>