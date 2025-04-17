<?php

namespace App\Http\Controllers;

use App\Models\Sesi_Soal;
use Illuminate\Http\Request;

class SesiSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            $soal = Sesi_Soal::query();
            if ($request->query('nomor_peserta')) {
                $soal->where('nomor_peserta',$request->query('nomor_peserta'));
            }
            if($request->query('ujian_id')){
                $soal->where('ujian_id', $request->query('ujian_id'));
            }
            $limit = $request->query('limit') ?? 100;
            $soal->with('ujian');
            $soal->with('soal');
            $soal->with('peserta');
            
            return response()->json($soal->paginate($limit));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'ujian_id' => 'required|integer',
                'soal_id' => 'required|integer',
                'nomor_peserta' => 'required|integer',
                'jawaban' => 'string',
            ]);
            $data = $this->handleRequest($request);
            $soal = Sesi_Soal::create($data);
            return response()->json($soal, 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function upstore(Request $request)
    {
        //
        try {
            $request->validate([
                'ujian_id' => 'required|integer',
                'soal_id' => 'required|integer',
                'nomor_peserta' => 'required|integer',
                'jawaban' => 'string',
            ]);
            $data = $this->handleRequest($request);
            $soalId = Sesi_Soal::query();
            $soalId = $soalId->where('ujian_id',$request->ujian_id)->where('soal_id',$request->soal_id)->where('nomor_peserta',$request->nomor_peserta);
            $soal = Sesi_Soal::create($data);
            return response()->json($soal, 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $soal = Sesi_Soal::findOrFail($id);
            $soal->load('ujian');
            $soal->load('soal');
            $soal->load('peserta');
            return response()->json($soal);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $request->validate([
                'ujian_id' => 'integer',
                'soal_id' => 'integer',
                'nomor_peserta' => 'integer',
                'jawaban' => 'string',
            ]);
            $data = $this->handleRequest($request);
            $soal = Sesi_Soal::findOrFail($id);
            $soal->update($data);
            return response()->json($soal, 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $soal = Sesi_Soal::findOrFail($id);
            $soal->delete();
            return response()->json($soal, 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
