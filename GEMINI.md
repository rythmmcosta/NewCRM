# eSmartCRM New Project Guide

This project uses **Laravel 11**, **Filament v5**, and **Livewire v4**.

## Specialized Knowledge & Skills
I have been equipped with specialized skills and documentation for this project:

### Skills
- **filament-v5**: Expert guidance for Filament v5 resources, forms, tables, and widgets.
- **laravel-ui-ux**: Advanced patterns for GSAP animations, Tailwind CSS v4, and interactive feedback.

### Documentation
Detailed documentation is stored in `docs/filament-v5/`:
- [INDEX](docs/filament-v5/INDEX.md)
- [Resources](docs/filament-v5/resources.md)
- [Forms](docs/filament-v5/forms.md)
- [Tables](docs/filament-v5/tables.md)
- [Actions](docs/filament-v5/actions.md)
- [Schemas](docs/filament-v5/schemas.md)
- [Notifications](docs/filament-v5/notifications.md)
- [Widgets](docs/filament-v5/widgets.md)

## Development Workflow
1. **Research**: Consult the `docs/` and use specialized skills for any Filament/UI task.
2. **Implementation**: Follow the patterns defined in the skills (e.g., reactive forms, GSAP animations).
3. **Verification**: Use Filament's testing utilities and ensure Livewire v4 compatibility.

## Execution Instructions
RUN COMMAND: git pull origin main && php artisan migrate && npm run dev -- --port 21471

### AGENT LOOP ACTION
1. Run: git pull origin master
2. Run: git add .
3. Run: git commit -m "syncing project files from office"
4. Run: git push origin master
5. Run: echo "Office PC Gemini is active and finished at $(date)" >> GEMINI_STATUS.md
6. Run: git add GEMINI_STATUS.md && git commit -m "status update: done" && git push origin master
