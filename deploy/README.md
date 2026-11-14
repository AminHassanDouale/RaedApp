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
sudo supervisorctl status raedapp-worker:*             # expect RUNNING
sudo tail -f /var/www/raedapp/storage/logs/worker.log  # live worker output
# safe end-to-end WhatsApp check that targets YOUR number:
php artisan whatsapp:test --type=ping --phone=2537XXXXXXX
```

> ⚠ **On production, never use `--type=invoice-overdue` / `attendance` / `invoice-pdf`.**
> Those auto-select a **real guardian** from the database and send an actual
> parent a message. Only `--type=ping --phone=<you>` is safe for a live test.

If jobs pile up, scale out by raising `numprocs` in the conf (e.g. `numprocs=2`),
then `supervisorctl reread && supervisorctl update`.

### Only run ONE worker program

If an older `scolapp-worker` (pre-rebrand) still exists, you'll have duplicate
workers on the same queue. Retire the old one and keep `raedapp-worker`:

```bash
cat /etc/supervisor/conf.d/scolapp-worker.conf     # confirm it's the same app
sudo supervisorctl stop scolapp-worker:*
sudo rm /etc/supervisor/conf.d/scolapp-worker.conf
sudo supervisorctl reread && sudo supervisorctl update
sudo supervisorctl status                           # only raedapp-worker remains
```

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
