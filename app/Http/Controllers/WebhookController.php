<?php

namespace App\Http\Controllers;

use App\Actions\SyncDmoneyPayment;
use App\Models\DmoneyTransaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * POST /webhooks/billing
     *
     * D-Money posts payment notifications here.
     * Payload: { merch_order_id, trade_no, trade_status, total_amount, trans_currency, pay_time }
     * Response must always be: { returnCode: "SUCCESS", returnMsg: "OK" }
     */
    public function handle(Request $request): JsonResponse
    {
        $data    = $request->all();
        $orderId = $data['merch_order_id'] ?? null;
        $status  = $data['trade_status']   ?? null;

        Log::info('D-Money webhook received', ['order_id' => $orderId, 'trade_status' => $status]);

        // Defense-in-depth: drop forged/unsigned calls early when a secret is set.
        if (! $this->signatureIsValid($request)) {
            Log::warning('D-Money webhook: invalid or missing signature — ignored', [
                'order_id' => $orderId,
                'ip'       => $request->ip(),
            ]);
            return response()->json(['returnCode' => 'SUCCESS', 'returnMsg' => 'OK']);
        }

        if (! $orderId || ! $status) {
            Log::warning('D-Money webhook: missing required fields', $data);
            return response()->json(['returnCode' => 'SUCCESS', 'returnMsg' => 'OK']);
        }

        try {
            // SECURITY: the webhook body is unauthenticated and forgeable, so we do
            // NOT trust its trade_status. Passing no payload forces SyncDmoneyPayment
            // to re-query the gateway (server-to-server) for the REAL order status —
            // a forged POST can therefore never mark an invoice as paid.
            app(SyncDmoneyPayment::class)->handle($orderId);
        } catch (\Throwable $e) {
            Log::error('D-Money webhook processing error', [
                'error'    => $e->getMessage(),
                'order_id' => $orderId,
            ]);
        }

        // Always acknowledge to D-Money
        return response()->json(['returnCode' => 'SUCCESS', 'returnMsg' => 'OK']);
    }

    /**
     * Verify the webhook's HMAC-SHA256 signature against BILLING_WEBHOOK_SECRET.
     *
     * Disabled (always true) when no secret is configured, so existing
     * deployments keep working until the gateway starts signing. When a secret
     * IS set, the gateway must send hash_hmac('sha256', <raw body>, <secret>)
     * in the X-Webhook-Signature header (an optional "sha256=" prefix is allowed).
     */
    private function signatureIsValid(Request $request): bool
    {
        $secret = (string) config('billing.webhook_secret', '');

        // Verification not configured → accept (handler still re-queries gateway).
        if ($secret === '') {
            return true;
        }

        $provided = (string) $request->header('X-Webhook-Signature', '');
        if ($provided === '') {
            return false;
        }

        // Accept both "sha256=<hex>" and bare "<hex>".
        $provided = (string) preg_replace('/^sha256=/i', '', $provided);

        $expected = hash_hmac('sha256', $request->getContent(), $secret);

        return hash_equals($expected, $provided);
    }
}
