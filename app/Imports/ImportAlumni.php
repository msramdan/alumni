<?php

namespace App\Imports;

use App\Models\PelaksaanDiklat;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportAlumni implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    use Importable;

    public function collection(Collection $collection)
    {
        // Validate that the necessary fields are present
        Validator::make($collection->toArray(), [
            '*.nama' => 'required',
            '*.no_absen' => 'required|numeric',
            '*.no_reg' => 'required|numeric',
            '*.tempat_lahir' => 'required',
            '*.tanggal_lahir' => 'required',
            '*.id_pelaksanaan_diklat' => 'required|exists:pelaksaan_diklats,id', // Ensure the pelaksaan_diklat exists
        ])->validate();

        foreach ($collection as $row) {
            // Parse tanggal_lahir and handle invalid date formats
            try {
                $tanggalLahir = Date::excelToDateTimeObject($row['tanggal_lahir']);
                // Convert to 'Y-m-d' format
                $tanggalLahirFormatted = $tanggalLahir->format('Y-m-d');
            } catch (\Exception $e) {
                // Handle invalid date format (set to null or log the error)
                $tanggalLahirFormatted = null;
            }
            // Insert each alumni record into the database
            DB::table('alumni')->insert([
                'nama'               => $row['nama'],
                'no_absen'           => $row['no_absen'],
                'no_reg'             => $row['no_reg'],
                'tempat_lahir'      => $row['tempat_lahir'],
                'tanggal_lahir'     => $tanggalLahirFormatted, // Use the formatted date
                'pelaksaan_diklat_id' => PelaksaanDiklat::find($row['id_pelaksanaan_diklat'])->id,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
