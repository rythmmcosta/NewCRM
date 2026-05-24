---
name: filament-v5
description: Expert guidance for Filament v5, Livewire v4, and Tailwind CSS v4. Use when building admin panels, CRUD resources, reactive forms, and complex dashboard widgets in Laravel 11+.
---

# Filament v5 Expert Skill

This skill provides specialized knowledge for Filament v5 (released Jan 2026), focusing on its integration with Livewire v4 and modern Laravel patterns.

## Core Features

### 1. Resources & CRUD
Use when creating administrative interfaces for models.
- **Trigger**: `php artisan make:filament-resource ModelName`
- **Key Methods**: `form()`, `table()`, `getPages()`, `getEloquentQuery()`.
- **Advanced**: Use `isReadOnly()` to disable mutations or `getGlobalSearchResultTitle()` for search customization.

### 2. Reactive Forms (Livewire v4)
Filament v5 forms are highly reactive.
- Use `live()` on fields to trigger immediate updates.
- Use `afterStateUpdated(fn ($state, $set) => ...)` for dependent fields (e.g., Slug from Title).
- **Optimization**: Use `debounce(500)` or `onBlur: true` to reduce server roundtrips.

### 3. Tables & Actions
- **Actions**: Can be `button()`, `link()`, or `iconButton()`. Actions support confirmation modals with custom schemas.
- **Columns**: Support `sortable()`, `searchable()`, and `toggleable()`.
- **Bulk Actions**: Use `BulkAction::make()` for operations on multiple records.

### 4. Widgets & Notifications
- **Widgets**: Stats, Charts, and Tables. Use `InteractsWithPageFilters` for cross-widget filtering.
- **Notifications**: Fluent API: `Notification::make()->title('...')->success()->send()`.

## Best Practices
- **Type Safety**: Use typed closures `fn (string $state, Customer $record) => ...`.
- **Performance**: Eager load relationships in `getEloquentQuery()`.
- **UI/UX**: Group navigation using `$navigationGroup`. Use Heroicons v2.

## Reference Documentation
Local documentation is available in `docs/filament-v5/`:
- [Resources](docs/filament-v5/resources.md)
- [Forms](docs/filament-v5/forms.md)
- [Tables](docs/filament-v5/tables.md)
- [Actions](docs/filament-v5/actions.md)
- [Schemas](docs/filament-v5/schemas.md)
- [Notifications](docs/filament-v5/notifications.md)
- [Widgets](docs/filament-v5/widgets.md)
