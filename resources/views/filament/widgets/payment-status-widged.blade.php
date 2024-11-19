<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex justify-between mb-3">
            <div class="font-bold">
                Status
            </div>
            <div>
                @if (auth()->user()->payment->status == 'approved')
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                    {{ getPaymentStatus(auth()->user()->payment->status) }}
                </span>
                @elseif (auth()->user()->payment->status == 'review_status')
                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                    {{ getPaymentStatus(auth()->user()->payment->status) }}
                </span>
                @else
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                    {{ getPaymentStatus(auth()->user()->payment->status) }}
                </span>
                @endif

            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
