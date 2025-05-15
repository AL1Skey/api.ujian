<?php


namespace App\Http\Service;
use App\Models\Guru;
use App\Models\Agama;
use App\Models\Mapel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ImportGuru implements ToModel
{
    public function model(array $row)
    {
        // Check if the row is empty
        if (empty($row[0])) {
            return null; // Skip empty rows
        }
        // Check if the nomor_peserta already exists
        $existingGuru = Guru::where('username', $row[0])->first();
        if ($existingGuru) {
            return null; // Skip rows with existing nomor_peserta
        }
        $mapel_id = Mapel::where('nama', strtoupper($row[5]))->first();
        if ($mapel_id) {
            $mapel_id = $mapel_id->id;
        } else {
            Mapel::create(['nama' => strtoupper($row[5])]); // Create a new mapel if not found
            $mapel_id = Mapel::where('nama', strtoupper($row[5]))->first()->id; // Get the newly created mapel ID
            // $mapel_id = null; // Set to null if not found
        }
        $agama_id = Agama::where('nama', strtoupper($row[6]))->first();
        if ($agama_id) {
            $agama_id = $agama_id->id;
        } else {
            Agama::create(['nama' => strtoupper($row[6])]); // Create a new agama if not found
            $agama_id = Agama::where('nama', strtoupper($row[6]))->first()->id; // Get the newly created agama ID
            // $agama_id = null; // Set to null if not found
        }

        return new Guru([
            'username' => $row[0],
            'password' => $row[1],
            'nama' => $row[2],
            'alamat' => $row[3],
            'role' => strtoupper($row[4]),
            'mapel_id' => $mapel_id,
            'agama_id' => $agama_id,
            'is_active' => true,
        ]);
    }
}