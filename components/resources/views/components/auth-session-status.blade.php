@props(['status'])

@switch( $status )

    @case( 'success' )

		  <div class="alert alert-important alert-success" role="alert">
		    {{ session('message') }}
		  </div>

        @break

    @case( 'error' )
    
		  <div class="alert alert-important alert-danger" role="alert">
		    {{ session('message') }}
		  </div>

        @break

    @default

@endswitch