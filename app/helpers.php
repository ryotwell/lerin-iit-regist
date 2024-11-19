<?php

if (! function_exists('getFeeRegistration'))
{
    function getFeeRegistration(string $name): string
    {
        return match($name) {
            'avoider' => 'Rp. 50.000',
            'sumo' => 'Rp. 75.000',
            default => 'Rp. 0'
        };
    }
}

if (! function_exists('getPaymentStatus'))
{
    function getPaymentStatus(string $payment): string
    {
        return match($payment) {
            'pending' => 'Menunggu Pembayaran',
            'approved' => 'Pembayaran Diterima',
            'review_status' => 'Menunggu Verifikasi',
            default => 'Pembayaran Ditolak'
        };
    }
}

if (! function_exists('getPaymentMethod'))
{
    function getPaymentMethod(?string $method): ?string
    {
        return match($method) {
            'bank_transfer' => 'Bank Transfer',
            'cash' => 'Cash',
            default => '-'
        };
    }
}

if (! function_exists('getCategoryName'))
{
    function getCategoryName(string $category): string
    {
        return match($category) {
            'sumo' => 'Game Sumo',
            'avoider' => 'Avoider (Obstacle)',
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