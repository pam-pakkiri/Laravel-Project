@switch( $advertisement->sidebar_bottom_align )
    @case('left')
		<div class="ad-banner sidebar-bottom d-flex justify-content-start" style="margin:{{ $advertisement->sidebar_bottom_margin }}px;">
			{!! $advertisement->sidebar_bottom !!}
		</div>

    @break

    @case('right')
		<div class="ad-banner sidebar-bottom d-flex justify-content-end" style="margin:{{ $advertisement->sidebar_bottom_margin }}px;">
			{!! $advertisement->sidebar_bottom !!}
		</div>
    @break

    @default
		<div class="ad-banner sidebar-bottom d-flex justify-content-center" style="margin:{{ $advertisement->sidebar_bottom_margin }}px;">
			{!! $advertisement->sidebar_bottom !!}
		</div>
@endswitch