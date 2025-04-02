@switch( $advertisement->sidebar_top_align )
    @case('left')
		<div class="ad-banner sidebar-top d-flex justify-content-start" style="margin:{{ $advertisement->sidebar_top_margin }}px;">
			{!! $advertisement->sidebar_top !!}
		</div>

    @break

    @case('right')
		<div class="ad-banner sidebar-top d-flex justify-content-end" style="margin:{{ $advertisement->sidebar_top_margin }}px;">
			{!! $advertisement->sidebar_top !!}
		</div>
    @break

    @default
		<div class="ad-banner sidebar-top d-flex justify-content-center" style="margin:{{ $advertisement->sidebar_top_margin }}px;">
			{!! $advertisement->sidebar_top !!}
		</div>
@endswitch