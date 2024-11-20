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