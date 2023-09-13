<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Math_library
{
    public function penjumlahan($a, $b)
    {   
        try {
            if (is_int($a) && is_int($b)) {
                return $a + $b;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function pengurangan($a, $b)
    {
        try {
            if (is_int($a) && is_int($b)) {
                return $a - $b;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function perkalian($a, $b)
    {
        try {
            if (is_int($a) && is_int($b)) {
                return $a * $b;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function pembagian($a, $b)
    {
        try {
            if (is_int($a) && is_int($b)) {
                if ($b == 0) {
                    throw new Exception('Pembagian oleh nol tidak diizinkan.');
                }
                return $a / $b;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
