<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        //
        try {
            $ujian = Ujian::query();

            if ($request->query("id_sekolah")) {
                $ujian->where("id_sekolah", "like", "%" . $request->query("id_sekolah") . "%");
            }

            $ujian->with("kelompok_ujian");
            $ujian->with("mapel");
            $ujian->with("kelas");

            return response()->json($ujian->paginate(10));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'kelompok_id' => 'required|integer',
                'mapel_id' => 'required|integer',
                'kelas_id' => 'required|integer',
                'nama' => 'required|string',
                'id_sekolah' => 'required|integer',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'status' => 'required|string'
            ]);
            $data = $this->handleRequest($request);
            $ujian = Ujian::create($data);
            return response()->json($ujian, 201);
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
        try {
            $ujian = Ujian::query()->findOrFail($id);
            $ujian->load("kelompok_ujian");
            $ujian->load("mapel");
            $ujian->load("kelas");
            return response()->json($ujian);
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
        try {
            $ujian = Ujian::findOrFail($id);
            $request->validate([
                'kelompok_id' => 'integer',
                'mapel_id' => 'integer',
                'kelas_id' => 'integer',
                'nama' => 'string',
                'id_sekolah' => 'integer',
                'start_date' => 'date',
                'end_date' => 'date',
                'status' => 'string'
            ]);
            $data = $this->handleRequest($request);
            $ujian->fill($data);
            $ujian->save();
            return response()->json($ujian, 200);
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
        try {
            $ujian = Ujian::findOrFail($id);
            $ujian->delete();
            return response()->json($ujian, 200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }
}
