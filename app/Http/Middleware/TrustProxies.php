<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * Trusting all proxies is the standard recommendation when the app sits
     * behind a load balancer, reverse proxy, or shared-hosting proxy layer
     * that isn't directly bypassable by the public internet (Cloudflare,
     * cPanel/LiteSpeed, Nginx in front of PHP-FPM, etc). Without this,
     * Laravel can't tell the original request was HTTPS, which breaks secure
     * cookie/session handling and is a common cause of 419 "Page Expired"
     * errors in production. Narrow this to specific IPs/CIDRs instead of '*'
     * if the app server is ever directly reachable from the internet.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
