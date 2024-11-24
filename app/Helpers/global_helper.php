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
