<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ \App\Models\Admin\Header::first()->favicon }}">

    {!! SEO::generate() !!}
    
    <x-admin.headerAssets />

    @livewireStyles

</head>
<body class="antialiased {{ Cookie::get('theme_mode') }}">

    <div class="wrapper">
      <x-admin.sidebar />

      <div class="page-wrapper">

            <!-- Begin::Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg" id="navbarBlur" navbar-scroll="false">
             <div class="container-fluid">

                <x-admin.breadcrumbs :breadcrumbs="$breadcrumbs" />

                <x-admin.navright />

             </div>
            </nav>
            <!-- End::Navbar -->

            <div class="page-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col">

                        {{ $slot }}

                    </div>
                  </div>
                </div>
            </div>

            <x-admin.footer />
      </div>
    </div>

    <x-admin.footerAssets />

    @livewireScripts

    <script>
    (function( $ ) {
        "use strict";

        document.addEventListener('livewire:load', function () {
        
            window.addEventListener('closeModal', event => {
                jQuery('#' + event.detail.id).modal('hide');
            });

            window.addEventListener('showModal', event => {
                jQuery('#' + event.detail.id).modal('show');
            });

            window.addEventListener('alert', event => {
                toastr[event.detail.type](event.detail.message);
            });

        });

    })( jQuery );
    </script>

</body>
</html>
