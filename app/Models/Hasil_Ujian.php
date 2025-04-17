<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil_Ujian extends Model
{
    //
    protected $table = "hasil__ujians";
    protected $fillable = ["nomor_peserta", "ujian_id", "soal_id", "sesi_soal_id",'tipe_soal',"jawaban_soal","jawaban_sesi", "isTrue"];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'nomor_peserta', 'nomor_peserta');
    }
}
