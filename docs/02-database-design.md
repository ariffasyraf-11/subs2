# Database Design

## users

Uses Laravel's standard users table.

## subscription_categories

| Column | Purpose |
|---|---|
| id | Primary key |
| user_id | Owner |
| name | Category name |
| description | Optional description |
| created_at | Timestamp |
| updated_at | Timestamp |

## subscriptions

| Column | Purpose |
|---|---|
| id | Primary key |
| user_id | Owner |
| category_id | Optional category |
| provider | Service/provider name |
| name | Subscription name |
| plan_name | Optional plan |
| price | Current recurring price |
| currency | ISO currency code |
| billing_cycle | Billing frequency |
| start_date | Subscription start |
| next_renewal_date | Next renewal |
| end_date | Optional expiry |
| status | Current lifecycle status |
| auto_renew | Whether renewal is expected |
| payment_method | Optional payment method |
| notes | User notes |
| created_at | Timestamp |
| updated_at | Timestamp |

## subscription_reminder_rules

| Column | Purpose |
|---|---|
| id | Primary key |
| subscription_id | Subscription |
| event_type | renewal or expiry |
| days_before | Reminder offset |
| enabled | Rule status |
| created_at | Timestamp |
| updated_at | Timestamp |

## subscription_payments

| Column | Purpose |
|---|---|
| id | Primary key |
| subscription_id | Subscription |
| amount | Amount paid |
| currency | Currency |
| paid_at | Payment date |
| payment_method | Payment method |
| reference | Optional reference |
| notes | Optional notes |
| created_at | Timestamp |
| updated_at | Timestamp |

## subscription_histories

Stores important changes to a subscription.

Recommended fields:

- subscription_id
- user_id
- event_type
- old_values JSON
- new_values JSON
- description
- created_at

## subscription_notifications

Stores generated reminder history.

Recommended fields:

- user_id
- subscription_id
- reminder_rule_id
- event_type
- scheduled_for
- generated_at
- read_at
- status
- message

A uniqueness strategy should prevent duplicate reminders for the same subscription event and reminder rule.

## Relationships

```text
User
 ├── hasMany Subscription
 ├── hasMany Category
 └── hasMany SubscriptionNotification

Subscription
 ├── belongsTo User
 ├── belongsTo Category
 ├── hasMany ReminderRule
 ├── hasMany Payment
 ├── hasMany History
 └── hasMany Notification
```
