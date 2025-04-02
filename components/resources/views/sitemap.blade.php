<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

@foreach ($pages as $page)

    @switch( $page['type'] )
        @case('page')
        @case('tool')
        @case('contact')
        @case('report')

            @foreach($page['translations'] as $key => $value)
                @if ( $value['robots_meta'] )
                    @php
                        try {
                            $url = localization()->getLocalizedURL($value['locale'], route('home') . '/' . $page['slug'], [], false);
                        } catch (\Exception $e) {
                            continue;
                        }
                    @endphp
                    <url>
                        <loc>{{ $url }}</loc>
                        <lastmod>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Carbon\Carbon::parse($page['updated_at']))->tz('UTC')->toAtomString() }}</lastmod>
                    </url>
                @endif
            @endforeach

        @break

        @case('post')

            @foreach($page['translations'] as $key => $value)
                @if ( $value['robots_meta'] )
                    @php
                        try {
                            $url = localization()->getLocalizedURL($value['locale'], route('home') . '/blog/' . $page['slug'], [], false);
                        } catch (\Exception $e) {
                            continue;
                        }
                    @endphp
                    <url>
                        <loc>{{ $url }}</loc>
                        <lastmod>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Carbon\Carbon::parse($page['updated_at']))->tz('UTC')->toAtomString() }}</lastmod>
                    </url>
                @endif
            @endforeach

        @break

        @case('home')

            @foreach($page['translations'] as $key => $value)
                @if ( $value['robots_meta'] )
                    @php
                        try {
                            $url = localization()->getLocalizedURL($value['locale'], route('home'), [], false);
                        } catch (\Exception $e) {
                            continue;
                        }
                    @endphp
                    <url>
                        <loc>{{ $url }}</loc>
                        <lastmod>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Carbon\Carbon::parse($page['updated_at']))->tz('UTC')->toAtomString() }}</lastmod>
                    </url>
                @endif
            @endforeach

        @break

        @default
    @endswitch

@endforeach
</urlset>
