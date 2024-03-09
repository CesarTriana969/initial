<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClientsExport implements FromView, ShouldAutoSize, WithStyles
{
    public function view(): View
    {
        return view('admin.exports.clients', [
            'clients' => Customer::all()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E0E0E0']]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getStyle('A1:L1')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFE0E0E0',
                        ],
                    ],
                    'font' => [
                        'bold' => true,
                    ]
                ]);
                foreach(range('A', 'L') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
