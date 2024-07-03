<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_pangkat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasfoto','nip','jabatan','gol','pangkatakhir','pangkatdatang','ket'
    ];

    public function DPegawai()
    {
        return $this->belongsTo(data_pegawai::class, 'nip', 'id');
    }
}
