<div class="card">
    <div class="card-body">
        <p>{{ __('The sitemap is automatically generated, so you don\'t need to do anything other than submit it to Google Search Console, Bing, or other search engines.') }}</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <tbody>
                <tr>
                    <td class="align-middle bg-light fw-bold">{{ __('Sitemap URL') }}</td>
                    <td class="align-middle">{{ url('/sitemap.xml') }}</td>
                </tr>
                <tr>
                    <td class="align-middle bg-light fw-bold">{{ __('Sitemap File') }}</td>
                    <td class="align-middle">
                        <a href="{{ url('/sitemap.xml') }}" class="btn btn-success" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5"></path> <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5"></path> </svg>
                            {{ __('View Sitemap File') }}
                        </a>
                    </td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
</div>