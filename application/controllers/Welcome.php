<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('my_helper');
    }

    public function index()
    {
        $this->load->library('math_library');

        $a = 1;
        $b = 2;

        try {
            $hasil_penjumlahan = $this->math_library->penjumlahan($a, $b);
            $hasil_pengurangan = $this->math_library->pengurangan($a, $b);
            $hasil_perkalian = $this->math_library->perkalian($a, $b);
            $hasil_pembagian = $this->math_library->pembagian($a, $b);

            $data['hasil_penjumlahan'] = $hasil_penjumlahan;
            $data['hasil_pengurangan'] = $hasil_pengurangan;
            $data['hasil_perkalian'] = $hasil_perkalian;
            $data['hasil_pembagian'] = $hasil_pembagian;

            $this->load->view('index', $data);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }
}
