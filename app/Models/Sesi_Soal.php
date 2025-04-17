<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi_Soal extends Model
{
    //
    protected $table = 'sesi__soals';
<<<<<<< HEAD
    protected $fillable = ['id','ujian_id', 'nomor_peserta', 'soal_id', 'tipe_soal','jawaban'];
=======
    protected $fillable = ['ujian_id', 'nomor_peserta', 'soal_id', 'tipe_soal','jawaban'];
>>>>>>> f6925f0209e602d33cfce465645b0879fee9227d

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
