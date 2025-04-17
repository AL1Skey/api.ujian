<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            $jurusan = Jurusan::query();
            $per_page = $request->query("limit") ?? 10;
            if ($request->query('search')) {
                $jurusan->where('nama', 'like', '%' . $request->query('search') . '%');
            }
            if ($request->query('jurusan_id')){
                $jurusan->where('id',$request->query('jurusan_id'));
            }
            return response()->json($jurusan->paginate($per_page));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
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
            ]);
            $data = $this->handleRequest($request);
            $jurusan = Jurusan::create($data);
            return response()->json($jurusan, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $jurusan = Jurusan::find($id);
            if ($jurusan) {
                return response()->json($jurusan);
            }
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
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
            $jurusan = Jurusan::find($id);
            if ($jurusan) {
                $jurusan->update($data);
                return response()->json($jurusan);
            }
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     **/
    public function destroy($id)
    {
        //
        try {
            $jurusan = Jurusan::find($id);
            if ($jurusan) {
                $jurusan->delete();
                return response()->json($jurusan);
            }
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
