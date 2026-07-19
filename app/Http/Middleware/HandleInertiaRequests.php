<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use Illuminate\Http\Request;


class HandleInertiaRequests extends Middleware {
    protected $rootView = 'app';

    public function version(Request $request): ?string {
        return parent::version($request);
    }


    public function share(Request $request): array {
        return array_merge(parent::share($request), [
            'authDetails' => fn () => auth()->check() ? authDetails() : null,
            'appName' => config('app.name', 'Hospital Management System'),
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url()
            ],
        ]);
    }
}
