<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Adds baseline hardening headers to every response.
 * (CSP is intentionally omitted — the landing + app load CDN scripts/fonts;
 *  a strict policy is a separate, carefully-tested change.)
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Clickjacking — disallow being framed by other origins.
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        // Stop browsers MIME-sniffing responses into a different content type.
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        // Don't leak full URLs (which can carry ids) to third-party sites.
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        // Disable powerful browser features the web app doesn't use.
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=(), browsing-topics=()');

        // HSTS — force HTTPS for a year (only advertise it over a secure request).
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000');
        }

        return $response;
    }
}
