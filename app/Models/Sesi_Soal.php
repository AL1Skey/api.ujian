<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi_Soal extends Model
{
    //
    protected $table = 'sesi__soals';
    protected $fillable = ['id','ujian_id', 'nomor_peserta', 'soal_id', 'tipe_soal','jawaban'];

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
