@switch( $advertisement->area5_align )
    @case('left')
		<div class="ad-banner area5 d-flex justify-content-start" style="margin:{{ $advertisement->area5_margin }}px;">
			{!! $advertisement->area5 !!}
		</div>

    @break

    @case('right')
		<div class="ad-banner area5 d-flex justify-content-end" style="margin:{{ $advertisement->area5_margin }}px;">
			{!! $advertisement->area5 !!}
		</div>
    @break

    @default
		<div class="ad-banner area5 d-flex justify-content-center" style="margin:{{ $advertisement->area5_margin }}px;">
			{!! $advertisement->area4 !!}
		</div>
@endswitch