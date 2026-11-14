<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Adds baseline hardening headers to every response.
 *
 * The CSP is deliberately permissive on inline/eval — Livewire injects inline
 * scripts, Alpine + CDN-Tailwind need 'unsafe-eval' — but it allow-lists exactly
 * the external hosts the app loads (bunny/google fonts, jsdelivr, tailwind CDN,
 * npmcdn, GA) and locks down object-src / base-uri / frame-ancestors / form-action,
 * which is the meaningful XSS-exfiltration defense here.
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
        // Content Security Policy — allow-list the real external origins.
        $response->headers->set('Content-Security-Policy', $this->contentSecurityPolicy());

        // Don't advertise the PHP version to attackers.
        $response->headers->remove('X-Powered-By');
        if (\function_exists('header_remove')) {
            @header_remove('X-Powered-By');
        }

        // HSTS — force HTTPS for a year (only advertise it over a secure request).
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000');
        }

        return $response;
    }

    /**
     * Build the CSP from the external hosts actually referenced in the views
     * (landing CDN Tailwind/Alpine, app layouts' fonts + jsdelivr, GA).
     */
    private function contentSecurityPolicy(): string
    {
        return implode('; ', [
            "default-src 'self'",
            "base-uri 'self'",
            "object-src 'none'",
            "frame-ancestors 'self'",
            "form-action 'self'",
            "img-src 'self' data: blob: https:",
            "font-src 'self' data: https://fonts.bunny.net https://fonts.gstatic.com",
            "style-src 'self' 'unsafe-inline' https://fonts.bunny.net https://fonts.googleapis.com https://cdn.jsdelivr.net https://cdn.tailwindcss.com",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdn.tailwindcss.com https://npmcdn.com https://www.googletagmanager.com https://www.google-analytics.com",
            "connect-src 'self' https://www.googletagmanager.com https://www.google-analytics.com",
        ]);
    }
}
