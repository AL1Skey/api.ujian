<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    //
    protected $table = 'soals';
    protected $fillable = ['ujian_id','soal','tipe_soal','pilihan_a','pilihan_b','pilihan_c','pilihan_d','pilihan_e','jawaban'];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
