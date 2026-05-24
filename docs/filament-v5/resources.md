# Filament v5 Resources

Static classes used to build CRUD interfaces for Eloquent models. They define how administrators interact with data via tables and forms.

## CLI Command
```bash
php artisan make:filament-resource Customer [--simple] [--generate] [--soft-deletes] [--view]
```

## Key Configuration Properties
- `$model`: The Eloquent model associated with the resource.
- `$recordTitleAttribute`: The model attribute used to identify records (e.g., for global search).
- `$modelLabel` / `$pluralModelLabel`: Custom labels for the resource in the UI.
- `$navigationIcon`: Heroicon or custom icon for the navigation menu.
- `$navigationSort`: Integer to define the order in the navigation.
- `$navigationGroup`: String to group multiple resources under a single header.
- `$slug`: Custom URL segment for the resource.

## Core Methods
- `form(Schema $schema)`: Defines the form used for creating and editing records.
- `table(Table $table)`: Defines the table used for listing records.
- `getPages()`: Maps route names to page classes (e.g., `ListCustomers`, `CreateCustomer`).
- `getEloquentQuery()`: Customizes the base query for all resource operations.
