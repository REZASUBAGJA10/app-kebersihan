<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Penilaian - SMKN 1 MAJA</title>
    <style>
        @page {
            margin: 1.5cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            font-size: 11px;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }
        
      
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 25px;
        }
        .header h1 { 
            margin: 0; 
            font-size: 22px; 
            text-transform: uppercase;
            font-weight: bold;
        }
        .header p {
            margin: 2px 0;
            font-size: 10px;
        }

        .report-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-title h2 {
            margin: 0;
            font-size: 16px;
            text-decoration: underline;
            text-transform: uppercase;
            font-weight: bold;
        }

       
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            border: 1px solid #cbd5e1;
        }
        
        th {
            background-color: #587fdd; 
            color: #ffffff;
            text-transform: uppercase;
            font-weight: bold;
            padding: 12px 5px;
            border: 1px solid #4a69bd;
            font-size: 10px;
            text-align: center;
        }
        
        td {
            padding: 10px 5px;
            border: 1px solid #e2e8f0;
            vertical-align: middle;
            text-align: center;
            color: #000;
        }

        /* Baris Selang-seling */
        tbody tr:nth-child(even) {
            background-color: #f8faff;
        }

        .col-no { width: 40px; }
        .col-tgl { width: 90px; }
        .col-kelas { width: 120px; font-weight: bold; }
        .col-skor { width: 60px; }
        
        /* Badge Skor Biru Muda */
        .badge-skor {
            background-color: #e0e7ff;
            color: #4338ca;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: bold;
            border: 1px solid #c7d2fe;
        }

        .catatan {
            text-align: left;
            font-style: italic;
            color: #4b5563;
        }

        .footer-note {
            margin-top: 20px;
            font-size: 9px;
            color: #666;
            text-align: right;
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
        <p style="font-size: 10px; margin-top: 5px;">Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-no">NO</th>
                <th class="col-tgl">TANGGAL</th>
                <th class="col-kelas">UNIT KELAS</th>
                <th>PETUGAS</th>
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
        * Laporan ini dibuat secara otomatis melalui sistem penilaian digital.
    </div>

</body>
</html>