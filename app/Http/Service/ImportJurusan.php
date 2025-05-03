<?php


namespace App\Http\Service;
use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;


class ImportJurusan implements ToModel
{
    public function model(array $row)
    {
        // Check if the row is empty
        if (empty($row[0])) {
            return null; // Skip empty rows
        }
        // Check if the jurusan already exists
        $existingJurusan = Jurusan::where('nama', $row[0])->first();
        if ($existingJurusan) {
            return null; // Skip rows with existing jurusan
        }

        return new Jurusan([
            'nama' => $row[0],
        ]);
    }
}