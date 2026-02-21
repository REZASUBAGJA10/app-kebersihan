<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Penilaian - SMKN 1 MAJA</title>
    <style>
      
        @page {
            size: A4 portrait;
            margin: 1.5cm; 
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            font-size: 11px;
            margin: 0;
            padding: 0;
            line-height: 1.4;
            width: 100%;
        }

        
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }
        .header h1 { 
            margin: 0; 
            font-size: 18px; 
            text-transform: uppercase;
            font-weight: bold;
        }
        .header p {
            margin: 2px 0;
            font-size: 10px;
        }

        .report-title {
            text-align: center;
            margin-bottom: 15px;
        }
        .report-title h2 {
            margin: 0;
            font-size: 14px;
            text-decoration: underline;
            text-transform: uppercase;
            font-weight: bold;
        }

       
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; 
            border: 1px solid #000;
        }
        
        th {
            background-color: #587fdd; 
            color: #ffffff;
            text-transform: uppercase;
            font-weight: bold;
            padding: 8px 4px;
            border: 1px solid #000;
            font-size: 9px;
            text-align: center;
        }
        
        td {
            padding: 6px 4px;
            border: 1px solid #000;
            vertical-align: middle;
            text-align: center;
            color: #000;
            word-wrap: break-word; 
        }

      
        .col-no { width: 30px; }
        .col-tgl { width: 75px; }
        .col-kelas { width: 100px; font-weight: bold; }
        .col-skor { width: 50px; }
        .col-petugas { width: 100px; }
        

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .badge-skor {
            font-weight: bold;
            color: #4338ca;
        }

        .catatan {
            text-align: left;
            font-style: italic;
            font-size: 9px;
            color: #333;
        }

        .footer-note {
            margin-top: 15px;
            font-size: 9px;
            color: #666;
            text-align: right;
        }

       
        @media print {
            body {
                width: 100%;
            }
            table {
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>SMK NEGERI 1 MAJA</h1>
        <p>Jl. Pasukan Sindangkasih No.12, Maja Selatan, Kec. Maja, Kabupaten Majalengka</p>
        <p>Sistem Penilaian Kebersihan Kelas | Laporan Rekapitulasi Nilai</p>
    </div>

    <div class="report-title">
        <h2>REKAPITULASI NILAI KEBERSIHAN KELAS</h2>
        <p style="font-size: 9px; margin-top: 5px;">Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-no">NO</th>
                <th class="col-tgl">TANGGAL</th>
                <th class="col-kelas">UNIT KELAS</th>
                <th class="col-petugas">PETUGAS</th>
                <th class="col-skor">SKOR</th>
                <th>CATATAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penilaian as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_penilaian)->format('d/m/Y') }}</td>
                <td>{{ $row->kelas->nama_kelas ?? 'N/A' }}</td>
                <td>{{ $row->user->name ?? 'N/A' }}</td>
                <td>
                    <span class="badge-skor">{{ $row->skor_total }}</span>
                </td>
                <td class="catatan">{{ $row->catatan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-note">
        * Laporan ini dibuat secara otomatis melalui sistem penilaian digital pada ukuran kertas A4.
    </div>

</body>
</html>
