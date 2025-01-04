<?php

namespace App\FormatImport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;

class ReferencesPelaksanaanDiklat implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    public function title(): string
    {
        return 'References Pelaksanaan Diklat';
    }

    public function view(): View
    {
        // Query the pelaksaan_diklats table and join with diklats table
        $data = DB::table('pelaksaan_diklats')
            ->join('diklats', 'pelaksaan_diklats.diklat_id', '=', 'diklats.id')
            ->select('pelaksaan_diklats.*', 'diklats.nama_diklat') // Select the desired fields
            ->orderBy('pelaksaan_diklats.id', 'desc')
            ->get();

        return view('alumni.references_pelaksaaan_diklat', [
            'data' => $data
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:B1';
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
