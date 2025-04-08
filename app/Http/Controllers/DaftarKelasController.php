<?php

namespace App\Http\Controllers;

use App\Models\Daftar_Kelas;
use Illuminate\Http\Request;

class DaftarKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $kelas = Daftar_Kelas::query();
        $per_page = $request->query("limit") ?? 10;
        if ($request->query('nama')) {
            $kelas->where('nama', 'like', '%' . $request->query('nama') . '%');
        }
        return response()->json($kelas->paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //
            $request->validate([
                'nama' => 'required|string',
            ]);
            $data = $this->handleRequest($request);
            $kelas = Daftar_Kelas::create($data);
            return response()->json($kelas, 201);
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
            $kelas = Daftar_Kelas::find($id);
            if ($kelas) {
                return response()->json($kelas);
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
            ]);
            $data = $this->handleRequest($request);
            $kelas = Daftar_Kelas::find($id);
            if ($kelas) {
                $kelas->update($data);
                return response()->json($kelas);
            }
            return response()->json(['message' => 'Data not found'], 404);
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
            $kelas = Daftar_Kelas::find($id);
            if ($kelas) {
                $kelas->delete();
                return response()->json(['message' => 'Data deleted']);
            }
            return response()->json(['message' => 'Data not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }
}
