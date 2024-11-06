<x-filament-widgets::widget>
    <x-filament::section>
        <div>
            @if (auth()->user()->payment->status === 'approved')
            <div class="text-gray-600 dark:text-gray-300 mb-8">
                <div class="mb-4">
                    Proses administrasi telah selesai dan di terima, masuk ke grub whatsapp di bawah untuk menunggu arahan dan informasi selengkapnya dari pihak panitia.
                </div>
                <div>
                    <a href="" class="text-sm underline text-blue-500 flex items-center">
                        Masuk ke grub whatsapp
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 lucide lucide-move-right"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
                    </a>
                </div>
            </div>
            @else
            <div class="text-gray-600 dark:text-gray-300 mb-8">
                <p class="mb-4">Langkah selanjutnya menyelesaikan biaya pendaftaran melalui transfer bank sebesar <span class="font-bold">Rp. 50.000</span> ke rekening berikut :</p>
                <table>
                    <tr>
                        <td>Bank</td>
                        <td>:</td>
                        <td class="font-medium">BRI</td>
                    </tr>
                    <tr>
                        <td>No. Rekening</td>
                        <td>:</td>
                        <td class="font-medium">92817212129</td>
                    </tr>
                    <tr>
                        <td>Atas Nama</td>
                        <td>:</td>
                        <td class="font-medium">Muhammad Farid Hidayat</td>
                    </tr>
                </table>
            </div>
            <div class="text-gray-600 dark:text-gray-300 mb-8">
                <p class="mb-4">Setelah melakukan pembayaran, silahkan upload bukti pembayaran melalui tombol di bawah ini.</p>

                <a href="/panel/payments/{{ auth()->user()->payment->id }}/upload" class="bg-slate-900 dark:bg-slate-300 dark:text-slate-950 text-white px-4 py-2 rounded-xl hover:shadow-xl duration-100">
                    Upload bukti pembayaran
                </a>
            </div>
            <p class="text-gray-600 dark:text-gray-300 mb-8">
                Jika anda sudah melakukan pembayaran, silahkan tunggu admin untuk melakukan konfirmasi pada pembayaran anda.
            </p>
            @endif
            <x-admin-contact />
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
