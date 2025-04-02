<div>

      <form wire:submit.prevent="onWhatIsMyIp">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="table-responsive mb-3">
            @if ( !empty($data) )
                <iframe id="gmap" src="https://maps.google.com/maps?ll={{ $data['lat'] }},{{ $data['lon'] }}&amp;z=13&amp;output=embed"></iframe>
            @endif

            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <td>{{ __('Your IP Address') }}</td>
                        <td class="text-danger fw-bold">{{ request()->ip() }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Location') }}</td>

                        @php

                            $preview = new \GeoIp2\Database\Reader( app_path('Classes/GeoLite2-City.mmdb') );

                            try {

                                $record_preview = $preview->city( request()->ip() );

                                echo '<td>'.$record_preview->country->name.' (' . $record_preview->country->isoCode . '), '.$record_preview->city->name.'</td>';

                            } catch (\GeoIp2\Exception\AddressNotFoundException $e) {

                                echo '<td>'. __('N/a') .'</td>';
                            }

                        @endphp
                        
                    </tr>

                    @if ( !empty($data) )
                        <tr>
                            <td>{{ __('Region') }}</td>
                            <td>{{ $data['regionName'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Country') }}</td>
                            <td>{{ $data['country'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Country code') }}</td>
                            <td>{{ $data['countryCode'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('City') }}</td>
                            <td>{{ $data['city'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Latitude') }}</td>
                            <td>{{ $data['lat'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Longitude') }}</td>
                            <td>{{ $data['lon'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Time zone') }}</td>
                            <td>{{ $data['timezone'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Currency code') }}</td>
                            <td>{{ $data['currency'] }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Zip') }}</td>
                            <td>{{ ($data['zip']) ? $data['zip'] : __('N/a') }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('ISP') }}</td>
                            <td>{{ $data['isp'] . ' (' . $data['as'] . ')' }}</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif

        <div class="form-group">
            <button class="btn btn-info d-block mx-auto" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onWhatIsMyIp">
                  <x-loading />
                </div>
                <span>{{ __('Show More Details') }}</span>
              </span>
            </button>
        </div>

      </form>
</div>