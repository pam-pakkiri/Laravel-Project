<div>

    <button class="btn btn-danger mb-3" wire:click="onClearHistory">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M4 7l16 0"></path> <path d="M10 11l0 6"></path> <path d="M14 11l0 6"></path> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>
        {{ __('Clear History') }}
    </button>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('URL') }}</th>
                        <th>{{ __('Response') }}</th>
                        <th>{{ __('Time') }}</th>
                    </tr>
                </thead>

               <tbody>
                    @if ( $histories->isNotEmpty() )

                        @foreach ($histories as $history)

                            <tr>
                                <td>{{ $history->url }}</td>
                                <td>{{ $history->response }}</td>
                                <td>{{ $history->created_at }}</td>
                            </tr>

                        @endforeach

                    @else

                        <tr>
                            <td colspan="3">{{ __('No record found') }}</td>
                        </tr>

                    @endif
               </tbody>
            </table>
        </div>

        @if( $histories->hasPages() )
            <div class="mx-auto mt-3">
                {{ $histories->links() }}
            </div>
        @endif
    </div>

    <div class="card mt-3">
        <div class="card-header bg-info text-white">
            <h3 class="card-title">{{ __('Response Code Help') }}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Response Code') }}</th>
                            <th>{{ __('Response Message') }}</th>
                            <th>{{ __('Reasons') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ __('200') }}</td>
                            <td>{{ __('OK') }}</td>
                            <td>{{ __('The URL was successfully submitted to the IndexNow API.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('202') }}</td>
                            <td>{{ __('Accepted') }}</td>
                            <td>{{ __('The URL was successfully submitted to the IndexNow API, but the API key validation is pending.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('400') }}</td>
                            <td>{{ __('Bad Request') }}</td>
                            <td>{{ __('The request was invalid.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('403') }}</td>
                            <td>{{ __('Forbidden') }}</td>
                            <td>{{ __('The key was invalid (e.g. key not found, file found but key not in the file).') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('422') }}</td>
                            <td>{{ __('Unprocessable Entity') }}</td>
                            <td>{{ __('The URLs don\'t belong to the host or the key is not matching the schema in the protocol.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('429') }}</td>
                            <td>{{ __('Too Many Requests') }}</td>
                            <td>{{ __('Too Many Requests (potential Spam).') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
