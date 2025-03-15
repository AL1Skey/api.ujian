<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil_Ujian extends Model
{
    //
    protected $table = "hasil__ujians";
    protected $fillable = ["nomor_peserta", "ujian_id", "soal_id", "sesi_soal_id", "isTrue"];

    
}
