<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Daftar_Kelas extends Model
{
    //
    protected $table = 'daftar__kelas';
    protected $fillable = ['nama','tingkatan'];
}
