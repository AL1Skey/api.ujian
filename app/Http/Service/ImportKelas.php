<?php


namespace App\Http\Service;
use App\Models\Daftar_Kelas;
use Maatwebsite\Excel\Concerns\ToModel;


class ImportKelas implements ToModel
{
    public function model(array $row)
    {
        // Check if the row is empty
        if (empty($row[0])) {
            return null; // Skip empty rows
        }
        // Check if the kelas already exists
        $existingKelas = Daftar_Kelas::where('nama', $row[0])->first();
        if ($existingKelas) {
            return null; // Skip rows with existing kelas
        }

        return new Daftar_Kelas([
            'nama' => $row[0],
        ]);
    }
}