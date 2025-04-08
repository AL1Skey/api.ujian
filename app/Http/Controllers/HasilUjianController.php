<?php

namespace App\Http\Controllers;

use App\Models\Hasil_Ujian;
use App\Models\Soal;
use App\Models\Sesi_Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class HasilUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            //code...
            $hasil = Hasil_Ujian::query();
            $per_page = $request->query("limit") ?? 10;
            $hasil->select('peserta.nama', 'ujian.id as ujian_id','soal.soal', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi', 'Hasil__Ujians.isTrue')
            ->join('Soals as soal', 'Hasil__Ujians.soal_id', '=', 'soal.id')
            ->join('Ujians as ujian','Hasil__Ujians.ujian_id','=','ujian.id')
            ->join('Sesi__Soals as sesi_soal', 'Hasil__Ujians.sesi_soal_id', '=', 'sesi_soal.id')
            ->join('Pesertas as peserta', 'Hasil__Ujians.nomor_peserta', '=', 'peserta.nomor_peserta');
    
            return response()->json($hasil->paginate($per_page));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }
    public function reevaluate(Request $request){
        try{
            $ujian = Ujian::query();
            $ujian->select('peserta.nomor_peserta', 'Ujians.id as ujian_id', 'soal.id as soal_id', 'sesi_soal.id as sesi_soal_id', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi')
                  ->join('Soals as soal', 'Ujians.id', '=', 'soal.ujian_id')
                  ->join('Sesi__Ujians as sesi_ujian', 'Ujians.id', '=', 'sesi_ujian.ujian_id')
                  ->join('Sesi__Soals as sesi_soal', 'sesi_ujian.id', '=', 'sesi_soal.sesi_ujian_id')
                  ->join('Pesertas as peserta', 'sesi_ujian.nomor_peserta', '=', 'peserta.nomor_peserta')
                  ->chunk(100, function ($data) {
                  foreach ($data as $item) {
                    $find = Hasil_Ujian::where('nomor_peserta', $item->nomor_peserta)->where('ujian_id', $item->ujian_id)->where('soal_id', $item->soal_id)->where('sesi_soal_id', $item->sesi_soal_id);
                    if($find->count() > 0 && $item->jawaban_soal != null){
                        $find->update([
                        'isTrue' => $item->jawaban_soal == $item->jawaban_sesi // or any default value
                        ]);
                    //   Hasil_Ujian::create([
                    //   'nomor_peserta' => $item->nomor_peserta,
                    //   'ujian_id' => $item->ujian_id,
                    //   'soal_id' => $item->soal_id,
                    //   'sesi_soal_id' => $item->sesi_soal_id,
                    //   'isTrue' => $item->jawaban_soal == $item->jawaban_sesi // or any default value
                    //   ]);
                    }
                  }
                  });
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    public function migrate(){
        try{
            $ujian = Ujian::query();
            $ujian->select('peserta.nomor_peserta', 'Ujians.id as ujian_id', 'soal.id as soal_id', 'sesi_soal.id as sesi_soal_id', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi')
                  ->join('Soals as soal', 'Ujians.id', '=', 'soal.ujian_id')
                  ->join('Sesi__Ujians as sesi_ujian', 'Ujians.id', '=', 'sesi_ujian.ujian_id')
                  ->join('Sesi__Soals as sesi_soal', 'sesi_ujian.id', '=', 'sesi_soal.sesi_ujian_id')
                  ->join('Pesertas as peserta', 'sesi_ujian.nomor_peserta', '=', 'peserta.nomor_peserta')
                  ->chunk(100, function ($data) {
                  foreach ($data as $item) {
                    $find = Hasil_Ujian::where('nomor_peserta', $item->nomor_peserta)->where('ujian_id', $item->ujian_id)->where('soal_id', $item->soal_id)->where('sesi_soal_id', $item->sesi_soal_id);
                    if($find->count() == 0 && $item->jawaban_soal != null){
                      Hasil_Ujian::create([
                      'nomor_peserta' => $item->nomor_peserta,
                      'ujian_id' => $item->ujian_id,
                      'soal_id' => $item->soal_id,
                      'sesi_soal_id' => $item->sesi_soal_id,
                      'isTrue' => $item->jawaban_soal == $item->jawaban_sesi // or any default value
                      ]);
                    }
                  }
                  });
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Hasil_Ujian $hasil_Ujian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hasil_Ujian $hasil_Ujian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hasil_Ujian $hasil_Ujian)
    {
        //
    }
}
