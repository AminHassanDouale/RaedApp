<?php

return [

    /*
    |--------------------------------------------------------------------------
    | D-Money Payment Gateway — api.raedapp.com
    |--------------------------------------------------------------------------
    */

    'api_url'    => env('BILLING_API_URL', 'https://api.raedapp.com'),

    /*
    | API key sent as Bearer token in the Authorization header.
    | Set BILLING_API_KEY in your .env on production.
    */
    'api_key'    => env('BILLING_API_KEY', ''),

    /*
    | URL where D-Money posts payment notifications.
    | D-Money POSTs here; the gateway saves it to MySQL.
    | Laravel then polls GET /payment/notify/{order_id} to read the status.
    */
    'notify_url' => env('BILLING_NOTIFY_URL', 'https://api.raedapp.com/payment/notify'),

    /*
    | Shared secret for verifying inbound /webhooks/billing calls. When set, the
    | gateway must sign each webhook with HMAC-SHA256 over the raw request body
    | and send it in the X-Webhook-Signature header. Leave BLANK to disable
    | verification (the handler already re-queries the gateway, so forgeries
    | still can't mark an invoice paid — this is defense-in-depth).
    |
    | ⚠ Only set this in production AFTER the gateway is signing webhooks,
    |   otherwise legitimate notifications will be ignored.
    */
    'webhook_secret' => env('BILLING_WEBHOOK_SECRET', ''),

    /*
    | Set DMONEY_ENABLED=false in .env to disable D-Money payments gracefully
    | (e.g. while test credentials are being renewed).
    */
    'enabled' => env('DMONEY_ENABLED', true),

    'timeout' => 30,

    'endpoints' => [
        'health'          => '/health',
        'payment_create'  => '/payment/create',
        'payment_query'   => '/payment/query',
        'payment_notify'  => '/payment/notify',
    ],
];
