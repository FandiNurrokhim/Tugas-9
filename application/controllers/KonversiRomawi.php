<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KonversiRomawi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('romawi_helper');
        $this->load->helper('romawi-to-int_helper');
    }

    public function index()
    {
        $angka = 10;
        $angka_romawi = int_to_romawi($angka);

        $romawi = 'VII';
        $angka_kembali = romawi_to_int($romawi);

        $data = array(
            'angka' => $angka,
            'angka_romawi' => $angka_romawi,
            'romawi' => $romawi,
            'angka_kembali' => $angka_kembali
        );

        $this->load->view('index', $data);
    }
}

