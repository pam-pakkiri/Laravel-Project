@switch( $advertisement->area3_align )
    @case('left')
		<div class="ad-banner area3 d-flex justify-content-start" style="margin:{{ $advertisement->area3_margin }}px;">
			{!! $advertisement->area3 !!}
		</div>

    @break

    @case('right')
		<div class="ad-banner area3 d-flex justify-content-end" style="margin:{{ $advertisement->area3_margin }}px;">
			{!! $advertisement->area3 !!}
		</div>
    @break

    @default
		<div class="ad-banner area3 d-flex justify-content-center" style="margin:{{ $advertisement->area3_margin }}px;">
			{!! $advertisement->area3 !!}
		</div>
@endswitch