<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;
use App\Models\Ujian;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        //
        try{
            $soal = Soal::query()->select(['id', 'ujian_id', 'soal', 'image', 'tipe_soal', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e']);
            if($request->query("ujian_id")){
                $soal->where("ujian_id", $request->query("ujian_id"));
            }
<<<<<<< HEAD
            //$soal->with("ujian");
            $paginateResult = $soal->paginate($request->query("limit") ?? 100);
            foreach ($paginateResult->items() as $item) {
                if($item->image){
                $item->image = $item->image ? asset('storage/app/public/files/'.$item->image) : null;
                }
            }
            
            $per_page = $request->query("limit") ?? 100;
            return response()->json($paginateResult);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }
    
    public function indexAll(Request $request)
    {
        //
 
        try{
            $soal = Soal::query();

            if($request->query("ujian_id")){
                $soal->where("ujian_id", $request->query("ujian_id"));
            }
            //$soal->with("ujian");
            $paginateResult = $soal->paginate($request->query("limit") ?? 100);
            foreach ($paginateResult->items() as $item) {
                if($item->image){
                $item->image = $item->image ? asset('storage/app/public/files/'.$item->image) : null;
                }
            }
            $per_page = $request->query("limit") ?? 100;
            return response()->json($paginateResult);
=======
            $soal->with("ujian");
            $per_page = $request->query("limit") ?? 100;
            return response()->json($soal->paginate($per_page));
>>>>>>> f6925f0209e602d33cfce465645b0879fee9227d
        }
        catch (\Exception $e) {
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
                "ujian_id" => "required|integer",
                "soal" => "required|string",
                
                "tipe_soal" => "required|string",
                "pilihan_a" => "string",
                "pilihan_b" => "string",
                "pilihan_c" => "string",
                "pilihan_d" => "string",
                "pilihan_e" => "string",
                "jawaban" => "string",
            ]);
            $data = $this->handleRequest($request);
           //dd($data);
            $check_ujian = Ujian::query()->find($request->ujian_id);
            if(!$check_ujian) {
                $data['ujian_id'] = null;
            }

            $soal = Soal::create($data);
            return response()->json($soal, 201);
        }
        catch (\Exception $e) {
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
            $soal = Soal::findOrFail($id);
            $soal->load("ujian");
            $soal->image = $soal->image ? asset('public/files/' . $soal->image) : null;
            return response()->json($soal);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $request->validate([
                "ujian_id" => "integer",
                // "soal" => "string",
                // "tipe_soal" => "string",
                // "pilihan_a" => "string",
                // "pilihan_b" => "string",
                // "pilihan_c" => "string",
                // "pilihan_d" => "string",
                // "pilihan_e" => "string",
                // "jawaban" => "string",
            ]);
            $data = $this->handleRequest($request);
            // return response()->json($data);
            $soal = Soal::findOrFail($id);
            $soal->update($data);
            return response()->json($soal);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try{
            $soal = Soal::findOrFail($id);
            $soal->delete();
            return response()->json($soal);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }
}
