<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

class LivewireSchemeMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->secure()) {
            Config::set('livewire.asset_url', rtrim(secure_url('/'), '/'));
        } else {
            Config::set('livewire.asset_url', rtrim(asset('/'), '/'));
        }

        return $next($request);
    }
}
