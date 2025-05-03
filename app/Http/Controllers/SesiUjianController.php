<?php

namespace App\Http\Controllers;

use App\Models\Sesi_Ujian;
use App\Models\Ujian;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            if($request->query("ujian_id")){
                $sesi_ujian->where("ujian_id",  $request->query("ujian_id"));
            }
            if($request->query("nomor_peserta")){
                $sesi_ujian->where("nomor_peserta", $request->query("nomor_peserta"));
            }
            $sesi_ujian->with("ujian");
            
            $sesi_ujian->with("peserta");
            // Convert start_date and end_date to ISO format
            $sesi_ujian->get()->transform(function ($item) {
                $item->start_date = \Carbon\Carbon::parse($item->start_date)->toIso8601String();
                $item->end_date = \Carbon\Carbon::parse($item->end_date)->toIso8601String();
                return $item;
            });

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
                "duration" => "required",
            ]);
            $data = $this->handleRequest($request);
            $data['start_date'] = Carbon::now()->format('Y-m-d H:i:s');
            $data['end_date']   = Carbon::now()->addMinutes($request->input('duration'))->format('Y-m-d H:i:s');
            // dd($data);
            $check_ujian = Ujian::query()->find($request->ujian_id);
            if(!$check_ujian) {
                $data['ujian_id'] = null;
            }
            $check_peserta = Peserta::query()->where("nomor_peserta", $request->nomor_peserta)->first();
            if(!$check_peserta) {
                $data['nomor_peserta'] = null;
            }
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
                "isTrue" => "boolean",
            ]);
            $data = $this->handleRequest($request);

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
