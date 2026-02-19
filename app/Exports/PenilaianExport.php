<?php

namespace App\Exports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PenilaianExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Penilaian::with(['kelas', 'user'])
            ->join('kelas', 'penilaians.kelas_id', '=', 'kelas.id')
            ->orderBy('penilaians.skor_total', 'desc')
            ->select('penilaians.*')
            ->get();
    }

    public function headings(): array
    {
        
        return [
            ['SMK NEGERI 1 MAJA'],
            ['Jl. Pasukan Sindangkasih No.12, Maja Selatan, Kec. Maja, Kabupaten Majalengka'],
            ['Sistem Penilaian Kebersihan Kelas | Laporan Rekapitulasi Nilai'],
            [''], 
            [
                'NO',
                'TANGGAL',
                'UNIT KELAS',
                'PETUGAS',
                'SKOR',
                'CATATAN'
            ]
        ];
    }

    public function map($penilaian): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->format('d/m/Y'),
            $penilaian->kelas->nama_kelas,
            $penilaian->user->name,
            $penilaian->skor_total,
            $penilaian->catatan ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
       
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A2:F2');
        $sheet->mergeCells('A3:F3');

       
        $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A2')->getFont()->setSize(10);
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(11);

        
        $sheet->getStyle('A5:F5')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '587FDD'], 
            ],
        ]);

       
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A5:F' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        
        $sheet->getStyle('A6:B' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E6:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }
}