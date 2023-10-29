<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     *
     * @var array
     */
    protected $addHttpCookie = true;

    protected $except = [
        'api/*',
        '/webhook*',
        '/gocardless-webhook*',
        'public/webhook/*',
        'public/gocardless-webhook/*',
        'http://localhost/QuranTuition/public/webhook',
        'http://localhost/QuranTuition/public/gocardless-webhook',
        'http://127.0.0.1:8000/webhook',
        'http://localhost:8000/webhook',
        'http://localhost:8000/gocardless-webhook',
        'http://localhost:8000/gocardless-webhook',
        'https://onlinequrantuition.co.uk/webhook',
        'https://onlinequrantuition.co.uk/gocardless-webhook',
    ];
}
