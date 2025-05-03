<?php

namespace App\Http\Controllers;

use App\Models\Sesi_Ujian;
use App\Models\Ujian;
use Illuminate\Http\Request;
use App\Models\Kelompok_Ujian;
use App\Models\Mapel;
use App\Models\Daftar_Kelas;
// use App\Models\SesiUjian;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $ujian = Ujian::query();

            if ($request->query("id_sekolah")) {
                $ujian->where("id_sekolah", "like", "%" . $request->query("id_sekolah") . "%");
            }
            if ($request->query("kelompok_id")) {
                $ujian->where("kelompok_id", $request->query("kelompok_id"));
            }
            if ($request->query("status")) {
                $ujian->where("status", $request->query("status"));
            }
            
            if ($request->query('mapel_id')){
                $ujian->where('mapel_id',$request->query('mapel_id'));
            }

            $ujian->with("kelompok_ujian");
            $ujian->with("mapel");
            $ujian->with("kelas");

            // Convert start_date and end_date to ISO format
            $ujian->get()->transform(function ($item) {
                $item->start_date = \Carbon\Carbon::parse($item->start_date)->toIso8601String();
                $item->end_date = \Carbon\Carbon::parse($item->end_date)->toIso8601String();
                return $item;
            });

            $per_page = $request->query("limit") ?? 10;
            return response()->json($ujian->paginate($per_page));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function indexSiswa(Request $request){
        try {
            $ujian = Ujian::query();
            $ujian->addSelect([
                'isTrue' => Sesi_Ujian::query()
                    ->select('isTrue')
                    ->whereColumn('sesi__ujians.ujian_id','ujians.id')
                    ->where('isTrue',1)
                    ->limit(1) ?? false,
                'nomor_peserta' => Sesi_Ujian::query()
                    ->select('nomor_peserta')
                    ->whereColumn('sesi__ujians.ujian_id','ujians.id')
                    ->limit(1) ?? null
            ]);
        //     // dd($request->query('nomor_peserta',''));
        //     dd( Sesi_Ujian::query()
        //     ->select('isTrue')
        //     // ->whereColumn('sesi__ujians.ujian_id','ujians.id')
        //     ->where('nomor_peserta',$request->query('nomor_peserta',''))
        //     // ->where('ujian_id',$request->query('ujian_id',''))
        //     ->where('isTrue',true)
        //     ->limit(1)
        //     ->get()
        //     ->toArray()
        // );
    
            // Existing query conditions...
            // if ($request->query("id_sekolah")) {
            //     $ujian->where("id_sekolah", "like", "%" . $request->query("id_sekolah") . "%");
            // }
            if ($request->query("nomor_peserta")) {
                $ujian->whereIn('id', Sesi_Ujian::query()
                    ->select('ujian_id')
                    ->where('nomor_peserta', $request->query('nomor_peserta'))
                );
            }
            if ($request->query("ujian_id")) {
                $ujian->where("ujians.id", $request->query("ujian_id"));
            }
            if($request->query("kelompok_id")){
                $ujian->where("ujians.kelompok_id",$request->query("kelompok_id"));
            }
            if ($request->query('mapel_id')){
                $ujian->where('mapel_id',$request->query('mapel_id'));
            }
    
            $ujian->with("kelompok_ujian");
            $ujian->with("mapel");
            $ujian->with("kelas");
    
            // Date transformation remains the same
            $ujian->get()->transform(function ($item) {
                $item->start_date = \Carbon\Carbon::parse($item->start_date)->toIso8601String();
                $item->end_date = \Carbon\Carbon::parse($item->end_date)->toIso8601String();
                return $item;
            });
            
            $per_page = $request->query("limit") ?? 10;
            // dd($ujian->paginate($per_page));
            return response()->json($ujian->paginate($per_page));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Display all IDs of the resource.
     */
    public function getAllIds(Request $request)
    {
        //
        // Display all IDs of the resource
        // This method is used to get all IDs of the Ujian model
        // It returns a JSON response with the IDs
        // Example: GET /api/ujian/ids
        try {
            $data = Ujian::query();
            if ($request->query("start_date")) {
                $data->where("start_date", ">=", $request->query("start_date"));
            }
            if ($request->query("end_date")) {
                $data->where("end_date", "<=", $request->query("end_date"));
            }

            // Convert start_date and end_date to ISO format
            $data->get()->transform(function ($item) {
                $item->start_date = \Carbon\Carbon::parse($item->start_date)->toIso8601String();
                $item->end_date = \Carbon\Carbon::parse($item->end_date)->toIso8601String();
                return $item;
            });

            $ids = $data->pluck('id');
            return response()->json($ids);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'kelompok_id' => 'required|integer',
                'mapel_id' => 'required|integer',
                'kelas_id' => 'required|integer',
                'nama' => 'required|string',
                'id_sekolah' => 'required|integer',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'status' => 'required|string'
            ]);
            $data = $this->handleRequest($request);
            $check_kelompok = Kelompok_Ujian::query()->find($request->kelompok_id);
            if(!$check_kelompok) {
                $data['kelompok_id'] = null;
            }
            $check_mapel = Mapel::query()->find($request->mapel_id);
            if(!$check_mapel) {
                $data['mapel_id'] = null;
            }
            $check_kelas = Daftar_Kelas::query()->find($request->kelas_id);
            if(!$check_kelas) {
                $data['kelas_id'] = null;
            }

            $ujian = Ujian::create($data);
            return response()->json($ujian, 201);
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
        try {
            $ujian = Ujian::query()->findOrFail($id);
            $ujian->load("kelompok_ujian");
            $ujian->load("mapel");
            $ujian->load("kelas");

            // Convert start_date and end_date to ISO format
            $ujian->start_date = \Carbon\Carbon::parse($ujian->start_date)->toIso8601String();
            $ujian->end_date = \Carbon\Carbon::parse($ujian->end_date)->toIso8601String();

            return response()->json($ujian);
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
        try {
            $ujian = Ujian::findOrFail($id);
            $request->validate([
                'kelompok_id' => 'integer',
                'mapel_id' => 'integer',
                'kelas_id' => 'integer',
                'nama' => 'string',
                'id_sekolah' => 'integer',
                'start_date' => 'date',
                'end_date' => 'date',
                'status' => 'string'
            ]);

            $data = $this->handleRequest($request);

            $ujian->fill($data);
            $ujian->save();
            return response()->json($ujian, 200);
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
        try {
            $ujian = Ujian::findOrFail($id);
            $ujian->delete();
            return response()->json($ujian, 200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }
}
