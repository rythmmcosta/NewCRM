---
name: laravel-ui-ux
description: Advanced UI/UX patterns for Laravel, including GSAP animations, Tailwind CSS v4, and Livewire v4 transitions. Use when adding polish, interactive feedback, or complex animations to Laravel applications.
---

# Laravel UI/UX & Animations Skill

This skill focuses on enhancing the visual impact and interactivity of Laravel applications using modern tools like GSAP, Tailwind CSS v4, and Livewire v4.

## GSAP & Animations
Integrate GSAP (GreenSock Animation Platform) for high-performance animations.

### Livewire Integration
Use `x-init` or `wire:init` to trigger animations when components load.
```html
<div x-init="gsap.from($el, { opacity: 0, y: 20, duration: 1 })">
    <!-- Content -->
</div>
```

### ScrollTrigger
Use GSAP ScrollTrigger for entrance animations.
```javascript
gsap.to(".box", {
  scrollTrigger: ".box", // start the animation when ".box" enters the viewport (once)
  x: 500
});
```

## Tailwind CSS v4
- **Implicit Compiling**: No more `content` array in config; v4 detects classes automatically.
- **Fluid Design**: Use container queries (`@container`) for responsive components.
- **Animations**: Use built-in `animate-` classes or define custom `@keyframes` in CSS.

## Interactive Feedback
- **Loading States**: Use `wire:loading` and `wire:target` for granular control.
- **Success Feedback**: Use Filament Notifications or GSAP-triggered "toast" animations.
- **Transitions**: Use Alpine.js `x-transition` for simple show/hide logic.

## Resources
- [GSAP Documentation](https://gsap.com/docs/v3/)
- [Tailwind CSS v4 Docs](https://tailwindcss.com/docs/v4-beta)
- [Livewire v4 Transitions](https://livewire.laravel.com/docs/transitions)
