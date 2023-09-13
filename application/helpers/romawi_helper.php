<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('int_to_roman')) {
    function int_to_romawi($angka) {
        $angkaRomawi = array(
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        );
        
        $hasil = '';
        foreach ($angkaRomawi as $romawi => $value) {
            while ($angka >= $value) {
                $hasil .= $romawi;
                $angka -= $value;
            }
        }
        return $hasil;
    }
}
