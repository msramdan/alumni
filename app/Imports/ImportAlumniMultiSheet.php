<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImportAlumniMultiSheet implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new ImportAlumni()
        ];
    }
}
