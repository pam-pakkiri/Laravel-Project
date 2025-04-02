<div>

		<div class="row row-cols-1 row-cols-md-4 mb-3">
		 <div class="col">
		    <div class="card card-sm">
		       <div class="card-body">
		           <div class="row align-items-center">
		               <div class="col">
		                   <div class="fw-bold">{{ __('Today') }}</div>
		                   <div class="text-muted">
		                       {{ $today }}
		                   </div>
		               </div>

		               <div class="col-auto">
		                   <span class="bg-blue text-white avatar">
		                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><ellipse cx="12" cy="12" rx="4" ry="9" /><ellipse cx="12" cy="12" rx="4" ry="9" transform="rotate(90 12 12)" /></svg>
		                   </span>
		               </div>
		           </div>
		       </div>
		    </div>
		 </div>
		 <div class="col">
		    <div class="card card-sm">
		       <div class="card-body">
		           <div class="row align-items-center">
		               <div class="col">
		                   <div class="fw-bold">{{ __('This Week') }}</div>
		                   <div class="text-muted">
		                      {{ $thisWeek }}
		                   </div>
		               </div>

		               <div class="col-auto">
		                   <span class="bg-blue text-white avatar">
		                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><ellipse cx="12" cy="12" rx="4" ry="9" /><ellipse cx="12" cy="12" rx="4" ry="9" transform="rotate(90 12 12)" /></svg>
		                   </span>
		               </div>
		           </div>
		       </div>
		    </div>
		 </div>
		 <div class="col">
		    <div class="card card-sm">
		       <div class="card-body">
		           <div class="row align-items-center">
		               <div class="col">
		                   <div class="fw-bold">{{ __('Last 30 Days') }}</div>
		                   <div class="text-muted">
		                       {{ $last30Days }}
		                   </div>
		               </div>

		               <div class="col-auto">
		                   <span class="bg-blue text-white avatar">
		                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><ellipse cx="12" cy="12" rx="4" ry="9" /><ellipse cx="12" cy="12" rx="4" ry="9" transform="rotate(90 12 12)" /></svg>
		                   </span>
		               </div>
		           </div>
		       </div>
		    </div>
		 </div>
		 <div class="col">
		    <div class="card card-sm">
		       <div class="card-body">

		           <div class="row align-items-center">
		               <div class="col">
		                   <div class="fw-bold">{{ __('All Time') }}</div>
		                   <div class="text-muted">
		                       {{ $allTime }}
		                   </div>
		               </div>

		               <div class="col-auto">
		                   <span class="bg-blue text-white avatar">
		                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><ellipse cx="12" cy="12" rx="4" ry="9" /><ellipse cx="12" cy="12" rx="4" ry="9" transform="rotate(90 12 12)" /></svg>
		                   </span>
		               </div>
		           </div>
		       </div>
		    </div>
		 </div>
		</div>

		<div class="row mb-3">
		  <div class="col">
		      <div class="card">
		          <div class="card-body">
		              <h3 class="card-title">{{ __('Traffic summary') }}</h3>
		              <div id="chart-traffic-summary"></div>
		          </div>
		      </div>
		  </div>
		</div>

		<div class="row">
			<div class="col col-md-6">
				<div class="card">
					<div class="card-header bg-info text-white">
						<h3 class="card-title">{{ __('Traffic per tool (Updated daily)') }}</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>{{ __('Tool name') }}</th>
										<th>{{ __('Total views') }}</th>
									</tr>
								</thead>
								<tbody>
									@if ( $countPerTool->isNotEmpty() )

										@foreach ($countPerTool as $element)
											<tr>
												<td>{{ $element['tool_name'] }}</td>
												<td>{{ $element['count'] }}</td>
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

						<div class="float-end mt-3">
							{{ $countPerTool->links() }}
						</div>

					</div>
				</div>
			</div>

			<div class="col col-md-6">
				<div class="card">
					<div class="card-header bg-info text-white">
						<h3 class="card-title">{{ __('New user history') }}</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Full name</th>
										<th>Email</th>
										<th>{{ __('Join date') }}</th>
									</tr>
								</thead>
								<tbody>
									@if ( !empty($users) )

										@foreach ($users as $user)
											<tr>
												<td>{{ $user['fullname'] }}</td>
												<td>{{ $user['email'] }}</td>
												<td>{{ $user['created_at'] }}</td>
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

						<div class="float-end mt-3">
							{{ $users->links() }}
						</div>

					</div>
				</div>
			</div>
		</div>

      <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
          window.ApexCharts && (new ApexCharts(document.getElementById('chart-traffic-summary'), {
            chart: {
              type: "area",
              fontFamily: 'inherit',
              height: 240,
              parentHeightOffset: 0,
              toolbar: {
                show: false,
              },
              animations: {
                enabled: false
              },
              zoom: {
                enabled: false
              },
            },
            dataLabels: {
              enabled: false,
            },
            fill: {
              opacity: .16,
              type: 'solid'
            },
            stroke: {
              width: 3,
              lineCap: "round",
              curve: "smooth",
            },
            series: [{
              name: "{{ __('Total Views') }}",
              data: [
                @foreach ($toolPerDay as $tool)
                "{{ $tool['history'] }}",
                @endforeach
              ],
            }],
            grid: {
              padding: {
                top: -20,
                right: 0,
                left: -4,
                bottom: -4
              },
              strokeDashArray: 4,
            },
            xaxis: {
              labels: {
                padding: 0,
              },
              tooltip: {
                enabled: false
              },
              axisBorder: {
                show: false,
              },
              type: 'datetime',
            },
            yaxis: {
              labels: {
                padding: 4
              },
            },
            labels: [
                @foreach ($getAllDays as $day)
                  "{{ $day['date'] }}",
                @endforeach
            ],
            colors: ["#206bc4"],
            legend: {
              show: false,
            },
          })).render();
        });
        // @formatter:on
      </script>
</div>