<?php

if (! function_exists('getFeeRegistration'))
{
    function getFeeRegistration(string $name): string
    {
        return match($name) {
            'avoider' => 'Rp. 50.000',
            'sumo' => 'Rp. 75.000',
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
            'sumo' => 'Game Sumo',
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

if( ! function_exists('getWhatsappMessage'))
{
    function getWhatsappMessage(string | null $robot_category, string $whatsapp): string
    {
        $category_label = getCategoryName($robot_category);
        $grub_link = getParticipantWhatsappURL($robot_category);

        $text = "Kami dari panitia Robotic Competition ingin mengonfirmasi bahwa pembayaran Anda telah kami terima. 🙏

Silakan bergabung ke grup WhatsApp kategori {$category_label}. Berikut adalah tautannya:
{$grub_link}

Jika ada pertanyaan, jangan ragu untuk menghubungi kami.
Sampai jumpa di kompetisi! 🚀";

        return "https://wa.me/send?phone={$whatsapp}&text={$text}";
    }
}