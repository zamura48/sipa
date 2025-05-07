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

function nama_hari_indo($hari)
{
    $namaHari = [
        'Sunday'    => 'Minggu',
        'Monday'    => 'Senin',
        'Tuesday'   => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday'  => 'Kamis',
        'Friday'    => 'Jumat',
        'Saturday'  => 'Sabtu',
    ];
    return isset($namaHari[$hari]) ? $namaHari[$hari] : '-';
}

function send_wa($nomor_telepon, $pesan)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $nomor_telepon,
            'message' => $pesan,
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: SXFmjVwddysHraNCcr7T' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
    }
    curl_close($curl);

    if (isset($error_msg)) {
        echo $error_msg;
    }
    echo $response;
}
