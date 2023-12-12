<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'Nomor_rm', 'nama', 'Tanggal_Lahir','Nomor_Telepon','Alamat'
    ];
}
?>