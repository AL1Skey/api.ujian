<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            $agama = Agama::query();
            $per_page = $request->query("limit") ?? 10;
            if ($request->query('search')) {
                $agama->where('nama', 'like', '%' . $request->query('search') . '%');
            }
            return response()->json($agama->paginate($per_page));
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
                'nama' => 'required',
            ]);

            $data = $this->handleRequest($request);
            $agama = Agama::create($data);
            return response()->json($agama, 201);
        } catch (\Exception $e) {
            dd("AAAAAAA");
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
            $agama = Agama::find($id);
            if (!$agama) {
                return response()->json(['error' => 'Data not found'], 404);
            }
            return response()->json($agama);
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
            // dd($request,"AAAAAAAA",$id);
            $request->validate([
                'nama' => 'required',
            ]);
            $agama = Agama::find($id);
            if (!$agama) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $data = $this->handleRequest($request);
            $agama->update($data);
            return response()->json($agama, 200);
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
            $agama = Agama::find($id);
            if (!$agama) {
                return response()->json(['error' => 'Data not found'], 404);
            }
            $agama->delete();
            return response()->json(['message' => 'Data deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


}
