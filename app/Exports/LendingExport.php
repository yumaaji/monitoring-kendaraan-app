<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Lending;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LendingExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // Mengambil data di model Lending beserta relasinya
    // Dan dijadikan ke dalam bentuk collection
    public function collection()
    {
        return Lending::with('company', 'transport', 'driver', 'supervisor')->get();
    }

    /**
     * @return array
     */
    // Judul dari setiap kolom
    public function headings(): array
    {
        return [
            'Nomer',
            'Nama Kendaraan',
            'Nama Driver',
            'Tujuan',
            'Nama Penanggungjawab',
            'Status',
            'Tanggal Mulai',
            'Tanggal Selesai',
        ];
    }

    /**
     * @param mixed $lending
     *
     * @return array
     */
    public function map($lending): array
    {
        // Mengubah nilai status (1, 2, 3) menjadi teks yang lebih deskriptif (Waiting, Disetujui, Ditolak).
        $status = '';
        switch ($lending->status) {
            case 1:
                $status = 'Waiting';
                break;
            case 2:
                $status = 'Disetujui';
                break;
            case 3:
                $status = 'Ditolak';
                break;
        }

        // Mengisi data di setiap kolom
        return [
            $lending->id,
            $lending->transport ? $lending->transport->name : '',
            $lending->driver ? $lending->driver->name : '',
            $lending->purpose,
            $lending->supervisor ? $lending->supervisor->name : '',
            $status,
            $lending->start_date,
            $lending->end_date,
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $currentDate = Carbon::now()->format('Y-m-d H:i:s');

        $sheet->insertNewRowBefore(1, 2);
        $sheet->setCellValue('A1', 'Dibuat pada: ' . $currentDate);
        $sheet->mergeCells('A1:H1');

        $sheet->getStyle('A:H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $lastRow = $sheet->getHighestRow();

        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A3:H' . $lastRow)->applyFromArray($borderStyle);

        return [
            1    => ['font' => ['bold' => true]],

            3    => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ],

            'A3:H3' => [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }



}


