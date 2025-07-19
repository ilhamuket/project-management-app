<div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-800 dark:text-neutral-200">{{ $title }}</h3>
        <span class="text-sm text-gray-500 dark:text-neutral-400">{{ $subtitle }}</span>
    </div>
    <div class="mt-4">
        {{ $slot }}
    </div>
</div>
