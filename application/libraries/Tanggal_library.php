<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanggal_library {

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('calendar');
    }

    public function tanggal_sekarang_y_m_d()
    {
        return date('Y-m-d');
    }

    public function tanggal_sekarang_d_M_y()
    {
        $tanggal = getdate();

        return $this->CI->calendar->get_month_name($tanggal['mon']). ' ' . $tanggal['mday']. ', ' . $tanggal['year'];
    }
}