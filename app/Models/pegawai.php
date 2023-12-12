<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{

    protected $table = 'pegawai';

    protected $fillable = [
        'Nip', 'nama', 'tanggal_Lahir','Nomor_Telepon','Email','Password',
    ];
}

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'Nip', 'nama', 'tanggal_Lahir','Nomor_Telepon','Email','Password',
    ];
}
?>