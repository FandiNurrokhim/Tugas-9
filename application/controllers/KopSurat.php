<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KopSurat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->database();
        $this->load->helper('url');
    }


    public function index()
    {
        $sql = "SELECT name, address, place_of_birth, date_birth FROM mahasiswa";
        $result = $this->db->query($sql);

        if ($result->num_rows() > 0) {
            $data           = $result->row();
            $nama           = strtoupper($data->name);
            $alamat         = strtoupper($data->address);
            $tempat_lahir   = strtoupper($data->place_of_birth);
            $tanggal_lahir  = strtoupper(date('d F Y', strtotime($data->date_birth)));
        } else {
            $nama = 'Data tidak ditemukan';
            $alamat = 'Data tidak ditemukan';
            $tanggal_lahir = 'Data tidak ditemukan';
        }

        $path = 'public/image/foto.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $dataSurat = [
            'nama'          => $nama,
            'alamat'        => $alamat,
            'tanggal_lahir' => $tanggal_lahir,
            'tempat_lahir'  => $tempat_lahir,
            'logo'          => $base64
        ];

        $size_paper = [0, 0, 640, 382];
        $this->pdf->set_paper($size_paper, 'portrait');
        $this->pdf->filename = "Data Mahasiswa.pdf";
        // $this->load->view('index', $dataSurat);
        $this->pdf->load_view('index', $dataSurat);
    }

}