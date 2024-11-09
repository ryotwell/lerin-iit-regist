<?php

if (! function_exists('getFeeRegistration'))
{
    function getFeeRegistration(string $name)
    {
        // 
    }
}

if (! function_exists('getPaymentStatus'))
{
    function getPaymentStatus(string $payment): string
    {
        if ( $payment === 'pending' ) {
            return 'Menunggu Pembayaran';
        }

        if ( $payment === 'approved' ) {
            return 'Pembayaran Diterima';
        }

        return 'Pembayaran Ditolak';
    }
}

if (! function_exists('getPaymentMethod'))
{
    function getPaymentMethod(string|null $method): string|null
    {
        if ( $method === 'bank_transfer' ) {
            return 'Bank Transfer';
        }

        if ( $method === 'cash' ) {
            return 'Cash';
        }

        return '-';
    }
}

if (! function_exists('getCategoryName'))
{
    function getCategoryName(string $category): string
    {
        if ( $category == 'sumo' ) {
            return 'Game Sumo';
        }

        if ( $category == 'avoider' ) {
            return 'Avoider (Obstacle)';
        }

        return 'unknow';
    }
}