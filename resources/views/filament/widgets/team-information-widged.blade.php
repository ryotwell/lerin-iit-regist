<x-filament-widgets::widget>
    <x-filament::section>
        <h1 class="text-lg font-semibold">Informasi Tim</h1>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Tim
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{  auth()->user()->name }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Asal Instansi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{  auth()->user()->agency }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Anggota 1
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{  auth()->user()->participant_one_name }} - {{ auth()->user()->participant_one_nim_or_nis ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Anggota 2
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{  auth()->user()->participant_two_name }} - {{ auth()->user()->participant_two_nim_or_nis ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Anggota 3
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{  auth()->user()->participant_three_name }} - {{ auth()->user()->participant_three_nim_or_nis ?? '-' }}
                    </td>
                </tr>
            </table>

    </x-filament::section>
</x-filament-widgets::widget>
