<x-filament-widgets::widget>
    <x-filament::section>
        <h1 class="text-lg font-semibold mb-6">Informasi Lainnya</h1>

        <div class="relative overflow-x-auto mb-6">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                        Anggota 1
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
                        Anggota 2
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->participant_two_name }}
                    </td>
                </tr>
                @if (auth()->user()->robot_category == 'sumo')
                <tr>
                    <th scope="col" class="px-6 py-3">
                        NIM/NIS/NIK {{ getParticipantLabel(auth()->user()->robot_category) }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        :
                    </th>
                    <td class="px-6 py-4">
                        {{ auth()->user()->responsible_person_nim_or_nis ?? '-' }}
                    </td>
                </tr>
                @endif
                <tr>
                    <th scope="col" class="px-6 py-3">
                        NIM/NIS/NIK Anggota 1
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
                        NIM/NIS/NIK Anggota 2
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
    </x-filament::section>
</x-filament-widgets::widget>
