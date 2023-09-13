<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KonversiTanggal extends CI_Controller
{
    public function index()
    {
        $this->load->library('tanggal_library');
        
        $tanggal_y_m_d = $this->tanggal_library->tanggal_sekarang_y_m_d(); 
        $tanggal_d_M_y = $this->tanggal_library->tanggal_sekarang_d_M_y();

        $data['tanggal_y_m_d'] = $tanggal_y_m_d;
        $data['tanggal_d_M_y'] = $tanggal_d_M_y;

        $this->load->view('index', $data);
    }
}