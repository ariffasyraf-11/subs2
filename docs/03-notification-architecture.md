# Notification Architecture

## Scheduled check

The application should expose a scheduled command such as:

```bash
php artisan subscriptions:check-reminders
```

Laravel's scheduler runs this command periodically.

Recommended frequency:

- Every 15 minutes for production
- Every minute during development if needed

## Idempotency

The checker must be safe to run repeatedly.

For every candidate reminder, identify:

- subscription
- event type
- renewal/expiry occurrence
- reminder rule

Before generating a notification, check whether the same event has already been recorded.

This prevents duplicate messages when the scheduler runs more than once.

## Renewal example

Subscription:

```text
GitHub Pro
RM40/month
Next renewal: 18 Oct 2026
```

Rule:

```text
7 days before renewal
```

On 11 Oct 2026 the checker creates:

```text
GitHub Pro renews in 7 days for RM40.
```

The event is stored in `subscription_notifications`.

## Expiry example

Subscription:

```text
Adobe Creative Cloud
End date: 10 Oct 2026
```

Rule:

```text
3 days before expiry
```

On 7 Oct 2026:

```text
Adobe Creative Cloud expires in 3 days.
```

## Future email support

Email notifications should use Laravel Notifications so the same event can support:

- Database notification
- Mail notification
- Future channels

The notification generation logic should remain independent of the delivery channel.
