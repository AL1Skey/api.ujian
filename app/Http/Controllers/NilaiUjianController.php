<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ujian;
use App\Models\SesiSoal;
use App\Models\Peserta;    

class NilaiUjianController extends Controller{

    public function index()
    {
        $ujian = Ujian::query();
        // $ujian->with('sesi_ujian');
        // $ujian->with('mapel');
        // $ujian->with('kelompok_ujian');
        // // $ujian->with('sesi_soal');
        // $ujian->with('soal');
        // $ujian->groupBy('nomor_peserta','sesi_soal');
        $ujian->select('peserta.nama', 'soal.soal', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi')
              ->join('Soals as soal', 'Ujians.id', '=', 'soal.ujian_id')
              ->join('Sesi__Ujians as sesi_ujian','Ujians.id','=','sesi_ujian.ujian_id')
              ->join('Sesi__Soals as sesi_soal', 'sesi_ujian.id', '=', 'sesi_soal.sesi_ujian_id')
              ->join('Pesertas as peserta', 'sesi_ujian.nomor_peserta', '=', 'peserta.nomor_peserta');
        return response()->json($ujian->paginate(10));
    }

}