# Filament v5 Actions

UI elements (buttons, links) that trigger workflows, often involving confirmation modals or data collection.

## Trigger Styles
`button()`, `link()`, `iconButton()`, `badge()`.

## Modal Configuration
- `requiresConfirmation()`: Adds a simple "Are you sure?" check.
- `form(array $schema)`: Collects data from the user before executing the action.
- `modalHeading()`, `modalDescription()`, `modalSubmitActionLabel()`.

## Execution
- `action(Closure)`: The PHP logic to run upon submission.
- `url(string|Closure)`: Redirects the user instead of running a closure.

## Authorization
- `authorize(string $policyMethod)` or `visible(bool|Closure)`.
