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

function format_tanggal($date) {
    if ($date) {
        return rand(11111111, 99999999);
    }

    $format = date('Ymd', strtotime($date));

    return $format;
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

function datetime_indo($datetime)
{
    if (!$datetime) {
        return '-';
    }

    // Array nama hari dan bulan dalam Bahasa Indonesia
    $hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    // Membuat objek DateTime
    $date = new DateTime($datetime);

    // Mendapatkan nama hari dalam bahasa Indonesia
    $hariIndo = $hari[$date->format('l')];

    // Mendapatkan tanggal, bulan, dan tahun
    $tanggal = $date->format('d');
    $bulanIndo = $bulan[(int)$date->format('m')];
    $tahun = $date->format('Y');

    // Mendapatkan jam dan menit
    $jam = $date->format('H:i');

    // Format akhir
    $hasil = "$hariIndo, $tanggal $bulanIndo $tahun - $jam";

    return $hasil;
}

function date_indo($date)
{
    if (!$date) {
        return '-';
    }

    // Array nama hari dan bulan dalam Bahasa Indonesia
    $hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    // Membuat objek DateTime
    $date = new DateTime($date);

    // Mendapatkan nama hari dalam bahasa Indonesia
    $hariIndo = $hari[$date->format('l')];

    // Mendapatkan tanggal, bulan, dan tahun
    $tanggal = $date->format('d');
    $bulanIndo = $bulan[(int)$date->format('m')];
    $tahun = $date->format('Y');

    // Format akhir
    $hasil = "$tanggal $bulanIndo $tahun";

    return $hasil;
}
