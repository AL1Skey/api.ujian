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
            $per_page = $request->query("limit") ?? 100;
            $hasil->select('hasil__ujians.id','peserta.nama','hasil__ujians.nomor_peserta as nomor_peserta', 'ujian.id as ujian_id','soal.soal','soal.tipe_soal', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi', 'hasil__ujians.isTrue')
            ->join('soals as soal', 'hasil__ujians.soal_id', '=', 'soal.id')
            ->join('ujians as ujian','hasil__ujians.ujian_id','=','ujian.id')
            ->join('sesi__soals as sesi_soal', 'hasil__ujians.sesi_soal_id', '=', 'sesi_soal.id')
            ->join('pesertas as peserta', 'hasil__ujians.nomor_peserta', '=', 'peserta.nomor_peserta');
            
            //dd($request->query('nomor_peserta'));
            
            if ($request->query('nomor_peserta')) {
                $hasil->where('hasil__ujians.nomor_peserta', $request->query('nomor_peserta') );
            }
            if($request->query('ujian_id')){
                $hasil->where('hasil__ujians.ujian_id', $request->query('ujian_id'));
            }
    
            return response()->json($hasil->paginate($per_page));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }
    public function reevaluate(Request $request){
        try{
            $ujian = Ujian::query();
            $ujian->select('peserta.nomor_peserta', 'ujians.id as ujian_id', 'soal.id as soal_id','soal.tipe_soal as tipe_soal', 'sesi_soal.id as sesi_soal_id', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi')
                  ->join('soals as soal', 'ujians.id', '=', 'soal.ujian_id')
                  ->join('sesi__soals as sesi_soal', 'ujians.id', '=', 'sesi_soal.ujian_id')
                  ->join('pesertas as peserta', 'sesi_soal.nomor_peserta', '=', 'peserta.nomor_peserta')
                  ->chunk(1000000, function ($data) {
                     
                  foreach ($data as $item) {
                    $find = Hasil_Ujian::where('nomor_peserta', $item->nomor_peserta)->where('ujian_id', $item->ujian_id)->where('soal_id', $item->soal_id)->where('sesi_soal_id', $item->sesi_soal_id);
                    if($find->count() > 0 && $item->jawaban_soal != null && $item->tipe_soal == "pilihan_ganda"){
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
            
            $hasil_ujian = Hasil_Ujian::query();
            $hasil_ujian->select('nomor_peserta','ujian_id','soal_id','jawaban_soal','jawaban_sesi')
            ->chunk(10000,function($data){
                foreach ($data as $item) {
                    $find = Hasil_Ujian::where('nomor_peserta', $item->nomor_peserta)->where('ujian_id', $item->ujian_id)->where('soal_id', $item->soal_id)->where('sesi_soal_id', $item->sesi_soal_id);
                    if($find->count() > 0 && $item->jawaban_soal != null && $item->tipe_soal == "pilihan_ganda"){
                        $find->update([
                        'isTrue' => $item->jawaban_soal == $item->jawaban_sesi // or any default value
                        ]);
                    }
                }
            });
      
            return response()->json(["msg"=>"Reevaluate Successfully"],201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }

    public function migrate(){
        try{
            $ujian = Ujian::query();
            $ujian->select('peserta.nomor_peserta', 'ujians.id as ujian_id', 'soal.id as soal_id', 'sesi_soal.id as sesi_soal_id','soal.tipe_soal as tipe_soal', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi')
                  ->join('soals as soal', 'ujians.id', '=', 'soal.ujian_id')
                  //->join('sesi__ujians as sesi_ujian', 'Ujians.id', '=', 'sesi_ujian.ujian_id')
                  ->join('sesi__soals as sesi_soal', 'ujians.id', '=', 'sesi_soal.ujian_id')
                  ->join('pesertas as peserta', 'sesi_soal.nomor_peserta', '=', 'peserta.nomor_peserta')
                  ->chunk(100, function ($data) {
                  foreach ($data as $item) {
                    $find = Hasil_Ujian::where('nomor_peserta', $item->nomor_peserta)->where('ujian_id', $item->ujian_id)->where('soal_id', $item->soal_id)->where('sesi_soal_id', $item->sesi_soal_id);
                    if($find->count() == 0 && $item->jawaban_soal != null){
                      Hasil_Ujian::create([
                      'nomor_peserta' => $item->nomor_peserta,
                      'ujian_id' => $item->ujian_id,
                      'soal_id' => $item->soal_id,
                      'sesi_soal_id' => $item->sesi_soal_id,
                      'tipe_soal' => $item->tipe_soal,
                      'jawaban_soal' => $item->jawaban_soal,
                      'jawaban_sesi' => $item->jawaban_sesi,
                      'isTrue' => $item->jawaban_soal == $item->jawaban_sesi // or any default value
                      ]);
                    }
                  }
                  });
                  return response()->json(["msg"=>"Migrate Successfully"],201);
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
    public function show($id)
    {
        //
        try {
            $hasil = Hasil_Ujian::findOrFail($id);
            $hasil->load('ujian');
            $hasil->load('soal');
            $hasil->load('peserta');
            return response()->json($hasil);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        try{
            $data = $this->handleRequest($request);
            $hasil = Hasil_Ujian::findOrFail($id);
            $hasil->update($data);
            
            return response()->json(["msg"=>"Hasil Ujian Updated Successfully"]);
        }
        catch(Throwable $th){
            return response()->json($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hasil_Ujian $hasil_Ujian)
    {
        //
    }
}
