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
        $ujian =  $this->belongsTo(Ujian::class,'ujian_id','id');
        $ujian->with('kelas');
        $ujian->with('mapel');
        $ujian->with('kelompok_ujian');

        return $ujian;
    }

    public function sesi_soal()
    {
        return $this->hasMany(Sesi_Soal::class, 'sesi_ujian_id', 'id');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'nomor_peserta', 'nomor_peserta');
    }
}
