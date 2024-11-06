@php

$approved = auth()->user()->payment->status === 'approved';

@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex justify-between mb-3">
            <div class="font-bold">
                Status Pendaftaran
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
        <a href="/panel/payments/{{ auth()->user()->payment->id }}/upload" class="text-sm underline text-blue-500 flex items-center">
            Upload bukti pembayaran
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 lucide lucide-move-right"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
        </a>
    </x-filament::section>
</x-filament-widgets::widget>
