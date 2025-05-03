<?php

namespace App\Http\Controllers\v1\SubmitUjian;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Soal;
use App\Models\Sesi_Soal;

class UjianController extends Controller
{
    //
    public function submitUjian(Request $request){
        try{
            $request->validate([
                'data' => 'required|array',
                'data.*' => 'required|array',
                'data.*.ujian_id' => 'required|integer',
                'data.*.nomor_peserta' => 'required|string',
                'data.*.soal_id' => 'required|integer',
            ]);
            $bodyData = [];
            if($request->has('data')){
                $bodyData = $request->data;
            }
            if(count($bodyData) > 0){
                foreach($bodyData as $data){
                    $checkSesiSoal = Sesi_Soal::where('ujian_id', $data['ujian_id'])
                        ->where('nomor_peserta', $data['nomor_peserta'])
                        ->where('soal_id', $data['soal_id'])
                        // ->where('tipe_soal', $data['tipe_soal'])
                        ->first();
                
                    if($checkSesiSoal){
                        $checkSesiSoal->update([
                            'jawaban' => $data['jawaban'],
                            'tipe_soal' => $data['tipe_soal'] ?? $checkSesiSoal->tipe_soal,
                        ]);
                    }else{
                        Sesi_Soal::create([
                            'ujian_id' => $data['ujian_id'],
                            'nomor_peserta' => $data['nomor_peserta'],
                            'soal_id' => $data['soal_id'],
                            'tipe_soal' => $data['tipe_soal'],
                            'jawaban' => $data['jawaban'],
                        ]);
                    }
                }
            }else{
                return response()->json(['error' => 'Data not found'], 404);
            }
            return response()->json(['msg'=>"Data Has Been Successfully inserted"],201);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }
}