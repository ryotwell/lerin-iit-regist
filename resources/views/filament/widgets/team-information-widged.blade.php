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
                        {{ auth()->user()->agency }}
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
                        {{ getParticipantLabel(auth()->user()->robot_category) }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->responsible_person_name }}
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
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Peserta 1
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->participant_one_name }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Peserta 2
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->participant_two_name }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ auth()->user()->robot_category == 'sumo' ? 'NIM' : 'NIS' }} Peserta 1
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->participant_one_nim_or_nis ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ auth()->user()->robot_category == 'sumo' ? 'NIM' : 'NIS' }} Peserta 2
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->participant_two_nim_or_nis ?? '-' }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            Silahkan hubungi admin jika ada perubahan pada informasi tim.
        </div>
        <x-filament::link href="{{ config('lerin.admin.whatsapp') }}" class="underline mt-6" target="_blank">
            Edit Informasi Tim
        </x-filament::link>
    </x-filament::section>
</x-filament-widgets::widget>
