<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelompok_Ujian extends Model
{
    //
    protected $table = 'kelompok__ujians';
    protected $fillable = ['nama','id_sekolah','start_date','end_date'];
}
