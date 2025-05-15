<?php

namespace App\Http\Controllers;

use App\Models\Kelompok_Ujian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KelompokUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            $per_page = $request->query("limit") ?? 10;
            $kelompok_ujian = Kelompok_Ujian::query();
            if ($request->query('search')) {
                $kelompok_ujian->where('nama', 'like', '%' . $request->query('search') . '%');
            }
            $result = $kelompok_ujian->paginate($per_page);
            $result->getCollection()->transform(function ($item) {
                $item->start_date = $item->start_date ? \Carbon\Carbon::parse($item->start_date)->toIso8601String() : null;
                $item->end_date = $item->end_date ? \Carbon\Carbon::parse($item->end_date)->toIso8601String() : null;
                return $item;
            });
            return response()->json($result);
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
                'nama' => 'required|string',
                'id_sekolah' => '',
                // 'start_date' => 'date',
                // 'end_date' => 'date',
            ]);
            
            $data = $this->handleRequest($request);
            if (isset($data['start_date'])) {
                $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
            }
            if (isset($data['end_date'])) {
                $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');
            }
            $kelompok_ujian = Kelompok_Ujian::create($data);
            return response()->json($kelompok_ujian);
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
            $kelompok_ujian = Kelompok_Ujian::find($id);
            if ($kelompok_ujian) {
                $kelompok_ujian->start_date = $kelompok_ujian->start_date ? \Carbon\Carbon::parse($kelompok_ujian->start_date)->toIso8601String() : null;
                $kelompok_ujian->end_date = $kelompok_ujian->end_date ? \Carbon\Carbon::parse($kelompok_ujian->end_date)->toIso8601String() : null;
                return response()->json($kelompok_ujian);
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
                'id_sekolah' => 'string',
                // 'start_date' => 'date',
                // 'end_date' => 'date',
            ]);
            $data = $this->handleRequest($request);
            if (isset($data['start_date'])) {
                $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
            }
            if (isset($data['end_date'])) {
                $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');
            }
            $kelompok_ujian = Kelompok_Ujian::find($id);
            $kelompok_ujian->update($data);
            return response()->json($kelompok_ujian);
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
            $kelompok_ujian = Kelompok_Ujian::find($id);
            if ($kelompok_ujian) {
                // Check if the kelompok_ujian is used in the ujian table
                // $ujian = \App\Models\Ujian::where('kelompok_id', $kelompok_ujian->id)->first();
                // if ($ujian) {
                //     $ujian->delete();
                // }
                $kelompok_ujian->delete();
                return response()->json(['message' => 'Data deleted']);
            }
            return response()->json(['message' => 'Data not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
