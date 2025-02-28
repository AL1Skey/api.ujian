<?php

namespace App\Http\Controllers;

use App\Models\Sesi_Ujian;
use App\Models\Ujian;
use App\Models\Peserta;
use Illuminate\Http\Request;

class SesiUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try{
            $sesi_ujian = Sesi_Ujian::query();
            if($request->query("ujian")){
                $sesi_ujian->where("ujian_id", "like", "%" . $request->query("ujian") . "%");
            }
            if($request->query("peserta")){
                $sesi_ujian->where("nomor_peserta", "like", "%" . $request->query("peserta") . "%");
            }
            $sesi_ujian->with("ujian");
            
            $sesi_ujian->with("peserta");
            return response()->json($sesi_ujian->paginate(10));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $request->validate([
                "ujian_id" => "required",
                "nomor_peserta" => "required",
            ]);
            $data = $this->handleRequest($request);
            
            $check_ujian = Ujian::query()->find($request->ujian_id);
            if(!$check_ujian) {
                $data['ujian_id'] = null;
            }
            $check_peserta = Peserta::query()->where("nomor_peserta", $request->nomor_peserta)->first();
            if(!$check_peserta) {
                $data['nomor_peserta'] = null;
            }
            // dd($data);
            $sesi_ujian = Sesi_Ujian::create($data);
            return response()->json($sesi_ujian, 201);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try{
            $sesi_ujian = Sesi_Ujian::findOrFail($id);
            $sesi_ujian->load("ujian");
            $sesi_ujian->load("peserta");
            return response()->json($sesi_ujian);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $request->validate([
                "ujian_id" => "integer",
                "nomor_peserta" => "integer",
            ]);
            $data = $this->handleRequest($request);

            $check_ujian = Ujian::query()->find($request->ujian_id);
            if(!$check_ujian) {
                $data['ujian_id'] = null;
            }
            $check_peserta = Peserta::query()->where("nomor_peserta", $request->nomor_peserta)->first();
            if(!$check_peserta) {
                $data['nomor_peserta'] = null;
            }

            $sesi_ujian = Sesi_Ujian::findOrFail($id);
            $sesi_ujian->update($data);
            return response()->json($sesi_ujian);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try{
            $sesi_ujian = Sesi_Ujian::findOrFail($id);
            $sesi_ujian->delete();
            return response()->json($sesi_ujian);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }
}
