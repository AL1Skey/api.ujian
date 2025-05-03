<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi_Ujian extends Model
{
    //
    protected $table = 'sesi__ujians';
    protected $fillable = ['id','ujian_id','nomor_peserta','start_date','end_date','isTrue'];

    public function ujian()
    {
        $ujian =  $this->belongsTo(Ujian::class,'ujian_id','id');
        $ujian->with('kelas');
        $ujian->with('mapel');
        $ujian->with('kelompok_ujian');

        return $ujian;
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'nomor_peserta', 'nomor_peserta');
    }
}
