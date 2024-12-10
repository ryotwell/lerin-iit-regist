<?php

use Illuminate\Support\Facades\Log;

if (! function_exists('getFeeRegistration'))
{
    function getFeeRegistration(string $name, ?string $agency): string
    {
        $isUniversitasHamzanwadi = isHamzanwadiStudent($agency);
        
        return match($name) {
            'avoider' => 'Rp. 50.000',
            'sumo' => $isUniversitasHamzanwadi ? 'Rp. 50.000' : 'Rp. 75.000',
            default => 'Rp. -'
        };
    }
}

if (! function_exists('getPaymentStatus'))
{
    function getPaymentStatus(string $payment): string
    {
        $payment_status = config('lerin.payment_status');
        return $payment_status[$payment] ?? '-';
    }
}

if (! function_exists('getPaymentMethod'))
{
    function getPaymentMethod(?string $method): ?string
    {
        $payment_methods = config('lerin.payment_methods');

        return $payment_methods[$method] ?? '-';
    }
}

if (! function_exists('getCategoryName'))
{
    function getCategoryName(string $category): string
    {
        return match($category) {
            'sumo' => 'Sumo Game',
            'avoider' => 'Avoider (obstacle)',
            default => 'unknown'
        };
    }
}

if (! function_exists('getParticipantLabel'))
{
    function getParticipantLabel(string | null $robot_category): string
    {
        return match($robot_category) {
            'sumo' => 'Ketua Tim',
            'avoider' => 'Penanggung Jawab Tim',
            default => 'unknown'
        };
    }
}

if (! function_exists('getParticipantIdentifierLabel'))
{
    function getParticipantIdentifierLabel(string | null $robot_category): string
    {
        return match ($robot_category) {
            'sumo' => 'NIM (Nomor Induk Mahasiswa)',
            'avoider' => 'NIS (Nomor Induk Siswa)',
            default => '',
        };
    }
}

if (! function_exists('getParticipantWhatsappURL'))
{
    function getParticipantWhatsappURL(string | null $robot_category): string
    {
        return match ($robot_category) {
            'sumo' => config('lerin.whatsapp_groups.sumo'),
            'avoider' => config('lerin.whatsapp_groups.avoider'),
            default => '-',
        };
    }
}

if(! function_exists('getPaymentApprovedMessage'))
{
    function getPaymentApprovedMessage(string | null $robot_category, string $whatsapp): string
    {
        $category_label = getCategoryName($robot_category);
        $grub_link = getParticipantWhatsappURL($robot_category);
        $greeting = getGreeting();
        $greetingLabel = getGreetingLabel($robot_category);

        $text = "{$greeting} {$greetingLabel}, kami dari panitia Robotic Competition ingin mengonfirmasi bahwa pembayaran Anda telah kami terima. 🙏

Silakan bergabung ke grup WhatsApp kategori {$category_label}. Berikut adalah tautannya:
{$grub_link}

Jika ada pertanyaan, jangan ragu untuk menghubungi kami.
Sampai jumpa di kompetisi! 🚀";

        return toWhatsappLink($whatsapp, $text);
    }
}

if(! function_exists('getPaymentNotification') )
{
    function getPaymentNotification(string | null $robot_category, string $whatsapp): string
    {
        // $category_label = getCategoryName($robot_category);
        // $grub_link = getParticipantWhatsappURL($robot_category);
        $greeting = getGreeting();
        $greetingLabel = getGreetingLabel($robot_category);

        $text = "{$greeting} {$greetingLabel}, untuk menyelesaikan pendaftaran silahkan melakukan pembayaran sesuai nominal yang tertera pada dashboard. Pembayaran dapat dilakukan melalui transfer bank.

Jika sudah melakukan pembayaran, mohon untuk mengunggah bukti pembayaran pada form yang telah disediakan.

Jika kesulitan atau ada hal yang ingin ditanyakan, silahkan {$greetingLabel} kami siap membantu.

Terima kasih banyak 🙏";
        return toWhatsappLink($whatsapp, $text);
    }
}

if(! function_exists('isHamzanwadiStudent'))
{
    function isHamzanwadiStudent(string | null $agency): bool
    {
        if(!$agency) return false;

        $normalizedAgency = strtoupper(trim($agency));
        return str_contains($normalizedAgency, 'UNIVERSITAS HAMZANWADI');
    }
}

if(! function_exists('toWhatsappLink') )
{
    function toWhatsappLink(string $whatsapp, string | null $text = null): string
    {
        // if whatsapp start with 08, remove 08 and add 62
        if (str_starts_with($whatsapp, '08')) {
            $whatsapp = '62' . substr($whatsapp, 1);
        }

        $encoded_text = rawurlencode($text);

        return "https://api.whatsapp.com/send?phone={$whatsapp}&text={$encoded_text}";
    }
}

if (! function_exists('getGreeting') )
{
    function getGreeting(): string
    {
        $hour = (int) now()->format('H');

        return match(true) {
            $hour >= 0 && $hour < 12 => 'Selamat pagi',
            $hour >= 12 && $hour < 15 => 'Selamat siang',
            $hour >= 15 && $hour < 18 => 'Selamat sore',
            default => 'Selamat malam',
        };
    }
}

if (! function_exists('getGreetingLabel') )
{
    function getGreetingLabel(string | null $robot_category): string
    {
        return match ($robot_category) {
            'sumo' => 'kak',
            'avoider' => 'pak',
            default => 'kak',
        };
    }
}
if(! function_exists('getAgencyLogo'))
{
    function getAgencyLogo(string $agency): string | null
    {
        $normalizedAgency = strtoupper(trim($agency));
        
        $logos = [
            'UNIVERSITAS HAMZANWADI' => '/instansi/hamzanwadi.jpg',
            'UNIVERSITAS MATARAM' => '/instansi/mataram.png',
            'SMAIT TUNAS CENDEKIA MATARAM' => '/instansi/smaittunascendekiamataram.png',
            'SMPIT TUNAS CENDEKIA MATARAM' => '/instansi/smpittunascendekiamataram.png',
            'SMKN 2 KURIPAN' => '/instansi/smkn2kuripan.png',
            'SMKN 1 PRINGGABAYA' => '/instansi/smkn1pringgabaya.png',
            'SMK NEGERI 1 PRINGGABAYA' => '/instansi/smkn1pringgabaya.png'
        ];

        foreach ($logos as $name => $path) {
            if (str_contains($normalizedAgency, $name)) {
                return $path;
            }
        }

        return null;
    }}