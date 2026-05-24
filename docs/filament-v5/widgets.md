# Filament v5 Widgets

Dashboard components for visualizing data through stats, charts, or tables.

## Widget Types
- **Stats Overview:** Displays cards with labels, values, and trend icons.
- **Chart Widgets:** Supports Line, Bar, Pie, etc., using Chart.js.
- **Table Widgets:** Renders a standard Filament table as a widget.

## Configuration
- `$sort`: Defines the order on the dashboard.
- `$columnSpan`: Controls width (1-12 or 'full').
- `canView()`: Static method for conditional authorization.

## Filtering
Use the `HasFiltersForm` trait on the Dashboard page and `InteractsWithPageFilters` on the widget to create cross-widget filters.

## CLI Command
```bash
php artisan make:filament-widget MyWidget [--stats-overview] [--chart] [--table]
```
