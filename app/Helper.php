<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

function satuan()
{
    return [
        'Gram' => 'Gram',
        'Kg' => 'Kg',
        'Pcs' => 'Pcs',
        'Pack' => 'Pack',
        'Bottle' => 'Bottle',
        'Box' => 'Box'
    ];
}

function kategori()
{
    return [
        'Meat' => 'Meat (Daging)',
        'Diaries' => 'Diaries (Produk Peternakan)',
        'Produce' => 'Produce (Produk Pertanian)',
        'Groceries' => 'Groceries (Barang Gudang Kering)',
        'Condiment' => 'Condiment (Bumbu & Rempah)',
        'Beverage' => 'Beverage (Minuman)',
        'Packaging' => 'Packaging (kemasan)',
    ];
}

function periodes($key = null)
{
    $start_year = 2023;
    $end_year = date('Y');
    $periodes = [];
    for ($i = $start_year; $i <= $end_year; $i++) {
        $periodes[$i . '01'] = $i . ' - Januari';
        $periodes[$i . '02'] = $i . ' - Februari';
        $periodes[$i . '03'] = $i . ' - Maret';
        $periodes[$i . '04'] = $i . ' - April';
        $periodes[$i . '05'] = $i . ' - Mei';
        $periodes[$i . '06'] = $i . ' - Juni';
        $periodes[$i . '07'] = $i . ' - Juli';
        $periodes[$i . '08'] = $i . ' - Agustus';
        $periodes[$i . '09'] = $i . ' - September';
        $periodes[$i . '10'] = $i . ' - Oktober';
        $periodes[$i . '11'] = $i . ' - November';
        $periodes[$i . '12'] = $i . ' - Desember';
    }
    if ($key)
        return $periodes[$key];
    return $periodes;
}


function uptdrs()
{
    return [
        '100410000000' => 'UPTD RUMAH SAKIT JIWA',
        '100414000000' => 'UPTD RUMAH SAKIT UMUM DAERAH JAMPANG KULON SUKABUMI',
        '100407000000' => 'UPTD LABORATORIUM KESEHATAN',
        '100408000000' => 'UPTD RUMAH SAKIT UMUM DAERAH KESEHATAN KERJA',
        '100406000000' => 'UPTD PELATIHAN KESEHATAN',
        '100411000000' => 'UPTD RUMAH SAKIT UMUM DAERAH AL-IHSAN',
        '100413000000' => 'UPTD RUMAH SAKIT PARU',
        '100412000000' => 'UPTD RUMAH SAKIT UMUM DAERAH PAMEUNGPEUK GARUT',
    ];
}

function biros()
{
    return [
        '100101010000',
        '100101020000',
        '100101030000',
        '100102010000',
        '100102020000',
        '100102030000',
        '100103010000',
        '100103020000',
        '100103030000',
    ];
}

function kcds()
{
    return [
        '100321000000',
        '100322000000',
        '100323000000',
        '100324000000',
        '100325000000',
        '100326000000',
        '100327000000',
        '100328000000',
        '100329000000',
        '100330000000',
        '100331000000',
        '100332000000',
        '100333000000',
    ];
}

function fdate($date)
{
    // setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
    // return strftime('%d %B %Y', strtotime($date));
    return date('d', strtotime($date)) . ' ' . months(date('m', strtotime($date))) . ' ' . date('Y', strtotime($date));
}

function months($month = null)
{
    $months = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];
    return $month ? $months[$month] : $months;
}

function bulan($month = null)
{
    $months = [
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];
    return $month ? $months[$month] : $months;
}

function days($day = null)
{
    $days = [
        '1' => "Senin",
        '2' => "Selasa",
        '3' => "Rabu",
        '4' => "Kamis",
        '5' => "Jum'at",
        '6' => "Sabtu",
        '7' => "Minggu",
    ];
    return $day ? $days[$day] : $days;
}

