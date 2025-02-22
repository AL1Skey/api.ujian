<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    //
    protected $table = 'ujians';
    protected $fillable = ['kelompok_id','mapel_id','kelas_id','nama','id_sekolah','start_date','end_date','status'];

    public function kelompok_ujian()
    {
        return $this->belongsTo('App\Models\Kelompok_Ujian','kelompok_id');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel','mapel_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas','kelas_id');
    }
    
}
