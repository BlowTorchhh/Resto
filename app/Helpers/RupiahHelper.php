<?php

if (!function_exists('format_rupiah')) {
    function format_rupiah($uang)
    {
        return 'Rp. ' . number_format($uang, 0, ',', '.');
    }
}
?>