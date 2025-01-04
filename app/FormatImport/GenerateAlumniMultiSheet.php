<?php

namespace App\FormatImport;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GenerateAlumniMultiSheet implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            0 => new GenerateAlumniFormat(),
            1 => new ReferencesPelaksanaanDiklat(),
        ];
    }
}
