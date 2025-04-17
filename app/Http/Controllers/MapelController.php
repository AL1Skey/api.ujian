<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try{
            $per_page = $request->query("limit") ?? 10;
            $mapel = Mapel::query();
            if($request->query("search")){
                $mapel->where("nama", "like", "%" . $request->query("search") . "%");
            }
            if ($request->query('mapel_id')){
                $mapel->where('id',$request->query('mapel_id'));
            }
            return response()->json($mapel->paginate($per_page));
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
                "nama" => "required|string",
            ]);
            $mapel = $this->handleRequest($request);
            $mapel = Mapel::create($mapel);
            return response()->json($mapel, 201);
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
        try{
            $mapel = Mapel::find($id);
            if($mapel){
                return response()->json($mapel);
            }
            return response()->json(["message" => "Data not found"], 404);
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
        try{
            $request->validate([
                "nama" => "required|string",
            ]);
            $mapel = Mapel::find($id);
            if($mapel){
                $mapel->update($this->handleRequest($request));
                return response()->json($mapel);
            }
            return response()->json(["message" => "Data not found"], 404);
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
        try{
            $mapel = Mapel::find($id);
            if($mapel){
                $mapel->delete();
                return response()->json($mapel);
            }
            return response()->json(["message" => "Data not found"], 404);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }
}
