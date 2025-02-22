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
            if ($request->query('search')) {
                $soal->where('nama', 'like', '%' . $request->query('search') . '%');
            }
            $soal->with('sesi_ujian');
            $soal->with('soal');
            $soal->with('peserta');
            return response()->json($soal->paginate(10));
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
                'sesi_ujian_id' => 'required|integer',
                'soal_id' => 'required|integer',
                'peserta_id' => 'required|integer',
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
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $soal = Sesi_Soal::findOrFail($id);
            $soal->load('sesi_ujian');
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
                'sesi_ujian_id' => 'integer',
                'soal_id' => 'integer',
                'peserta_id' => 'integer',
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
