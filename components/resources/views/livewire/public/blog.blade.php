<div class="row">
  @foreach ($pageTrans as $pageTran)
    <div class="col-lg-4 col-sm-6">
      <div class="card card-plain card-blog">
        <div class="card-image border-radius-lg position-relative">
          <a href="{{ route('home') . '/blog/' . $pageTran->slug }}">
            <img class="w-100 border-radius-lg move-on-hover {{ ($general->lazy_loading) ? 'lazyload' : '' }}" {{ ($general->lazy_loading ) ? 'data-' : '' }}src="{{ ($pageTran->featured_image) ? $pageTran->featured_image : asset('assets/img/no-thumb.svg') }}">
          </a>
        </div>
        <div class="card-body">
          <h3 class="title">
            <a href="{{ route('home') . '/blog/' . $pageTran->slug }}" class="text-dark fw-bold" title="{{ $pageTran->title }}" target="{{ $pageTran->target }}">{{ $pageTran->title }}</a>
          </h3>
          <p>{{ $pageTran->short_description }}</p>

          <a href="{{ route('home') . '/blog/' . $pageTran->slug }}" class="btn btn-outline-primary" title="{{ $pageTran->title }}" target="{{ $pageTran->target }}">{{ __('Read More') }}
            <i class="ti ti-chevron-right text-sm" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  @endforeach

  <div class="d-flex justify-content-center mt-4">
    {{ $pageTrans->links() }}
  </div>
</div>