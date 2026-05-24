# Filament v5 Schemas

The declarative foundation for Filament UIs, acting as a container for form fields, infolist entries, and layout components.

## Component Categories
- **Form Fields:** `TextInput`, `Select`, `Checkbox`, etc.
- **Infolist Entries:** `TextEntry`, `IconEntry`, `ImageEntry` (read-only).
- **Layout Components:** `Grid`, `Section`, `Tabs`, `Wizard`, `Split`, `Fieldset`.
- **Prime Components:** `Text`, `Icon`, `Image` (static content).

## Nesting
Components use the `schema(array $components)` method to nest children.

## Global Configuration
`Component::configureUsing(Closure)` allows setting defaults for all instances of a component type.
