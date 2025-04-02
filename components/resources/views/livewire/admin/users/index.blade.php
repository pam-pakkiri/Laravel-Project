<div>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewUser"><i class="fas fa-plus fa-fw me-1"></i> {{ __('Add New User') }}</button>

        <!-- begin:Form Search -->
        <form id="formSearchPage">
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
                            <th>Full name</th>
                            <th>Email</th>
                            <th>Join Date</th>
                            <th>{{ __('Latest updates') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ( $users->isNotEmpty() )

                            @foreach ($users as $user)

                                <tr>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td class="w-25">
                                        <a wire:click="onShowEditUserModal( {{ $user->id }} )" class="btn btn-info" title="{{ __('Edit') }}"><i class="fas fa-edit icon"></i> {{ __('Edit') }}</a>
                                        <a wire:click="onDeleteConfirmUser( {{ $user->id }} )" class="btn btn-danger" title="{{ __('Delete') }}"><i class="fas fa-trash icon"></i> {{ __('Delete') }}</a>
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
			
			@if( $users->hasPages() )
				<div class="mx-auto mt-3">
					{{ $users->links() }}
				</div>
			@endif
        </div>

        <!-- Begin::Add New User -->
        <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="addNewUserLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewUserModalLabel">{{ __('Add New User') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              @livewire('admin.users.create')

            </div>
          </div>
        </div>
        <!-- End::Add New User -->

        <!-- Begin::Edit User -->
        <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUsersLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editUsersModalLabel">{{ __('Edit User') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              @livewire('admin.users.edit')
              
            </div>
          </div>
        </div>
        <!-- End::Edit User -->

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
                window.livewire.emit('onDeleteUser', event.detail.id)
              }
            });
    
        });

    });

})( jQuery );
</script>