# Subscription Tracker & Notification System

A Laravel 13 + Filament 5 application for recording subscriptions, tracking renewal and expiry dates, monitoring recurring costs, and notifying users before important subscription events.

## Current repository state

The repository started as an empty project with only a placeholder README. This branch establishes the application specification and implementation structure:

- `feature/subscription-tracker`
- Functional design
- Database design
- Notification architecture
- Filament page/resource design

The next implementation step is to apply this design to a clean Laravel 13 installation and install Filament 5.

## Core workflow

```text
Record subscription
       ↓
Calculate / store renewal date
       ↓
Configure reminder rules
       ↓
Scheduled reminder check
       ↓
Generate notification
       ↓
User reviews notification
       ↓
Renew / cancel / pause / update subscription
```

## Main features

### Subscription management
- Provider and subscription name
- Plan
- Category
- Recurring price
- Currency
- Billing cycle
- Start date
- Next renewal date
- Optional end date
- Auto-renew flag
- Status
- Payment method
- Notes

### Notifications
- Renewal reminders
- Expiry reminders
- Multiple reminder offsets
- Duplicate-reminder protection
- Notification history
- In-app notifications first
- Email delivery as a later channel

### Tracking
- Payment history
- Price and plan change history
- Monthly cost estimate
- Annual cost estimate
- Upcoming renewals
- Expiring subscriptions

## Suggested application navigation

```text
Dashboard
Subscriptions
  ├── All
  ├── Active
  ├── Upcoming Renewals
  ├── Expiring
  └── Expired
Payments
Notifications
Categories
Settings
```

## Technology target

- Laravel 13
- PHP 8.3+
- Filament 5
- MySQL
- Laravel Scheduler
- Laravel Notifications

Laravel 13 requires PHP 8.3 or newer. The project intentionally keeps the first notification channel database/in-app focused so email configuration is not required to use the core reminder workflow.

## Documentation

- [Functional Design](docs/01-functional-design.md)
- [Database Design](docs/02-database-design.md)
- [Notification Architecture](docs/03-notification-architecture.md)
- [Filament Pages](docs/04-filament-pages.md)

## Local setup target

After the Laravel application files are added:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

Run the reminder scheduler during development:

```bash
php artisan schedule:work
```

## Example

A user records:

```text
Provider: GitHub
Subscription: GitHub Pro
Price: RM40
Billing: Monthly
Next renewal: 18 Oct 2026
Status: Active
Auto-renew: Yes
```

Reminder rules:

```text
7 days before renewal
1 day before renewal
```

The system generates an in-app notification before the renewal and records the event in notification history.
