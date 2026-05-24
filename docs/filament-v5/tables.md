# Filament v5 Tables & Columns

Components for rendering data lists with support for sorting, searching, and inline editing.

## Column Types
`TextColumn`, `IconColumn`, `ImageColumn`, `ColorColumn`, `SelectColumn`, `ToggleColumn`.

## Key Column Methods
- `sortable(array|Closure $query)`: Enables sorting, optionally with custom logic.
- `searchable(bool|array|Closure $query)`: Enables global or individual column search.
- `toggleable(isToggledHiddenByDefault: bool)`: Allows users to hide/show columns.
- `url(Closure)` / `action(Closure)`: Makes cells clickable to navigate or run code.
- `counts(string $relationship)`: Displays the count of related records.

## Table Configuration
- `defaultSort(string $column, string $direction)`: Sets the initial sort state.
- `persistSortInSession()`, `persistSearchInSession()`: Saves user state across visits.
