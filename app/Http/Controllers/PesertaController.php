<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try{
            $peserta = Peserta::query();
            if($request->query("search")){
                $peserta->where("nama", "like", "%" . $request->query("search") . "%");
            }
            $peserta->with("jurusan");
            $peserta->with("agama");
            $peserta->with("kelas");

            return response()->json($peserta->paginate(10));
        }
        catch(\Exception $e){
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
                "nama" => "required",
                // "nomor_peserta" => "required",
                "password" => "required",
                "alamat" => "string",
                "jurusan_id" => "integer",
                "agama_id" => "integer",
                "kelas_id" => "integer",
            ]);
            $data = $this->handleRequest($request);
            $peserta = Peserta::create($data);
            return response()->json($peserta, 201);
        }
        catch(\Exception $e){
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
            $peserta = Peserta::findOrFail($id);
            $peserta->load("jurusan");
            $peserta->load("agama");
            $peserta->load("kelas");
            return response()->json($peserta);
        }
        catch(\Exception $e){
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
