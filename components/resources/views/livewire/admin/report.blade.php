<div>

    <div class="card">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Link') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if ( !$reports->isEmpty() )

                        @foreach ($reports as $report)

                        <tr>
                            <td class="align-middle">
                                    <div class="form-group">
                                        <a href="{{ $report->link }}" target="_blank" class="input-group">
                                            <input type="text" value="{{ $report->link }}" class="form-control cursor-pointer" disabled>
                                            <span class="input-group-text"><i class="fas fa-external-link-alt"></i></span>
                                        </a>
                                    </div>
                            </td>
                            <td class="align-middle">
                                <p class="text-xs fw-bold mb-0">{{ $report->created_at }}</p>
                            </td>
                            <td class="align-middle">
                                <a wire:click="onDeleteConfirm( {{ $report->id }} )" class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i></a>
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
		@if( $reports->hasPages() )
			<div class="mx-auto mt-3">
				<!-- begin:pagination -->
				{{ $reports->links() }}
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
                window.livewire.emit('onDeleteReport', event.detail.id)
              }
            });

        });

    });

})( jQuery );
</script>