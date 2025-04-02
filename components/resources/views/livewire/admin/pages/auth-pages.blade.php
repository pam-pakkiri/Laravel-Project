<div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Page Name') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Latest updates') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( $auth_pages->isNotEmpty() )

                            @foreach ($auth_pages as $auth_page)

                                <tr>
                                    <td>{{ $auth_page->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ ($auth_page->status) ? 'success' : 'secondary' }}">{{ ($auth_page->status) ? __('Enabled') : __('Disabled') }}</span>
                                    </td>
                                    <td>{{ $auth_page->updated_at }}</td>
                                    <td class="w-25">
                                        <a wire:click="onEnablePage( {{ $auth_page->id }} )" class="btn btn-success" title="{{ __('Enable') }}">
                                            <i class="fas fa-check icon"></i>
                                            {{ __('Enable') }}
                                        </a>

                                        <a wire:click="onDisablePage( {{ $auth_page->id }} )" class="btn btn-danger" title="{{ __('Disable') }}">
                                            <i class="fas fa-ban icon"></i>
                                            {{ __('Disable') }}
                                        </a>
                                    </td>
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
        </div>

</div>