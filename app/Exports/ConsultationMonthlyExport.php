<?php

namespace App\Exports;

use App\Models\Consultation;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ConsultationMonthlyExport implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        // Set waktu awal (00:00:00) dan waktu akhir (23:59:59)
        $this->startDate = Carbon::parse($startDate)->startOfDay();
        $this->endDate   = Carbon::parse($endDate)->endOfDay();
    }

    public function query()
    {
        return Consultation::with('service')
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->latest();
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Email',
            'Phone',
            'Service',
            'Status',
            'Tanggal Konsultasi',
        ];
    }

    public function map($consultation): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        return [
            $rowNumber,
            $consultation->name,
            $consultation->email,
            (string) $consultation->phone,
            $consultation->service->nama_service ?? '-',
            ucfirst($consultation->status),
            $consultation->created_at->format('d-m-Y H:i'),
        ];
    }

    public function title(): string
    {
        return 'Rekap ' . $this->startDate->format('d-m-Y') . ' s.d ' . $this->endDate->format('d-m-Y');
    }

    /**
     * Formatting Format Teks/Angka pada Kolom
     */
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT, // Kolom Phone dianggap teks
        ];
    }

    /**
     * Memberikan Style (Warna Header, Border Tabel, & Alignment)
     */
    public function styles(Worksheet $sheet)
    {
        // Hitung total baris yang berisi data
        $highestRow = $sheet->getHighestRow();

        // 1. Styling Header (Baris 1)
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'], // Teks Putih
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '198754'], // Warna Hijau Bootstrap (Success)
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Set tinggi baris header
        $sheet->getRowDimension(1)->setRowHeight(25);

        // 2. Styling Semua Cell / Tabel (Garis Border)
        $sheet->getStyle("A1:G{$highestRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'D3D3D3'], // Warna abu-abu halus
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // 3. Perataan (Alignment) Kolom Spesifik
        $sheet->getStyle("A2:A{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // No -> Tengah
        $sheet->getStyle("D2:D{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Phone -> Tengah
        $sheet->getStyle("F2:F{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Status -> Tengah
        $sheet->getStyle("G2:G{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Tanggal -> Tengah

        return [];
    }
}
