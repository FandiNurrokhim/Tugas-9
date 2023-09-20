<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KonversiRomawi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function export()
    {
        // Load PHPSpreadsheet library
        $this->load->library('phpspreadsheet');

        // Ambil data mahasiswa dari model atau database
        $dataMahasiswa = $this->Mahasiswa_model->getMahasiswa();

        // Buat objek Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nama Mahasiswa');
        $sheet->setCellValue('B1', 'Fakultas');
        $sheet->setCellValue('C1', 'Prodi');
        $sheet->setCellValue('D1', 'No Telepon');
        $sheet->setCellValue('E1', 'Jenis Kelamin');
        $sheet->setCellValue('F1', 'Alamat');
        $sheet->setCellValue('G1', 'Tanggal Lahir');

        // Isi data mahasiswa ke dalam Spreadsheet
        $row = 2;
        foreach ($dataMahasiswa as $mahasiswa) {
            $sheet->setCellValue('A' . $row, $mahasiswa->nama);
            $sheet->setCellValue('B' . $row, $mahasiswa->fakultas);
            $sheet->setCellValue('C' . $row, $mahasiswa->prodi);
            $sheet->setCellValue('D' . $row, $mahasiswa->no_telpon);
            $sheet->setCellValue('E' . $row, $mahasiswa->jenis_kelamin);
            $sheet->setCellValue('F' . $row, $mahasiswa->alamat);
            $sheet->setCellValue('G' . $row, $mahasiswa->tanggal_lahir);
            $row++;
        }

        // Set header untuk ekspor Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_mahasiswa.xlsx"');
        header('Cache-Control: max-age=0');

        // Ekspor Spreadsheet ke Excel
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }


    public function import()
    {
        // Load PHPSpreadsheet library
        $this->load->library('phpspreadsheet');

        // Cek apakah file upload tersedia
        if (!empty($_FILES['file']['name'])) {
            $config['upload_path'] = './uploads/'; // Direktori untuk menyimpan file yang diunggah
            $config['allowed_types'] = 'xlsx'; // Format file yang diizinkan
            $config['max_size'] = 1024; // Ukuran maksimal file (dalam kilobita)

            $this->load->library('upload', $config);

            // Cek apakah proses unggah berhasil
            if ($this->upload->do_upload('file')) {
                $fileData = $this->upload->data();
                $filePath = './uploads/' . $fileData['file_name'];

                // Baca file Excel
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();
                $data = $worksheet->toArray(null, true, true, true);

                // Validasi dan simpan data ke database
                foreach ($data as $row) {
                    $nama = $row['A'];
                    $fakultas = $row['B'];
                    $prodi = $row['C'];
                    $no_telpon = $row['D'];
                    $jenis_kelamin = $row['E'];
                    $alamat = $row['F'];
                    $tanggal_lahir = $row['G'];

                    // Lakukan validasi data di sini
                    $errors = [];

                    // Validasi Format Tanggal Lahir
                    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal_lahir)) {
                        $errors[] = "Format tanggal lahir tidak sesuai (YYYY-MM-DD)";
                    }

                    // Validasi Jenis Kelamin
                    if ($jenis_kelamin !== 'Laki-laki' && $jenis_kelamin !== 'Perempuan') {
                        $errors[] = "Jenis kelamin tidak sesuai";
                    }

                    // Validasi Nomor Telepon
                    if (!ctype_digit($no_telpon)) {
                        $errors[] = "Nomor telepon hanya boleh berisi angka";
                    }

                    // Validasi Fakultas dan Prodi
                    $validFakultas = ['Fakultas A', 'Fakultas B', 'Fakultas C'];
                    $validProdi = ['Prodi X', 'Prodi Y', 'Prodi Z'];

                    if (!in_array($fakultas, $validFakultas) || !in_array($prodi, $validProdi)) {
                        $errors[] = "Fakultas atau prodi tidak valid";
                    }

                    // Validasi Nama dan Alamat
                    if (strlen($nama) < 3 || strlen($nama) > 255) {
                        $errors[] = "Nama harus memiliki panjang antara 3 hingga 255 karakter";
                    }

                    if (strlen($alamat) < 5 || strlen($alamat) > 255) {
                        $errors[] = "Alamat harus memiliki panjang antara 5 hingga 255 karakter";
                    }

                    // Jika tidak ada kesalahan validasi, simpan data ke database
                    if (empty($errors)) {
                        // Simpan data ke database (gunakan model)
                        $this->Mahasiswa_model->simpanData($nama, $fakultas, $prodi, $no_telpon, $jenis_kelamin, $alamat, $tanggal_lahir);
                    } else {
                        // Tangani kesalahan validasi, misalnya dengan memasukkan ke dalam array kesalahan
                        // untuk umpan balik kepada pengguna
                        // $errors berisi pesan-pesan kesalahan
                    }
                }

                // Hapus file yang diunggah
                unlink($filePath);

                // Redirect ke halaman yang sesuai
                redirect('mahasiswa');
            } else {
                // Kesalahan saat mengunggah file
                $error = $this->upload->display_errors();
                echo $error;
            }
        }
    }

}