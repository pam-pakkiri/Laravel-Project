<div>               
    <div class="row">
        <div class="col-12">

	        <!-- begin:Add new footer translations -->
	        <div class="dropdown mb-3">
	          <a class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLang">
	             {{ __('Add New Translations') }}
	          </a>
	          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" aria-labelledby="navbarDropdownMenuLang">
	             @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
	                  <li>
	                      <a class="dropdown-item" href="{{ route('admin.footer.translations.create', $properties->key()) }}">
	                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
	                      </a>
	                  </li>
	              @endforeach
	          </ul>
	        </div>
	        <!-- begin:Add new footer translations -->

            <div class="card">
	            	<div class="table-responsive">
	            		<table class="table table table-hover settings">
	            			<thead>
	            				<tr>
	            					<th>{{ __('Language') }}</th>
	            					<th>{{ __('Action') }}</th>
	            				</tr>
	            			</thead>
	                        <tbody>
	                            @if ( $footer_translations->isNotEmpty() )

	                                @foreach ($footer_translations as $footer_translation)

	                                    <tr>
	                                        <td class="align-middle py-3">
	                                        	<img src="{{ asset('assets/img/flags/' . $footer_translation->locale . '.svg') }}" class="lang-menu mx-auto"> 
	                                        	<span>{{ localization()->getSupportedLocales()[$footer_translation->locale]->native() }}</span>
	                                        </td>
	                                        <td class="align-middle w-25">
	                                            <a href="{{ route('admin.footer.translations.edit', $footer_translation->id) }}" class="btn btn-info" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
	                                            <a wire:click="onDeleteConfirmFooterTranslation( {{ $footer_translation->id }} )" class="btn btn-danger" title="{{ __('Delete') }}"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
	                                        </td>
	                                    </tr>

	                                @endforeach

	                            @else

	                                <tr>
	                                    <td>{{ __('No record found') }}</td>
	                                </tr>
									
	                            @endif

	                        </tbody>

	            		</table>
	            	</div>
					
					@if( $footer_translations->hasPages() )
						<div class="mx-auto mt-3">
							<!-- begin:pagination -->
							{{ $footer_translations->links() }}
							<!-- begin:pagination -->
						</div>
					@endif
            </div>
        </div>

    </div>

</div>
<script>
(function( $ ) {
    "use strict";
	
	document.addEventListener('livewire:load', function () {
		
		window.addEventListener('swal:modal', event => {

			const swalWithBootstrapButtons = Swal.mixin({
			  customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			  },
			  buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			  title: event.detail.title,
			  text: event.detail.text,
			  icon: event.detail.type,
			  showCancelButton: true,
			  confirmButtonText: "{{ __('Yes, delete it!') }}",
			  cancelButtonText: "{{ __('Cancel') }}"
			}).then((result) => {
			  if (result.isConfirmed) {
				window.livewire.emit('onDeleteFooterTranslation', event.detail.id)
			  }
			});

		});

	});

})( jQuery );
</script>