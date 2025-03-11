<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;
use App\Models\Ujian;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try{
            $soal = Soal::query();
            if($request->query("ujian")){
                $soal->where("ujian_id", "like", "%" . $request->query("ujian") . "%");
            }
            $soal->with("ujian");
            return response()->json($soal->paginate(100));
        }
        catch (\Exception $e) {
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
                "ujian_id" => "required|integer",
                "soal" => "required|string",
                "tipe_soal" => "required|string",
                "pilihan_a" => "string",
                "pilihan_b" => "string",
                "pilihan_c" => "string",
                "pilihan_d" => "string",
                "pilihan_e" => "string",
                "jawaban" => "string",
            ]);
            $data = $this->handleRequest($request);
            
            $check_ujian = Ujian::query()->find($request->ujian_id);
            if(!$check_ujian) {
                $data['ujian_id'] = null;
            }

            $soal = Soal::create($data);
            return response()->json($soal, 201);
        }
        catch (\Exception $e) {
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
            $soal = Soal::findOrFail($id);
            $soal->load("ujian");
            return response()->json($soal);
        }
        catch (\Exception $e) {
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
                // "soal" => "string",
                // "tipe_soal" => "string",
                // "pilihan_a" => "string",
                // "pilihan_b" => "string",
                // "pilihan_c" => "string",
                // "pilihan_d" => "string",
                // "pilihan_e" => "string",
                // "jawaban" => "string",
            ]);
            $data = $this->handleRequest($request);
            $soal = Soal::findOrFail($id);
            $soal->update($data);
            return response()->json($soal);
        }
        catch (\Exception $e) {
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
            $soal = Soal::findOrFail($id);
            $soal->delete();
            return response()->json($soal);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }
}
