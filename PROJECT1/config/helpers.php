<?php
/**
 * Helper tampilan NoteClass.
 * Dimuat otomatis lewat template/header.php.
 */

if (!function_exists('tanggal_id')) {
    function tanggal_id($date)
    {
        if (!$date || $date === '0000-00-00') {
            return '-';
        }

        $ts = strtotime($date);
        if ($ts === false) {
            return htmlspecialchars($date);
        }

        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        return date('d', $ts) . ' ' . $bulan[(int) date('n', $ts)] . ' ' . date('Y', $ts);
    }
}

if (!function_exists('deadline_badge')) {
    function deadline_badge($date)
    {
        if (!$date || $date === '0000-00-00') {
            return '<span class="badge badge-info">Tanpa deadline</span>';
        }

        $ts = strtotime($date);
        if ($ts === false) {
            return '<span class="badge badge-info">-</span>';
        }

        $today = strtotime(date('Y-m-d'));
        $diff = (int) round(($ts - $today) / 86400);

        if ($diff < 0) {
            return '<span class="badge badge-danger">Terlewat ' . abs($diff) . ' hari</span>';
        }
        if ($diff === 0) {
            return '<span class="badge badge-warning">Hari ini</span>';
        }
        if ($diff <= 3) {
            return '<span class="badge badge-warning">' . $diff . ' hari lagi</span>';
        }
        if ($diff <= 7) {
            return '<span class="badge badge-info">' . $diff . ' hari lagi</span>';
        }

        return '<span class="badge badge-success">' . $diff . ' hari lagi</span>';
    }
}

if (!function_exists('inisial_nama')) {
    function inisial_nama($nama)
    {
        $nama = trim((string) $nama);
        return $nama === '' ? 'U' : strtoupper(substr($nama, 0, 1));
    }
}
