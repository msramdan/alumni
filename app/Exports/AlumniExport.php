<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;

class AlumniExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    public function title(): string
    {
        return 'Data Alumni'; // You can modify the title as needed
    }

    public function view(): View
    {
        // Query the alumni data and order by 'no_absen'
        $data = DB::table('alumni')
            ->leftJoin('pelaksaan_diklats', 'alumni.pelaksaan_diklat_id', '=', 'pelaksaan_diklats.id')
            ->select(
                'alumni.id',
                'alumni.nama',
                'alumni.no_absen',
                'alumni.no_reg',
                'alumni.tempat_lahir',
                'alumni.tanggal_lahir',
                'alumni.photo',
                'pelaksaan_diklats.judul_diklat as pelaksaan_diklat'
            )
            ->orderBy('alumni.no_reg', 'asc')  // Order by no_absen in ascending order
            ->get(); // Use get() to fetch all data

        // Return the view for Excel export and pass the data to the view
        return view('alumni.export_excel', [
            'data' => $data
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:I1';
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
