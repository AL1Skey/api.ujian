<?php

namespace App\Http\Service;

use App\Models\Jurusan;
use App\Models\Peserta;
use App\Models\Agama;
use App\Models\Daftar_Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ImportPeserta implements ToModel
{
    public function model(array $row)
    {
        // Check if the row is empty
        if (empty($row[0])) {
            return null; // Skip empty rows
        }

        // Check if the heading row is present
        if (isset($row[0]) && $row[0] === 'nomor_peserta') {
            return null; // Skip the heading row
        }


        // Check if the nomor_peserta already exists
        $existingPeserta = Peserta::where('nomor_peserta', $row[0])->first();
        if ($existingPeserta) {
            return null; // Skip rows with existing nomor_peserta
        }
        $jurusan_id = Jurusan::where('nama', strtoupper($row[5]))->first();
        if ($jurusan_id) {
            $jurusan_id = $jurusan_id->id;
        } else {
            Jurusan::create(['nama' => strtoupper($row[5])]); // Create a new jurusan if not found
            $jurusan_id = Jurusan::where('nama', strtoupper($row[5]))->first()->id; // Get the newly created jurusan ID
            // $jurusan_id = null; // Set to null if not found
        }
        $agama_id = Agama::where('nama', strtoupper($row[6]))->first();
        if ($agama_id) {
            $agama_id = $agama_id->id;
        } else {
            Agama::create(['nama' => strtoupper($row[6])]); // Create a new agama if not found
            $agama_id = Agama::where('nama', strtoupper($row[6]))->first()->id; // Get the newly created agama ID
            // $agama_id = null; // Set to null if not found
        }
        $kelas_id = Daftar_Kelas::where('nama', strtoupper($row[4]))->first();
        if ($kelas_id) {
            $kelas_id = $kelas_id->id;
        } else {
            Daftar_Kelas::create(['nama' => strtoupper($row[4])]); // Create a new kelas if not found
            $kelas_id = Daftar_Kelas::where('nama', strtoupper($row[4]))->first()->id; // Get the newly created kelas ID
            // $kelas_id = null; // Set to null if not found
        }

        // dd([
        //     'nomor_peserta' => $row[0],
        //     'password' => Hash::make($row[1]),
        //     'nama' => $row[2],
        //     'alamat' => $row[3],
        //     'kelas_id' => $kelas_id,
        //     'jurusan_id' => $jurusan_id,
        //     'agama_id' => $agama_id,
        // ]);
           
        return new Peserta([
            'nomor_peserta' => $row[0],
            'password' => Hash::make($row[1]),
            'nama' => $row[2],
            'alamat' => $row[3],
            'kelas_id' => $kelas_id,
            'jurusan_id' => $jurusan_id,
            'agama_id' => $agama_id,
        ]);
    }

    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headers
    }




}