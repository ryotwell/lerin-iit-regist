<x-filament-widgets::widget>
    <x-filament::section>
        <form class="mb-6" action="{{ route('filament.widgets.export-data-widget.export') }}" method="POST">
            @csrf
            <button type="submit" class="underline text-orange-600 font-bold text-sm">Export data tim semua kategori</button>
        </form>
        <form class="mb-6" action="{{ route('filament.widgets.export-data-widget.export', ['robot_category' => 'avoider']) }}" method="POST">
            @csrf
            <button type="submit" class="underline text-orange-600 font-bold text-sm">Export data tim kategori Avoider (Obstacle)</button>
        </form>
        <form action="{{ route('filament.widgets.export-data-widget.export', ['robot_category' => 'sumo']) }}" method="POST">
            @csrf
            <button type="submit" class="underline text-orange-600 font-bold text-sm">Export data tim kategori Sumo Game</button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
