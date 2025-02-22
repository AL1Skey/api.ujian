<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi_Ujian extends Model
{
    //
    protected $table = 'sesi__ujians';
    protected $fillable = ['ujian_id','nomor_peserta'];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class,'ujian_id','id');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'nomor_peserta', 'nomor_peserta');
    }
}
