<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admin/check-pwd",
        "/admin/check-confirm-pwd",
        "/admin/status-category",
        "/admin/status-section",
        "/admin/status-brand",
        "/admin/status-product",
        "/admin/status-product-attr",
        "/admin/status-product-img",
        "/admin/status-banner",
        "/admin/append-cat",
        //"/change-price"
       // "/change-price"
    ];
}
