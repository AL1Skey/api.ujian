<?php

namespace App\Http\Controllers;

use App\Models\Hasil_Ujian;
use App\Models\Soal;
use App\Models\Sesi_Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

class HasilUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            //code...
            $hasil = Hasil_Ujian::query();
            $per_page = $request->query("limit") ?? 100;
            // $hasil->select('hasil__ujians.id','peserta.nama','hasil__ujians.nomor_peserta as nomor_peserta', 'ujian.id as ujian_id','soal.soal','soal.tipe_soal', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi', 'hasil__ujians.isTrue')
            // ->join('soals as soal', 'hasil__ujians.soal_id', '=', 'soal.id')
            // ->join('ujians as ujian','hasil__ujians.ujian_id','=','ujian.id')
            // ->join('sesi__soals as sesi_soal', 'hasil__ujians.sesi_soal_id', '=', 'sesi_soal.id')
            // ->join('pesertas as peserta', 'hasil__ujians.nomor_peserta', '=', 'peserta.nomor_peserta');
            $hasil->select('hasil__ujians.id','peserta.nama','hasil__ujians.nomor_peserta as nomor_peserta', 'ujian.id as ujian_id','soal.soal','soal.tipe_soal', 'jawaban_soal', 'jawaban_sesi', 'hasil__ujians.isTrue')
            ->join('soals as soal', 'hasil__ujians.soal_id', '=', 'soal.id')
            ->join('ujians as ujian','hasil__ujians.ujian_id','=','ujian.id')
            // ->join('sesi__soals as sesi_soal', 'hasil__ujians.sesi_soal_id', '=', 'sesi_soal.id')
            ->join('pesertas as peserta', 'hasil__ujians.nomor_peserta', '=', 'peserta.nomor_peserta');
            
            //dd($request->query('nomor_peserta'));
            
            if ($request->has('nomor_peserta')) {
                $nomor_peserta = $request->query('nomor_peserta');
                $hasil->where(function ($query) use ($nomor_peserta) {
                    $query->where('hasil__ujians.nomor_peserta', $nomor_peserta)
                          ->orWhere('peserta.nomor_peserta', $nomor_peserta);
                });
            }
            if($request->has('ujian_id')){
                $hasil->where('hasil__ujians.ujian_id', $request->query('ujian_id'));
            }
    
            return response()->json($hasil->paginate($per_page));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th,500);
        }
    }
    public function reevaluate(Request $request){
        try{
            $ujian = Ujian::query();
            $ujian->select('peserta.nomor_peserta', 'ujians.id as ujian_id', 'soal.id as soal_id','soal.tipe_soal as tipe_soal', 'sesi_soal.id as sesi_soal_id', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi')
                  ->join('soals as soal', 'ujians.id', '=', 'soal.ujian_id')
                  ->join('sesi__soals as sesi_soal', 'ujians.id', '=', 'sesi_soal.ujian_id')
                  ->join('pesertas as peserta', 'sesi_soal.nomor_peserta', '=', 'peserta.nomor_peserta')
                  ->chunk(1000000, function ($data) {
                     
                  foreach ($data as $item) {
                    $find = Hasil_Ujian::where('nomor_peserta', $item->nomor_peserta)->where('ujian_id', $item->ujian_id)->where('soal_id', $item->soal_id)->where('sesi_soal_id', $item->sesi_soal_id);
                    if($find->count() > 0 && $item->jawaban_soal != null && $item->tipe_soal == "pilihan_ganda"){
                        $find->update([
                        'isTrue' => $item->jawaban_soal == $item->jawaban_sesi // or any default value
                        ]);
                    //   Hasil_Ujian::create([
                    //   'nomor_peserta' => $item->nomor_peserta,
                    //   'ujian_id' => $item->ujian_id,
                    //   'soal_id' => $item->soal_id,
                    //   'sesi_soal_id' => $item->sesi_soal_id,
                    //   'isTrue' => $item->jawaban_soal == $item->jawaban_sesi // or any default value
                    //   ]);
                    }
                  }
                  });
            
            $hasil_ujian = Hasil_Ujian::query();
            $hasil_ujian->select('nomor_peserta','ujian_id','soal_id','jawaban_soal','jawaban_sesi')
            ->chunk(10000,function($data){
                foreach ($data as $item) {
                    $find = Hasil_Ujian::where('nomor_peserta', $item->nomor_peserta)->where('ujian_id', $item->ujian_id)->where('soal_id', $item->soal_id)->where('sesi_soal_id', $item->sesi_soal_id);
                    if($find->count() > 0 && $item->jawaban_soal != null && $item->tipe_soal == "pilihan_ganda"){
                        $find->update([
                        'isTrue' => $item->jawaban_soal == $item->jawaban_sesi // or any default value
                        ]);
                    }
                }
            });
      
            return response()->json(["msg"=>"Reevaluate Successfully"],201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }

    public function migrate(){
        try{
            $ujian = Ujian::query();
            $ujian->select('peserta.nomor_peserta', 'ujians.id as ujian_id', 'soal.id as soal_id', 'sesi_soal.id as sesi_soal_id','soal.tipe_soal as tipe_soal', 'soal.jawaban as jawaban_soal', 'sesi_soal.jawaban as jawaban_sesi')
                  ->join('soals as soal', 'ujians.id', '=', 'soal.ujian_id')
                  //->join('sesi__ujians as sesi_ujian', 'Ujians.id', '=', 'sesi_ujian.ujian_id')
                  ->join('sesi__soals as sesi_soal', 'ujians.id', '=', 'sesi_soal.ujian_id')
                  ->join('pesertas as peserta', 'sesi_soal.nomor_peserta', '=', 'peserta.nomor_peserta')
                  ->chunk(100, function ($data) {
                  foreach ($data as $item) {
                    $find = Hasil_Ujian::where('nomor_peserta', $item->nomor_peserta)->where('ujian_id', $item->ujian_id)->where('soal_id', $item->soal_id)
                    // ->where('sesi_soal_id', $item->sesi_soal_id)
                    ;
                    if($find->count() == 0 && $item->jawaban_soal != null){
                      Hasil_Ujian::create([
                      'nomor_peserta' => $item->nomor_peserta,
                      'ujian_id' => $item->ujian_id,
                      'soal_id' => $item->soal_id,
                      'sesi_soal_id' => $item->sesi_soal_id,
                      'tipe_soal' => $item->tipe_soal,
                      'jawaban_soal' => $item->jawaban_soal,
                      'jawaban_sesi' => $item->jawaban_sesi,
                      'isTrue' => $item->jawaban_soal == $item->jawaban_sesi // or any default value
                      ]);
                    }
                  }
                  });

                // Remove duplicate entries
                Hasil_Ujian::query()
                ->select('nomor_peserta', 'ujian_id', 'soal_id', 'sesi_soal_id')
                ->groupBy('nomor_peserta', 'ujian_id', 'soal_id', 'sesi_soal_id')
                ->havingRaw('COUNT(*) > 1')
                ->chunk(100, function ($duplicates) {
                    foreach ($duplicates as $duplicate) {
                        Hasil_Ujian::where('nomor_peserta', $duplicate->nomor_peserta)
                            ->where('ujian_id', $duplicate->ujian_id)
                            ->where('soal_id', $duplicate->soal_id)
                            ->where('sesi_soal_id', $duplicate->sesi_soal_id)
                            ->delete();
                    }
                });

                  return response()->json(["msg"=>"Migrate Successfully"],201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th,500);
        }
    }

    public function hasilUjianAnalysis($id) {
        try {
            // Get all exam results with student and class relationships
            $records = Hasil_Ujian::where('ujian_id', $id)
                ->with('peserta.kelas')
                ->get();
    
            // Process all student scores
            $allScores = $records
                ->groupBy('nomor_peserta')
                ->map(function($items, $nomor) {
                    $correct = $items->sum('isTrue');
                    $total = $items->count();
                    $percent = $total ? ($correct / $total) * 100 : 0;
                    $peserta = $items->first()->peserta;
                    
                    return [
                        'nomor_peserta' => $nomor,
                        'nama' => $peserta->nama,
                        'kelas' => $peserta->kelas->nama ?? 'Unknown',
                        'score' => round($percent, 2),
                    ];
                })
                ->values()
                ->sortByDesc('score');
    
            // Get top 5 students
            $topStudents = $allScores->take(5)->values();
    
            // Calculate class statistics
            $classAnalysis = $allScores
                ->groupBy('kelas')
                ->map(function($students, $className) {
                    return [
                        'class_name' => $className,
                        'average_score' => round($students->avg('score'), 2),
                        'student_count' => $students->count()
                    ];
                })
                ->sortByDesc('average_score')
                ->values();
    
            // Get top 5 and bottom 5 classes
            $topClasses = $classAnalysis->take(5);
            $bottomClasses = $classAnalysis->sortBy('average_score')->take(5);
    
            // Prepare data for statistical calculations
            $values = $allScores->pluck('score')->toArray();
            $n = count($values);
            
            // Basic statistics
            $stats = [
                'count' => $n,
                'min' => $n ? min($values) : 0,
                'max' => $n ? max($values) : 0,
                'average' => $n ? round(array_sum($values) / $n, 2) : 0,
            ];
    
            // Median calculation
            sort($values);
            $median = 0;
            if ($n) {
                $middle = floor($n / 2);
                $median = ($n % 2) ? $values[$middle] : ($values[$middle - 1] + $values[$middle]) / 2;
            }
    
            // Standard deviation
            $variance = 0;
            if ($n > 1) {
                $variance = array_sum(array_map(fn($v) => pow($v - $stats['average'], 2), $values)) / ($n - 1);
            }
            $stats['stdDev'] = round(sqrt($variance), 2);
            $stats['median'] = round($median, 2);
    
            // Confidence interval
            $se = $n ? ($stats['stdDev'] / sqrt($n)) : 0;
            $stats['confidence_interval'] = [
                'low' => round($stats['average'] - 1.96 * $se, 2),
                'high' => round($stats['average'] + 1.96 * $se, 2)
            ];
    
            // Student ranking by class
            $rankingByClass = $allScores
                ->groupBy('kelas')
                ->map(function($group) {
                    return $group
                        ->sortByDesc('score')
                        ->values()
                        ->map(fn($item, $idx) => array_merge($item, ['rank' => $idx + 1]));
                });
    
            return response()->json([
                'overall_statistics' => $stats,
                'top_performers' => $topStudents,
                'class_analysis' => [
                    'top_5_classes' => $topClasses,
                    'bottom_5_classes' => $bottomClasses->values(),
                    'all_classes' => $classAnalysis
                ],
                'detailed_rankings' => $rankingByClass
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Server error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function hasilUjianSiswa($nomor_peserta, $ujian_id) {
        try {
            // Get all exam results with student and class relationships
            $records = Hasil_Ujian::where('nomor_peserta', $nomor_peserta)
                ->where('ujian_id', $ujian_id)
                ->with('peserta.kelas')
                ->get();
            // Process all student scores
            $allScores = $records
                ->groupBy('nomor_peserta')
                ->map(function($items, $nomor) {
                    $correct = $items->sum('isTrue');
                    $total = $items->count();
                    $percent = $total ? ($correct / $total) * 100 : 0;
                    $peserta = $items->first()->peserta;
                    $benar = $items->where('isTrue', 1)->count();
                    $salah = $items->where('isTrue', 0)->count();
                    return [
                        'nomor_peserta' => $nomor,
                        'nama' => $peserta->nama,
                        'kelas' => $peserta->kelas->nama ?? 'Unknown',
                        'benar' => $benar,
                        'salah' => $salah,
                        'score' => round($percent, 2),
                        'hasil_ujian' => $items
                    ];
                })
                ->values()
                ->sortByDesc('nama');
    
            return response()->json($allScores, 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Server error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function hasilUjianSiswaByUjian(Request $request,$ujian_id) {
        try {
            // Get all exam results with student and class relationships
            $records = Hasil_Ujian::where('ujian_id', $ujian_id);
            if($request->has('kelas_id')){
                $kelas_id = $request->query('kelas_id');
                $records->whereHas('peserta', function ($query) use ($kelas_id) {
                    // This assumes that the 'pesertas' table has a 'kelas_id' foreign key
                    // referencing the 'id' of the 'kelas' table.
                    $query->where('kelas_id', $kelas_id);
                });
            }
            if($request->has('tingkatan_id')){
                $tingkatan_id = $request->query('tingkatan_id');
                $records->whereHas('peserta', function ($query) use ($tingkatan_id) {
                    $query->where('id', $tingkatan_id);
                });
            }

            $records = $records->get();
            // Process all student scores
            $allScores = $records
                ->groupBy('nomor_peserta')
                ->map(function($items, $nomor) {
                    $correct = $items->sum('isTrue');
                    // $total   = $items->count();
                    $total = $items->where('isTrue', 1)->count() + $items->where('isTrue', 0)->count();
                    $percent = $total ? ($correct / $total) : 0;
                    $peserta = $items->first()->peserta;
                    $benar   = $items->where('isTrue', 1)->count();
                    $salah   = $items->where('isTrue', 0)->count();
                    
                    return [
                        'nomor_peserta' => $nomor,
                        'nama'          => $peserta->nama,
                        'kelas'         => $peserta->kelas->nama ?? 'Unknown',
                        'benar'         => $benar,
                        'salah'         => $salah,
                        'score'         => (float)sprintf("%.2f", $percent),
                        // 'hasil_ujian'   => $items,
                    ];
                })
                ->sortBy('nama')
                ->values()
                ->all();  // <-- pull out a pure PHP array here

            return response()->json($allScores, 200);
    
            // return response()->json($allScores, 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Server error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function hasilUjianSiswaByUjianKelas($ujian_id, $kelas_id) {
        try {
            // Get all exam results with student and class relationships
            $records = Hasil_Ujian::where('ujian_id', $ujian_id)
                ->with(['peserta.kelas' => function($query) use ($kelas_id) {
                    $query->where('id', $kelas_id);
                }])
                ->get();
    
            // Process all student scores
            $allScores = $records
                ->groupBy('nomor_peserta')
                ->map(function($items, $nomor) {
                    $correct = $items->sum('isTrue');
                    // $total = $items->count();
                    $total = $items->where('isTrue', 1)->count() + $items->where('isTrue', 0)->count();
                    $percent = $total ? ($correct / $total) * 100 : 0;
                    $peserta = $items->first()->peserta;
                    
                    return [
                        'nomor_peserta' => $nomor,
                        'nama' => $peserta->nama,
                        'kelas' => $peserta->kelas->nama ?? 'Unknown',
                        'score' => round($percent, 2),
                        'hasil_ujian' => $items
                    ];
                })
                ->values()
                ->sortByDesc('score')
                ;
    
            return response()->json($allScores, 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Server error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    
    


    public function analisaButirSoal($id)
    {
        try {
            $analysis = Hasil_Ujian::select(
                    'soals.id as soal_id',
                    'soals.soal',
                    'soals.jawaban as jawaban_benar',
                    DB::raw("SUM(CASE WHEN LOWER(hasil__ujians.jawaban_sesi) = 'a' THEN 1 ELSE 0 END) as count_A"),
                    DB::raw("SUM(CASE WHEN LOWER(hasil__ujians.jawaban_sesi) = 'b' THEN 1 ELSE 0 END) as count_B"),
                    DB::raw("SUM(CASE WHEN LOWER(hasil__ujians.jawaban_sesi) = 'c' THEN 1 ELSE 0 END) as count_C"),
                    DB::raw("SUM(CASE WHEN LOWER(hasil__ujians.jawaban_sesi) = 'd' THEN 1 ELSE 0 END) as count_D"),
                    DB::raw("SUM(CASE WHEN LOWER(hasil__ujians.jawaban_sesi) = 'e' THEN 1 ELSE 0 END) as count_E"),
                    DB::raw("SUM(CASE WHEN hasil__ujians.isTrue = 1 THEN 1 ELSE 0 END) as correct_count"),
                    DB::raw("SUM(CASE WHEN hasil__ujians.isTrue = 0 THEN 1 ELSE 0 END) as wrong_count"),
                    // DB::raw("ROUND(
                    //     SUM(CASE WHEN hasil__ujians.isTrue = 1 THEN 1 ELSE 0 END) 
                    //     / NULLIF(COUNT(*),0) 
                    // ,4) as difficulty_ratio")
                    DB::raw("ROUND(
                        SUM(CASE WHEN hasil__ujians.isTrue = 0 THEN 1 ELSE 0 END) 
                        / NULLIF(COUNT(*), 0), 4) as difficulty_ratio")
                    
                )
                ->join('soals', 'hasil__ujians.soal_id', '=', 'soals.id')
                ->where('hasil__ujians.ujian_id', $id)
                ->groupBy('soals.id', 'soals.soal', 'soals.jawaban')
                ->get();

            return response()->json($analysis, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Gagal mengambil analisa butir soal',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $hasil = Hasil_Ujian::findOrFail($id);
            $hasil->load('ujian');
            $hasil->load('soal');
            $hasil->load('peserta');
            return response()->json($hasil);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        try{
            $data = $this->handleRequest($request);
            $hasil = Hasil_Ujian::findOrFail($id);
            $hasil->update($data);
            
            return response()->json(["msg"=>"Hasil Ujian Updated Successfully"]);
        }
        catch(\Throwable $th){
            return response()->json($th,500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hasil_Ujian $hasil_Ujian)
    {
        //
    }
}










// Backup


    // public function hasilUjianSiswaByUjianKelas($ujian_id, $kelas_id) {
    //     try {
    //         // Get all exam results with student and class relationships
    //         $records = Hasil_Ujian::where('ujian_id', $ujian_id)
    //             ->with(['peserta.kelas' => function($query) use ($kelas_id) {
    //                 $query->where('id', $kelas_id);
    //             }])
    //             ->get();
    
    //         // Process all student scores
    //         $allScores = $records
    //             ->groupBy('nomor_peserta')
    //             ->map(function($items, $nomor) {
    //                 $correct = $items->sum('isTrue');
    //                 $total = $items->count();
    //                 $percent = $total ? ($correct / $total) * 100 : 0;
    //                 $peserta = $items->first()->peserta;
                    
    //                 return [
    //                     'nomor_peserta' => $nomor,
    //                     'nama' => $peserta->nama,
    //                     'kelas' => $peserta->kelas->nama ?? 'Unknown',
    //                     'score' => round($percent, 2),
    //                     'hasil_ujian' => $items
    //                 ];
    //             })
    //             ->values()
    //             ->sortByDesc('score')
    //             ;
    
    //         return response()->json($allScores, 200);
    
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'error' => 'Server error',
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }