@switch( $advertisement->area1_align )
    @case('left')
		<div class="ad-banner area1 d-flex justify-content-start" style="margin:{{ $advertisement->area1_margin }}px;">
			{!! $advertisement->area1 !!}
		</div>

    @break

    @case('right')
		<div class="ad-banner area1 d-flex justify-content-end" style="margin:{{ $advertisement->area1_margin }}px;">
			{!! $advertisement->area1 !!}
		</div>
    @break

    @default
		<div class="ad-banner area1 d-flex justify-content-center" style="margin:{{ $advertisement->area1_margin }}px;">
			{!! $advertisement->area1 !!}
		</div>
@endswitch