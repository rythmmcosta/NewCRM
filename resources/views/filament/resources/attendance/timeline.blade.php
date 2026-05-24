@php
    $events = $attendance->events();
@endphp

<div class="space-y-6">
    <div class="relative">
        <!-- Vertical line -->
        <div class="absolute left-4 top-0 h-full w-0.5 bg-gray-200 dark:bg-gray-700"></div>

        <ul class="relative space-y-8">
            @foreach($events as $event)
                <li class="relative pl-10">
                    <!-- Dot -->
                    <div @class([
                        'absolute left-0 top-1 flex h-8 w-8 items-center justify-center rounded-full ring-4 ring-white dark:ring-gray-900',
                        'bg-success-100 text-success-600' => $event['color'] === 'success',
                        'bg-warning-100 text-warning-600' => $event['color'] === 'warning',
                        'bg-danger-100 text-danger-600' => $event['color'] === 'danger',
                    ])>
                        <x-filament::icon :icon="$event['icon']" class="h-4 w-4" />
                    </div>

                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $event['title'] }}
                            </h3>
                            <time class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $event['time']->format('g:i:s A') }}
                            </time>
                        </div>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ $event['description'] }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-800/50">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 text-uppercase tracking-wider">Total Work Time</span>
            <span class="text-lg font-bold text-primary-600 dark:text-primary-400">{{ $attendance->total_hours }} Hours</span>
        </div>
    </div>
</div>
