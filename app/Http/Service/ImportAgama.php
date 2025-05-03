<?php


namespace App\Http\Service;

use App\Models\Agama;
use Maatwebsite\Excel\Concerns\ToModel;


class ImportAgama implements ToModel
{
    public function model(array $row)
    {
        // Check if the row is empty
        if (empty($row[0])) {
            return null; // Skip empty rows
        }
        // Check if the agama already exists
        $existingAgama = Agama::where('nama', $row[0])->first();
        if ($existingAgama) {
            return null; // Skip rows with existing agama
        }

        return new Agama([
            'nama' => $row[0],
        ]);
    }
}