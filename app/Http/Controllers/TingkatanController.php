<?php

namespace App\Http\Controllers;

use App\Models\Tingkatan;
use Illuminate\Http\Request;

class TingkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $tingkatan = Tingkatan::query();
        $per_page = $request->query("limit") ?? 10;
        if ($request->query('nama')) {
            $tingkatan->where('nama', 'like', '%' . $request->query('nama') . '%');
        }
        return response()->json($tingkatan->paginate($per_page));
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
            $tingkatan = Tingkatan::create($data);
            return response()->json($tingkatan, 201);
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
            $tingkatan = Tingkatan::find($id);
            if ($tingkatan) {
                return response()->json($tingkatan);
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
            $tingkatan = Tingkatan::find($id);
            if ($tingkatan) {
                $tingkatan->update($data);
                return response()->json($tingkatan);
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
            $tingkatan = Tingkatan::find($id);
            if ($tingkatan) {
                $tingkatan->delete();
                return response()->json(['message' => 'Data deleted']);
            }
            return response()->json(['message' => 'Data not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }
}
