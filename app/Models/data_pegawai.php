<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasfoto','nip','nama','nohp','alamat'
    ];

    public function data_pangkat()
    {
         return $this->hasOne(data_pangkat::class, 'nip', 'nip');
    }
    public function data_berkala()
    {
         return $this->hasOne(data_berkala::class, 'nip', 'nip');
    }

}
