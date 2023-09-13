<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('is_prime')) {
    function is_prime($number) {
        if ($number <= 1) {
            return false;
        }

        if ($number == 2) {
            return true;
        }

        if ($number % 2 == 0) {
            return false;
        }

        $sqrt = sqrt($number);
        for ($i = 3; $i <= $sqrt; $i += 2) {
            if ($number % $i == 0) {
                return false;
            }
        }

        return true;
    }
}
