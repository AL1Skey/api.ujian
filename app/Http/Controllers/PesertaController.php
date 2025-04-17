<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Jurusan;
use App\Models\Agama;
use App\Models\Daftar_Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            if($request->query("nomor_peserta")){
                $peserta->where("nomor_peserta", $request->query("nomor_peserta") );
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
                "nomor_peserta" => "required",
                "password" => "required",
                "alamat" => "string",
                "jurusan_id" => "integer",
                "agama_id" => "integer",
                "kelas_id" => "integer",
            ]);
            $data = $this->handleRequest($request);

            $checkJurusan = Jurusan::query()->find($request->jurusan_id);
            if(!$checkJurusan){
                $data['jurusan_id'] = null;
            }
            $checkAgama = Agama::query()->find($request->agama_id);
            if(!$checkAgama){
                $data['agama_id'] = null;
            }
            $checkKelas = Daftar_Kelas::query()->find($request->kelas_id);
            if(!$checkKelas){
                $data['kelas_id'] = null;
            }
            if($request->nomor_peserta){
                $nomor_peserta = $request->nomor_peserta;
                $check_peserta = Peserta::query()->where("nomor_peserta", $nomor_peserta)->first();
                
                if(!$check_peserta){
                    $data['nomor_peserta'] = $nomor_peserta;
                }
                else{
                    return response()->json(["error"=>"Nomor Peserta cannot be duplicated"]);
                }
            }
            else{
                while (True){
                $nomor_peserta = rand(100000, 999999);
                $check_peserta = Peserta::query()->where("nomor_peserta", $nomor_peserta)->first();
                if(!$check_peserta){
                    $data['nomor_peserta'] = $nomor_peserta;
                    break;
                    }
                }    
            }
            
            $data['password'] = Hash::make($data['password']);
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
        try {
            $request->validate([
                "nama" => "sometimes|required",
                "password" => "sometimes|required",
                "alamat" => "sometimes|string",
                "jurusan_id" => "sometimes|integer",
                "agama_id" => "sometimes|integer",
                "kelas_id" => "sometimes|integer",
            ]);
    
            $peserta = Peserta::findOrFail($id);
            $data = $this->handleRequest($request);
    
            $checkJurusan = Jurusan::query()->find($request->jurusan_id);
            if (!$checkJurusan) {
                $data['jurusan_id'] = null;
            }
            $checkAgama = Agama::query()->find($request->agama_id);
            if (!$checkAgama) {
                $data['agama_id'] = null;
            }
            $checkKelas = Daftar_Kelas::query()->find($request->kelas_id);
            if (!$checkKelas) {
                $data['kelas_id'] = null;
            }
            if($request->password){
                $data['password'] = Hash::make($data['password']);
            }
    
            $peserta->update($data);
            return response()->json($peserta);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->delete();
            return response()->json(["message" => "Peserta deleted successfully"]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function getSelf(Request $request)
    {
        try {
            $peserta = $request->attributes->get('jwt_payload');
            $peserta->load("jurusan");
            $peserta->load("agama");
            $peserta->load("kelas");
            return response()->json($peserta);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }
}
