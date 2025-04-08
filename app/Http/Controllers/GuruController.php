<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            $guru = Guru::query();
            $per_page = $request->query("limit") ?? 10;
            if ($request->query('search')) {
                $guru->where('nama', 'like', '%' . $request->query('search') . '%');
            }
            $guru->with('mapel');
            return response()->json($guru->paginate($per_page));
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
                'username' => 'required|string',
                'password' => 'required|string',
                'nama' => 'required|string',
                'alamat' => 'string',
                'mapel_id' => 'integer',
                'is_active' => 'boolean',
                'agama_id' => 'integer',
            ]);
            $data = $this->handleRequest($request);
            $guru = Guru::create($data);
            return response()->json($guru, 201);
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
            $guru = Guru::findOrFail($id);
            $guru->load('mapel');
            return response()->json($guru);
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
                'username' => 'required|string',
                'password' => 'required|string',
                'nama' => 'required|string',
                'alamat' => 'string',
                'mapel_id' => 'integer',
                'is_active' => 'boolean',
                'agama_id' => 'integer',
            ]);
            $data = $this->handleRequest($request);
            $guru = Guru::find($id);
            $guru->update($data);
            return response()->json([
                'message' => 'Data updated',
                'data' => $guru
            ]);
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
            $guru = Guru::find($id);
            if ($guru) {
                $guru->delete();
                return response()->json([
                    'message' => 'Data deleted'
                ]);
            }
            return response()->json(['message' => 'Data not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
