<x-filament-widgets::widget>
    <x-filament::section>
        <h1 class="text-lg font-semibold mb-6">Informasi Tim</h1>

        <div class="relative overflow-x-auto mb-6">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Tim
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->name }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Instansi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="{{ getAgencyLogo(auth()->user()->agency) }}" alt="" class="w-8 h-8">
                            <span class="ml-2">
                                {{ auth()->user()->agency }}
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Kategori Robot
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ getCategoryName(auth()->user()->robot_category) }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Email Tim
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->email }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No. Whatsapp
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->whatsapp_number ?? '-' }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            Silahkan hubungi admin jika ada perubahan pada informasi tim.
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
