<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    //
    protected $table = 'soals';
    protected $fillable = ['ujian_id','soal','image','tipe_soal','pilihan_a','pilihan_b','pilihan_c','pilihan_d','pilihan_e','jawaban'];

    public function ujian()
    {
        $ujian =  $this->belongsTo(Ujian::class,'ujian_id','id');
        $ujian->with('kelas');
        $ujian->with('mapel');
        $ujian->with('kelompok_ujian');

        return $ujian;
    }


}
