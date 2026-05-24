# Filament v5 Notifications

A fluent API for dispatching session-based or database alerts to users.

## Basic Usage
```php
Notification::make()
    ->title('Saved')
    ->success()
    ->send();
```

## Configuration Options
- `status('success'|'warning'|'danger'|'info')`: Sets icon and color automatically.
- `duration(int)` / `seconds(int)`: Controls how long the alert stays visible.
- `persistent()`: Requires the user to manually dismiss the notification.
- `actions(array $actions)`: Adds buttons to the notification (e.g., "Undo", "View").

## JavaScript API
```javascript
new FilamentNotification()
    .title('...')
    .send()
```
For client-side alerts.
