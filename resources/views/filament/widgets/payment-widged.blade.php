<x-filament-widgets::widget>
    <x-filament::section>
        <div class="md:max-w-3xl">
            @if (auth()->user()->payment->status === 'approved')
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                <div class="mb-4">
                    Proses administrasi telah selesai, silahkan masuk ke grub whatsapp di bawah untuk menunggu arahan dan informasi selengkapnya dari pihak panitia.
                </div>
                <div>
                    <x-filament::link href="{{ config('lerin.whatsapp.group') }}" class="underline" target="_blank" rel="noreferrer">
                        Masuk ke grub whatsapp
                    </x-filament::link>
                </div>
            </div>
            @else
            <div class="text-gray-600 dark:text-gray-300 mb-8">
                <p class="mb-4">Langkah selanjutnya menyelesaikan biaya pendaftaran melalui transfer bank sebesar
                    <span class="font-bold">{{ getFeeRegistration(auth()->user()->robot_category) }}</span> ke rekening berikut :
                </p>
                <table>
                    <tr>
                        <td>Bank</td>
                        <td>:</td>
                        <td class="font-medium">{{ config('lerin.bank.name') }}</td>
                    </tr>
                    <tr>
                        <td>No. Rekening</td>
                        <td>:</td>
                        <td class="font-medium">{{ config('lerin.bank.account_number') }}</td>
                    </tr>
                    <tr>
                        <td>Atas Nama</td>
                        <td>:</td>
                        <td class="font-medium">{{ config('lerin.bank.account_name') }}</td>
                    </tr>
                </table>
            </div>
            <div class="text-gray-600 dark:text-gray-300 mb-8">
                <p class="mb-4">Setelah melakukan transfer, silahkan upload bukti transfer melalui tombol di bawah ini.</p>

                <x-filament::link href="/panel/payments/{{ auth()->user()->payment->id }}/upload" class="underline">
                    Upload bukti pembayaran
                </x-filament::link>
            </div>
            <p class="text-gray-600 dark:text-gray-300 mb-8">
                Jika sudah melakukan transfer, silahkan tunggu admin untuk melakukan konfirmasi pada pembayaran anda.
            </p>
            @endif
            <x-admin-contact />
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
