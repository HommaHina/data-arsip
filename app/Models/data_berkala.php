<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_berkala extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip','jabatan','berkalaakhir','berkaladatang','ket'
    ];

    public function DPegawai()
    {
        return $this->belongsTo(data_pegawai::class, 'nip', 'nip');
    }
}
