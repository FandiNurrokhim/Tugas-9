<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'fakultas', 'prodi', 'no_telpon', 'jenis_kelamin', 'alamat', 'tanggal_lahir'];
}
