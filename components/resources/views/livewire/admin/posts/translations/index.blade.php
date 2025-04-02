<div>

        <!-- begin:Add new post translations -->
        <div class="dropdown mb-3">
          <a class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLang">
             {{ __('Add New Translations') }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" aria-labelledby="navbarDropdownMenuLang">
             @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                  <li>
                      <a class="dropdown-item" href="{{ route('admin.posts.translations.create', ["page_id" => $page_id, "locale" => $properties->key()]) }}">
                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->name() }}
                      </a>
                  </li>
              @endforeach
          </ul>
        </div>
        <!-- begin:Add new post translations -->

        <!-- begin:Form Search -->
        <form id="formSearchPost">
            <div class="input-group mb-3">
                <input type="text" class="form-control" wire:model.defer="searchQuery" placeholder="{{ __('Search with title...') }}">
            </div>
        </form>
        <!-- end:Form Search -->

        <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Language') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ( $page_translations->isNotEmpty() )

                                @foreach ($page_translations as $page_translation)

                                    <tr>
                                        <td>{{ $page_translation->title }}</td>
                                        <td>
                                            <img src="{{ asset('assets/img/flags/' . $page_translation->locale . '.svg') }}" class="lang-menu mx-auto"> 
                                        </td>
                                        <td class="w-25">
                                            <a href="{{ route('home') . '/' . $page_translation->locale . '/blog/' . $slug }}" class="btn btn-info" title="View" target="_blank"><i class="fas fa-eye icon"></i> View</a>
                                            <a href="{{ route('admin.posts.translations.edit', $page_translation->id) }}" class="btn btn-primary" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
                                            <a wire:click="onDeleteConfirmPostTranslation( {{ $page_translation->id }} )" class="btn btn-danger" title="{{ __('Delete') }}"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
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
				@if( $page_translations->hasPages() )
					<div class="mx-auto mt-3">
						<!-- begin:pagination -->
						{{ $page_translations->links() }}
						<!-- begin:pagination -->
					</div>
				@endif
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
				window.livewire.emit('onDeletePostTranslation', event.detail.id)
			  }
			});

		});
	});

})( jQuery );
</script>