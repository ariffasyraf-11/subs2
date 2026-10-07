# Functional Design

## 1. Dashboard

The dashboard gives the user a quick view of:

- Active subscription count
- Estimated monthly cost
- Estimated annual cost
- Renewals in the next 7 days
- Renewals in the next 30 days
- Expiring subscriptions
- Recent price changes

## 2. Subscriptions

Each subscription stores:

- Provider
- Subscription name
- Plan name
- Category
- Price
- Currency
- Billing cycle
- Start date
- Next renewal date
- Optional end date
- Status
- Auto-renew flag
- Payment method
- Notes

Supported billing cycles:

- Weekly
- Monthly
- Quarterly
- Half-yearly
- Yearly
- Custom

Supported statuses:

- Active
- Paused
- Cancelled
- Expired

## 3. Reminder rules

Each subscription can have one or more reminder rules.

Example:

- 30 days before
- 7 days before
- 1 day before

A reminder should only be generated once for the same subscription event and reminder rule.

## 4. Notification workflow

The scheduled checker finds subscriptions approaching a configured renewal or expiry date.

It then:

1. Determines the event type.
2. Checks whether the reminder was already generated.
3. Creates the notification.
4. Records the notification in notification history.
5. Sends an email later when email notifications are enabled.

The first implementation should prioritize in-app notifications. Email can be added without changing the core subscription model.

## 5. Payment history

Payments are separate from subscriptions so a subscription can have many payment records.

A payment stores:

- Subscription
- Paid amount
- Currency
- Paid date
- Payment method
- Reference
- Notes

## 6. Subscription history

Important changes should be auditable.

Examples:

- Price changed from RM45 to RM55
- Plan changed from Basic to Premium
- Billing cycle changed from monthly to yearly
- Status changed from active to cancelled

## 7. User interaction

### Add subscription

User opens Subscriptions > New.

Required:

- Provider
- Subscription name
- Price
- Currency
- Billing cycle
- Start date
- Next renewal date
- Status

Optional:

- Plan
- Category
- End date
- Auto-renew
- Payment method
- Notes
- Reminder rules

### Review upcoming renewals

Dashboard > Upcoming Renewals shows subscriptions ordered by next renewal date.

### Review notifications

Notifications page shows:

- Notification message
- Event type
- Subscription
- Scheduled date
- Sent/generated date
- Read status

## 8. Cost calculation

Monthly equivalent:

- Monthly = monthly price
- Quarterly = price / 3
- Half-yearly = price / 6
- Yearly = price / 12
- Weekly = price * 52 / 12

Annual estimate uses the corresponding billing-cycle conversion.

These are estimates for planning and should not be treated as payment records.
