# Filament Pages

## Dashboard

Widgets:

- Active subscriptions
- Monthly estimated cost
- Annual estimated cost
- Upcoming renewals
- Expiring subscriptions
- Recent notification activity

## Subscription Resource

### List

Columns:

- Provider
- Subscription
- Plan
- Category
- Price
- Billing cycle
- Next renewal
- Status
- Auto-renew

Filters:

- Category
- Billing cycle
- Status
- Auto-renew
- Renewal date range

### Form

Sections:

1. Subscription details
2. Billing
3. Dates
4. Renewal settings
5. Notes

### View

Show:

- Current subscription information
- Renewal timeline
- Reminder rules
- Payment history
- Change history

## Category Resource

Basic CRUD for categories.

## Payment Resource

Payments can be managed from a subscription relation manager.

## Notification history

Show generated reminders with:

- Subscription
- Event
- Scheduled date
- Generated date
- Read status

The notification history is intended for audit and troubleshooting, not as a replacement for Laravel's user notification UI.
