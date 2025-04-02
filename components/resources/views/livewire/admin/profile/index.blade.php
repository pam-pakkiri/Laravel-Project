<div>

	<div class="card card-body blur shadow-blur">
		<div class="row gx-4">
			@livewire('admin.profile.avatar')
		</div>
	</div>

	<div class="row py-4">
		<div class="col-12">
			<div class="tab-content">
				@livewire('admin.profile.overview')

				@livewire('admin.profile.update-profile')

				@livewire('admin.profile.change-password')
			</div>
		</div>
	</div>

</div>

<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
	"use strict";
	
    document.addEventListener('livewire:load', function () {

		jQuery('.edit-avatar').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

		jQuery('input#avatar').change(function() { 
			window.livewire.emit('onSetAvatar', this.value)
		});
	
    });

})( jQuery );
</script>