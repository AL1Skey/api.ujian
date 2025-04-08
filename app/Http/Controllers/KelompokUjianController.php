<?php

namespace App\Http\Controllers;

use App\Models\Kelompok_Ujian;
use Illuminate\Http\Request;

class KelompokUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            $per_page = $request->query("limit") ?? 10;
            $kelompok_ujian = Kelompok_Ujian::query();
            if ($request->query('search')) {
                $kelompok_ujian->where('nama', 'like', '%' . $request->query('search') . '%');
            }
            return response()->json($kelompok_ujian->paginate($per_page));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
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
                'nama' => 'required|string',
                'id_sekolah' => '',
                'start_date' => 'date',
                'end_date' => 'date',
            ]);
            $data = $this->handleRequest($request);
            $kelompok_ujian = Kelompok_Ujian::create($data);
            return response()->json($kelompok_ujian);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $kelompok_ujian = Kelompok_Ujian::find($id);
            if ($kelompok_ujian) {
                return response()->json($kelompok_ujian);
            }
            return response()->json(['message' => 'Data not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
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
                'nama' => 'required|string',
                'id_sekolah' => 'string',
                'start_date' => 'date',
                'end_date' => 'date',
            ]);
            $data = $this->handleRequest($request);
            $kelompok_ujian = Kelompok_Ujian::find($id);
            $kelompok_ujian->update($data);
            return response()->json($kelompok_ujian);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $kelompok_ujian = Kelompok_Ujian::find($id);
            if ($kelompok_ujian) {
                $kelompok_ujian->delete();
                return response()->json(['message' => 'Data deleted']);
            }
            return response()->json(['message' => 'Data not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
