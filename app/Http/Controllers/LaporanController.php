<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LaporanController extends Controller
{
    
    public function index()
    {
        
        $penilaian = Penilaian::with(['kelas', 'user'])->latest()->get();
        return view('laporan.index', compact('penilaian'));
    }

   
    public function exportExcel()
    {
       
        $penilaian = Penilaian::with(['kelas', 'user'])->get()
            ->sortBy([
                fn($a, $b) => ($a->kelas->nama_kelas ?? '') <=> ($b->kelas->nama_kelas ?? ''),
                fn($a, $b) => $b->skor_total <=> $a->skor_total,
            ]);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Rekap Nilai Kebersihan');

        
        $sheet->setCellValue('A1', 'LAPORAN REKAPITULASI NILAI KEBERSIHAN KELAS');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'SMKN 1 MAJA - DICETAK PADA: ' . date('d/m/Y H:i'));
        $sheet->mergeCells('A2:G2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        
        $header = ['NO', 'TANGGAL', 'UNIT KELAS', 'PETUGAS PENILAI', 'SKOR', 'CATATAN', 'VISUAL BUKTI'];
        $sheet->fromArray($header, null, 'A4');

        
        $sheet->getStyle('A4:G4')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F46E5'] // Warna Indigo seperti UI Web
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ],
        ]);

       
        $currentRow = 5;
        $no = 1;

        foreach ($penilaian as $p) {
            $skor = $p->skor_total;

            $sheet->setCellValue("A$currentRow", $no++);
            $sheet->setCellValue("B$currentRow", date('d/m/Y', strtotime($p->tanggal_penilaian)));
            $sheet->setCellValue("C$currentRow", $p->kelas->nama_kelas ?? '-');
            $sheet->setCellValue("D$currentRow", $p->user->name ?? '-');
            $sheet->setCellValue("E$currentRow", $skor);
            $sheet->setCellValue("F$currentRow", $p->catatan ?? '-');

            
            $pathFoto = public_path('storage/' . $p->foto);
            
           
            if ($p->foto && file_exists($pathFoto) && extension_loaded('gd')) {
                try {
                    $drawing = new Drawing();
                    $drawing->setName('Bukti Kebersihan');
                    $drawing->setPath($pathFoto);
                    $drawing->setHeight(70); // Ukuran gambar sedikit lebih besar agar jelas
                    $drawing->setCoordinates('G' . $currentRow);
                    $drawing->setOffsetX(15);
                    $drawing->setOffsetY(5);
                    $drawing->setWorksheet($sheet);

                   
                    $sheet->getRowDimension($currentRow)->setRowHeight(60);
                } catch (\Exception $e) {
                    $sheet->setCellValue("G$currentRow", "Gagal memuat gambar");
                }
            } else {
                $sheet->setCellValue("G$currentRow", $p->foto ? "GD Off / File Not Found" : "-");
            }

            
            if ($skor < 60) {
                $sheet->getStyle("A$currentRow:G$currentRow")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('FECACA'); // Warna Merah Muda
            }

            $currentRow++;
        }

       
        $lastRow = $currentRow - 1;

       
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        
        $sheet->getColumnDimension('F')->setWidth(35); 
        $sheet->getColumnDimension('G')->setWidth(25); 

       
        $sheet->getStyle("A5:G$lastRow")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle("A5:E$lastRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F5:F$lastRow")->getAlignment()->setWrapText(true);
        $sheet->getStyle("G5:G$lastRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

       
        $sheet->getStyle("A4:G$lastRow")->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ]);

        
        $filename = "Rekap_Kebersihan_Maja_" . date('d-m-Y_H-i') . ".xlsx";
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
