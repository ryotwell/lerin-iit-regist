@php

$approved = auth()->user()->payment->status === 'approved';

@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex justify-between mb-6">
            <div class="font-bold">
                Status Pendaftaran
            </div>
            <div>
                @if ($approved)
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                    {{ Str::ucfirst(auth()->user()->payment->status) }}
                </span>
                @else
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                    {{ Str::ucfirst(auth()->user()->payment->status) }}
                </span>
                @endif
            </div>
        </div>
        <div class="mb-6">
            
        </div>
        <div>
            <div class="text-gray-600 mb-8">
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
            <div class="text-gray-600 mb-8">
                <p class="mb-4">Setelah melakukan pembayaran, silahkan upload bukti pembayaran melalui tombol di bawah ini.</p>

                <a href="/panel/payments/{{ auth()->user()->payment->id }}/upload" class="bg-slate-900 dark:bg-slate-300 dark:text-slate-950 text-white px-4 py-2 rounded-xl hover:shadow-xl duration-100">
                    Upload bukti pembayaran
                </a>
            </div>
            <p class="text-gray-600 mb-8">
                Jika anda sudah melakukan pembayaran, silahkan tunggu admin untuk melakukan konfirmasi pada pembayaran anda.
            </p>
            <x-admin-contact />
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
