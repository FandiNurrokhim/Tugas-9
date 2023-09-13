<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('romawi_to_int')) {
    function romawi_to_int($romawi) {
        $angkaRomawi = array(
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        );
        
        $hasil = 0;
        $prevValue = 0;
        for ($i = strlen($romawi) - 1; $i >= 0; $i--) {
            $currentValue = $angkaRomawi[$romawi[$i]];
            if ($currentValue < $prevValue) {
                $hasil -= $currentValue;
            } else {
                $hasil += $currentValue;
            }
            $prevValue = $currentValue;
        }
        return $hasil;
    }
}
