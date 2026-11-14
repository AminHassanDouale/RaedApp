# RaedApp — deployment helpers

## Queue worker (Supervisor)

Queued jobs (WhatsApp + email notifications, etc.) only run while a worker is
alive. On the production VPS, run the worker under **Supervisor** so it starts on
boot and auto-restarts on crash.

`--timeout=60` is deliberately **below** the queue's `retry_after=90`
(`config/queue.php`), so a job can never be retried while a previous attempt is
still running.

### Install (once)

```bash
sudo apt-get update && sudo apt-get install -y supervisor

# drop in the program config
sudo cp /var/www/raedapp/deploy/supervisor/raedapp-worker.conf \
        /etc/supervisor/conf.d/raedapp-worker.conf

sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start raedapp-worker:*
sudo supervisorctl status            # -> raedapp-worker:raedapp-worker_00  RUNNING
```

The worker runs as `www-data`; make sure it owns storage:

```bash
sudo chown -R www-data:www-data /var/www/raedapp/storage /var/www/raedapp/bootstrap/cache
```

### After every deploy

Tell the running workers to pick up the new code (they finish the current job,
then restart):

```bash
php artisan queue:restart
```

(You already run this in the deploy steps — keep it.)

### Verify it's processing

```bash
# queue a real test and watch it drain
php artisan whatsapp:test --type=invoice-overdue      # dispatches a queued notification
php artisan queue:work --once                          # or let Supervisor's worker handle it
sudo tail -f /var/www/raedapp/storage/logs/worker.log  # live worker output
```

If jobs pile up, scale out by raising `numprocs` in the conf (e.g. `numprocs=2`),
then `supervisorctl reread && supervisorctl update`.

### Failed jobs

```bash
php artisan queue:failed        # list
php artisan queue:retry all     # requeue them
```

---

## Webhook signature (D-Money)

`/webhooks/billing` verifies an HMAC-SHA256 signature **only when**
`BILLING_WEBHOOK_SECRET` is set (otherwise verification is skipped — the handler
still re-queries the gateway, so a forgery can't mark an invoice paid regardless).

To turn it on, the gateway (`api.raedapp.com`) must sign each webhook:

```
X-Webhook-Signature: sha256=<hex>    where <hex> = hash_hmac('sha256', <raw body>, BILLING_WEBHOOK_SECRET)
```

Then set the **same** secret on both sides and `php artisan config:cache`.
⚠ Only set `BILLING_WEBHOOK_SECRET` in production **after** the gateway is
signing, or legitimate webhooks will be ignored.
