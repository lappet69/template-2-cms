<?php

use Carbon\Carbon;

if (!function_exists('valid_date')) {
    function valid_date($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) == $date) {
            return $d;
        }
        return null;
    }
}

if (!function_exists('indo_date')) {
    function indo_date($date)
    {
        if (valid_date($date, 'd/m/Y')) {
            $expl = explode('/', $date);
            return $expl[2] . '-' . $expl[1] . '-' . $expl[0];
        }
        return null;
    }
}

if (!function_exists('sqlindo_date')) {
    function sqlindo_date($date)
    {
        $d = valid_date($date, 'Y-m-d');
        if ($d) {
            return $d->format('d/m/Y');
        }
        return null;
    }
}

if (!function_exists('sqlindo_datetime_to_date')) {
    function sqlindo_datetime_to_date($datetime)
    {
        $d = valid_date($datetime, 'Y-m-d H:i:s');
        if ($d) {
            return $d->format('d/m/Y');
        }
        return null;
    }
}

if (!function_exists('sqlindo_datetime_to_time')) {
    function sqlindo_datetime_to_time($datetime)
    {
        $d = valid_date($datetime, 'Y-m-d H:i:s');
        if ($d) {
            return $d->format('H:i');
        }
        return null;
    }
}

if (!function_exists('sqlindo_datetime_to_datetime')) {
    function sqlindo_datetime_to_datetime($datetime)
    {
        $d = valid_date($datetime, 'Y-m-d H:i:s');
        if ($d) {
            return $d->format('d/m/Y H:i:s');
        }
        return null;
    }
}

if (!function_exists('tanggalDb')) {
    function tanggalDb($date)
    {
        $exp = explode('-', $date);
        $date = $exp[2] . '-' . $exp[1] . '-' . $exp[0];
        return $date;
    }
}

if (!function_exists('tanggal_lengkap')) {
    function tanggal_lengkap($tgl, $tampil_hari = false)
    {
        $nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        $nama_bulan = array(
            1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "November", "Desember"
        );
        $tahun = substr($tgl, 0, 4);
        $bulan = $nama_bulan[(int)substr($tgl, 5, 2)];
        $tanggal = substr($tgl, 8, 2);
        $text = "";
        if ($tampil_hari) {
            $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
            $hari = $nama_hari[$urutan_hari];
            $text .= $hari . ", ";
        }
        $text .= $tanggal . " " . $bulan . " " . $tahun;
        return $text;
    }
}

$banner_id = 0;

function setBannerId($id)
{
    return $banner_id = $id;
}
