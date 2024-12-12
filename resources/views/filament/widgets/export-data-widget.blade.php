<x-filament-widgets::widget>
    <x-filament::section>
        <ul class="mb-4">
            @foreach ($groupedData as $agency => $categories)
                <li>{{ $agency }} : {{ $categories }}</li>
            @endforeach
        </ul>
        <div class="space-y-6">
            <form action="{{ route('filament.widgets.export-data-widget.export') }}" method="POST">
                @csrf
                <button type="submit" class="underline text-orange-600 font-bold text-sm">Export semua</button>
            </form>
            <form action="{{ route('filament.widgets.export-data-widget.export', ['robot_category' => 'sumo']) }}" method="POST">
                @csrf
                <button type="submit" class="underline text-orange-600 font-bold text-sm">Export Sumo Game</button>
            </form>
            <form action="{{ route('filament.widgets.export-data-widget.export', ['robot_category' => 'avoider']) }}" method="POST">
                @csrf
                <button type="submit" class="underline text-orange-600 font-bold text-sm">Export Avoider (obstacle)</button>
            </form>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
