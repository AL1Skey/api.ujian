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
<<<<<<< HEAD
    public function submitUjian(Request $request){
        try{
            $request->validate([
                'data' => 'required|array',
                'data.*' => 'required|array',
                'data.*.ujian_id' => 'required|integer',
                'data.*.nomor_peserta' => 'required|string',
                'data.*.soal_id' => 'required|integer',
=======
    /**
     * @api {post} /api/v1/submit-ujian Submit Ujian
     * @apiName SubmitUjian
     * @apiGroup Ujian
     * @apiVersion 1.0.0
     *
     * @apiDescription This endpoint is used to submit answers for a specific exam session.
     *
     * @apiParam {Array} data Array of answer objects.
     * @apiParam {Object} data.* Individual answer object.
     * @apiParam {Integer} data.*.ujian_id ID of the exam.
     * @apiParam {String} data.*.nomor_peserta Participant number.
     * @apiParam {Integer} data.*.soal_id ID of the question.
     * @apiParam {String} data.*.tipe_soal Type of the question.
     * @apiParam {String} data.*.jawaban Answer provided by the participant.
     *
     * @apiSuccess {String} message Success message.
     *
     * @apiError {String} error Error message.
     *
     * @apiErrorExample {json} Validation Error:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "The data field is required."
     *     }
     *
     * @apiErrorExample {json} Data Not Found:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "Data not found"
     *     }
     *
     * @apiErrorExample {json} Server Error:
     *     HTTP/1.1 400 Bad Request
     *     {
     *       "error": "An error message describing the issue."
     *     }
     */
    public function submitUjian(Request $request){
        try{
            $request->validate([
            'data' => 'required|array',
            'data.*' => 'required|object',
            'data.*.ujian_id' => 'required|integer',
            'data.*.nomor_peserta' => 'required|string',
            'data.*.soal_id' => 'required|integer',
>>>>>>> f6925f0209e602d33cfce465645b0879fee9227d
            ]);
            $bodyData = [];
            if($request->has('data')){
                $bodyData = $request->data;
            }
            if(count($bodyData) > 0){
                foreach($bodyData as $data){
<<<<<<< HEAD
                    $checkSesiSoal = Sesi_Soal::where('ujian_id', $data['ujian_id'])
                        ->where('nomor_peserta', $data['nomor_peserta'])
                        ->where('soal_id', $data['soal_id'])
                        ->where('tipe_soal', $data['tipe_soal'])
                        ->first();
                
                    if($checkSesiSoal){
                        $checkSesiSoal->update([
                            'jawaban' => $data['jawaban'],
                        ]);
                    }else{
                        Sesi_Soal::create([
                            'ujian_id' => $data['ujian_id'],
                            'nomor_peserta' => $data['nomor_peserta'],
                            'soal_id' => $data['soal_id'],
                            'tipe_soal' => $data['tipe_soal'],
                            'jawaban' => $data['jawaban'],
                        ]);
=======
                    $checkSesiSoal = Sesi_Soal::where('ujian_id', $data->ujian_id)
                        ->where('nomor_peserta', $data->nomor_peserta)
                        ->where('soal_id', $data->soal_id)
                        ->where('tipe_soal', $data->tipe_soal)
                        ->first();
                    if($checkSesiSoal){
                        $checkSesiSoal->update([
                            'jawaban' => $data->jawaban,
                        ]);
                    }else{
                    Sesi_Soal::create([
                        'ujian_id' => $data->ujian_id,
                        'nomor_peserta' => $data->nomor_peserta,
                        'soal_id' => $data->soal_id,
                        'tipe_soal' => $data->tipe_soal,
                        'jawaban' => $data->jawaban,
                    ]);
>>>>>>> f6925f0209e602d33cfce465645b0879fee9227d
                    }
                }
            }else{
                return response()->json(['error' => 'Data not found'], 404);
            }
<<<<<<< HEAD
            return response()->json(['msg'=>"Data Has Been Successfully inserted"],201);
=======
>>>>>>> f6925f0209e602d33cfce465645b0879fee9227d
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }
}