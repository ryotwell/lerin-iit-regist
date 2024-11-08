<x-filament-widgets::widget>
    <x-filament::section>
        <form action="{{ route('filament.widgets.export-data-widget.export') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Export Data ke Excel</button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
