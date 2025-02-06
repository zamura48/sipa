<?php

function format_currency($amount)
{
    return number_format($amount, 0, ',', '.');
}

function format_date($date)
{
    if (!$date) {
        return '-';
    }

    $date = explode('/', $date);

    return $date[2] . '-' . $date[1] . '-' . $date[0];
}

function format_date_w_bs($date)
{
    if (!$date) {
        return '-';
    }

    $date = explode('-', $date);

    return $date[2] . '/' . $date[1] . '/' . $date[0];
}

function current_modul()
{
    // Mendapatkan URI route saat ini
    $current_route = Route::current()->uri();

    // Memecah URI menjadi segment
    $segments = explode('/', $current_route);

    $modul = $segments[0];
    if ($segments[0] == 'wali_murid') {
        $modul = 'walmur';
    }

    return $modul;
}
