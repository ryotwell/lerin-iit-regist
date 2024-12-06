<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <div class="flex flex-col">
                    <a href="{{ config('lerin.panduan.' . auth()->user()->robot_category) }}" target="_blank" class="text-primary-600 hover:text-primary-500 flex items-center gap-2">
                        <x-heroicon-o-arrow-down-tray class="w-5 h-5"/>
                        Panduan {{ getCategoryName(auth()->user()->robot_category) }}
                    </a>
                </div>
            </div>
        </div>

        <p>Technical Meeting tanggal 15 Desember 2024 secara online</p>
    </x-filament::section>
</x-filament-widgets::widget>
