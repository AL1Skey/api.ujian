<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Jurusan;
use App\Models\Agama;
use App\Models\Daftar_Kelas;
use App\Models\Kelompok_Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Service\ImportPeserta;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        try {
            Log::info('Fetching peserta list', ['query' => $request->all()]);
            $peserta = Peserta::query();
            if ($request->query("nomor_peserta")) {
                $peserta->where("nomor_peserta", $request->query("nomor_peserta"));
            }
            if ($request->has("search")) {
                $search = $request->query("search");
                $peserta->where(function ($query) use ($search) {
                    $query->where("nama", "like", "%{$search}%")
                        ->orWhere("nomor_peserta", "like", "%{$search}%");
                });
            }

            $totalPeserta = $peserta->count();
            
            $peserta->with("jurusan");
            $peserta->with("agama");
            $peserta->with("kelas");
            $peserta->with("tingkatan");

            return response()->json($request->query("all") ? $peserta->paginate($totalPeserta):$peserta->paginate(10));
        } catch (\Exception $e) {
            Log::error('Error fetching peserta list', ['error' => $e->getMessage()]);
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info('Creating peserta', ['data' => $request->all()]);
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
            if ($request->nomor_peserta) {
                $nomor_peserta = $request->nomor_peserta;
                $check_peserta = Peserta::query()->where("nomor_peserta", $nomor_peserta)->first();

                if (!$check_peserta) {
                    $data['nomor_peserta'] = $nomor_peserta;
                } else {
                    Log::warning('Duplicate nomor_peserta attempted', ['nomor_peserta' => $nomor_peserta]);
                    return response()->json(["error" => "Nomor Peserta cannot be duplicated"]);
                }
            } else {
                while (True) {
                    $nomor_peserta = rand(100000, 999999);
                    $check_peserta = Peserta::query()->where("nomor_peserta", $nomor_peserta)->first();
                    if (!$check_peserta) {
                        $data['nomor_peserta'] = $nomor_peserta;
                        break;
                    }
                }
            }

            // $data['password'] = Hash::make($data['password']);
            $peserta = Peserta::create($data);
            Log::info('Peserta created', ['id' => $peserta->id]);
            return response()->json($peserta, 201);
        } catch (\Exception $e) {
            Log::error('Error creating peserta', ['error' => $e->getMessage()]);
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            Log::info('Fetching peserta', ['id' => $id]);
            $peserta = Peserta::findOrFail($id);
            $peserta->load("jurusan");
            $peserta->load("agama");
            $peserta->load("kelas");
            return response()->json($peserta);
        } catch (\Exception $e) {
            Log::error('Error fetching peserta', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            Log::info('Updating peserta', ['id' => $id, 'data' => $request->all()]);
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
            
            if ($request->password) {
                // $data['password'] = Hash::make($data['password']);
            }

            $peserta->update($data);
            Log::info('Peserta updated', ['id' => $id]);
            return response()->json($peserta);
        } catch (\Exception $e) {
            Log::error('Error updating peserta', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            Log::info('Deleting peserta', ['id' => $id]);
            $peserta = Peserta::findOrFail($id);
            $peserta->delete();
            Log::info('Peserta deleted', ['id' => $id]);
            return response()->json(["message" => "Peserta deleted successfully"]);
        } catch (\Exception $e) {
            Log::error('Error deleting peserta', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function getSelf(Request $request)
    {
        try {
            $peserta = $request->attributes->get('jwt_payload');
            Log::info('Fetching self peserta', ['id' => $peserta->id ?? null]);
            $peserta->load("jurusan");
            $peserta->load("agama");
            $peserta->load("kelas");
            return response()->json($peserta);
        } catch (\Exception $e) {
            Log::error('Error fetching self peserta', ['error' => $e->getMessage()]);
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function import(Request $request)
    {
        try {
            Log::info('Importing peserta from file');
            $file = $request->file('file');
            if (!$file) {
                Log::warning('Import file not found');
                return response()->json(["error" => "File not found"], 400);
            }
            $data = Excel::import(new ImportPeserta, $file);
            Log::info('Peserta import completed');
            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error importing peserta', ['error' => $e->getMessage()]);
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function kartuUjian($nomor_peserta)
    {
        try {
            Log::info('Generating kartu ujian', ['nomor_peserta' => $nomor_peserta]);
            $students = Peserta::where("nomor_peserta", $nomor_peserta);
            // $exam    = Kelompok_Ujian::current();
            $students->with("jurusan");
            $students->with("agama");
            $students->with("kelas");
            $student = $students->first()->toArray();
            $students = $students->first();
            // dd($student['kelas']['nama']);
            // $pdf = Pdf::loadView('pdf.kartu_ujian', compact('student','exam'));
            $pdf = Pdf::loadView('pdf.kartu_ujian', compact('student'));
            return $pdf->stream("kartu_{$students->nama}_{$students->nomor_peserta}.pdf");
        } catch (\Exception $e) {
            Log::error('Error generating kartu ujian', ['studentId' => $nomor_peserta, 'error' => $e->getMessage()]);
            return response()->json(["error" => "Student not found " . $e->getMessage()], 404);
        }
    }
}
