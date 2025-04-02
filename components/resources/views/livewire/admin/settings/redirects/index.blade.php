<div>

  <!-- Begin:Redirects -->
    <div class="row">
        <div class="col-12">

            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewRedirect"><i class="fas fa-plus fa-fw me-1"></i> {{ __('Add New Redirect') }}</button>
            
            <div class="card">
              <div class="table-responsive">
                <table class="table table-hover settings">
                  <thead>
                        <tr>
                            <th>{{ __('Old Slug') }}</th>
                            <th>{{ __('New Slug or URL') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                  </thead>
                    <tbody>
                          @if ( !$redirects->isEmpty() )

                              @foreach ($redirects as $redirect)
                                  <tr>
                                      <td class="align-middle">{{ $redirect['old_slug'] }}</td>
                                      <td class="align-middle">{{ $redirect['new_slug'] }}</td>
                                      <td class="align-middle w-25 py-3">
                                          <a class="btn btn-info" title="{{ __('Edit') }}" wire:click="onShowEditRedirectModal( {{ $redirect['id'] }} )"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
                                          <a class="btn btn-danger" title="{{ __('Delete') }}" wire:click="onDeleteConfirmRedirect( {{ $redirect['id'] }} )"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
                                      </td>
                                  </tr>
                              @endforeach

                          @else

                            <tr>
                              <td class="align-middle">{{ __('No record found') }}</td>
                            </tr>

                          @endif

                    </tbody>
                </table>
              </div>
				@if( $redirects->hasPages() )
					<div class="mx-auto mt-3">
					  <!-- begin:pagination -->
					  {{ $redirects->links() }}
					  <!-- begin:pagination -->
					</div>
				@endif
            </div>

        </div>
    </div>
    <!-- End:Redirects -->

    <!-- Begin::Add New Redirect -->
    <div class="modal fade" id="addNewRedirect" tabindex="-1" role="dialog" aria-labelledby="addNewRedirectLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewRedirectModalLabel">{{ __('Add New Redirect') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
            @livewire('admin.settings.redirects.create')

        </div>
      </div>
    </div>
    <!-- End::Add New Redirect -->

    <!-- Begin::Edit Redirect -->
    <div class="modal fade" id="editRedirect" tabindex="-1" role="dialog" aria-labelledby="editRedirectLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editRedirectModalLabel">{{ __('Edit Redirect') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
            @livewire('admin.settings.redirects.edit')

        </div>
      </div>
    </div>
    <!-- End::Edit Redirect -->

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
                window.livewire.emit('onDeleteRedirect', event.detail.id)
              }
            });
    
        });

    });

})( jQuery );
</script>