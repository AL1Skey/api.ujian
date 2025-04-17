<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    //
    protected $table = 'ujians';
<<<<<<< HEAD
    protected $fillable = ['id','kelompok_id','mapel_id','kelas_id','nama','id_sekolah','start_date','end_date','duration','status'];
=======
    protected $fillable = ['kelompok_id','mapel_id','kelas_id','nama','id_sekolah','start_date','end_date','duration','status'];
>>>>>>> f6925f0209e602d33cfce465645b0879fee9227d

    public function kelompok_ujian()
    {
        return $this->belongsTo('App\Models\Kelompok_Ujian','kelompok_id');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel','mapel_id');
    }

    public function sesi_ujian()
    {
        $data= $this->hasMany('App\Models\Sesi_Ujian','ujian_id');
        $data->with('sesi_soal');
        return $data;   
    }


    public function soal()
    {
        return $this->hasMany('App\Models\Soal','ujian_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Daftar_Kelas','kelas_id');
    }
    
}
