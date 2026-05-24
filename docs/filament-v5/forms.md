# Filament v5 Forms

A server-driven package for building dynamic forms, integrated with Livewire v4 for reactivity.

## Field Configuration
- `make(string $name)`: Static constructor using the model attribute name.
- `required()`, `maxLength(int)`, `email()`: Fluent validation methods.
- `label(string|Closure)`, `placeholder(string)`: UI text customization.
- `default(mixed)`: Sets the initial value for new records.
- `disabled(bool|Closure)`, `hidden(bool|Closure)`: Conditional visibility and interactivity.

## Reactivity & Lifecycle
- `live()`: Re-renders the form on every change (or `onBlur: true`).
- `afterStateUpdated(Closure)`: Hook to run logic (like slug generation) when a field changes.
- `dehydrateStateUsing(Closure)`: Transforms data before it is saved to the model.

## Utility Injection
Callbacks accept `$get`, `$set`, `$state`, `$record`, and `$operation`.
