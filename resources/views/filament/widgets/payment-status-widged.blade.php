@php

$approved = auth()->user()->payment->status === 'approved';

@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex justify-between mb-3">
            <div class="font-bold">
                Status Pembayaran
            </div>
            <div>
                @if ($approved)
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                    {{ Str::ucfirst(auth()->user()->payment->status) }}
                </span>
                @else
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                    {{ Str::ucfirst(auth()->user()->payment->status) }}
                </span>
                @endif
            </div>
        </div>
        <x-filament::link href="/panel/payments/{{ auth()->user()->payment->id }}/upload" class="underline">
            Upload bukti pembayaran
        </x-filament::link>
    </x-filament::section>
</x-filament-widgets::widget>
