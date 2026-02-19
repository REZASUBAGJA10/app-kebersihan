<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 1 MAJA - Monitoring Kebersihan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --primary: #4f46e5; /* Indigo Modern */
            --primary-dark: #4338ca; 
            --accent: #0ea5e9; /* Sky Blue untuk label */
            --text-main: #0f172a; 
            --text-muted: #64748b; 
        }
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff; 
            color: var(--text-main); 
            scroll-behavior: smooth; 
        }

        .navbar { padding: 15px 0; border-bottom: 1px solid #f1f5f9; background: #fff; }
        .navbar-brand { font-weight: 800; font-size: 1.2rem; color: #000; text-decoration: none; }
        .navbar-brand img { object-fit: contain; } 
        
        .nav-link { 
            font-weight: 600; 
            color: var(--text-muted) !important; 
            font-size: 0.9rem; 
            margin: 0 15px;
            position: relative;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .nav-link:hover { color: var(--text-main) !important; }
        
        .nav-link.active { color: var(--primary) !important; }
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary);
        }

        .btn-login-outline { 
            color: var(--primary); 
            font-weight: 700; 
            text-decoration: none; 
            border: 1px solid var(--primary);
            padding: 8px 30px;
            border-radius: 50px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        .btn-login-outline:hover {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        
        .hero {
            height: 95vh;
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), url('{{ asset("img/backround.jpg") }}'); 
            background-size: cover; background-position: center;
            display: flex; align-items: center; justify-content: center; color: white; text-align: center;
        }

       
        .hero .hero-label {
            color: var(--accent);
            font-weight: 700;
            letter-spacing: 4px;
            font-size: 1.1rem;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: block;
        }

       
        .hero h1 { 
            font-size: 5.5rem; 
            font-weight: 800; 
            letter-spacing: -2px; 
            margin-bottom: 20px;
            line-height: 1;
            background: linear-gradient(to bottom, #ffffff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

      
        .hero p { 
            max-width: 850px; 
            margin: 0 auto; 
            line-height: 1.6; 
            font-size: 1.35rem; 
            color: #e2e8f0;
        }

        .btn-selengkapnya {
            background: var(--primary);
            color: white;
            padding: 14px 40px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            margin-top: 40px;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-selengkapnya:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(79, 70, 229, 0.4);
        }
       

        section { padding: 80px 0; }

        .card-top-kelas {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 24px;
            padding: 40px 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }

        .card-top-kelas:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.1);
            border-color: var(--primary);
        }

        .rank-label {
            background: #eff6ff;
            color: var(--primary);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .class-title {
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--text-main);
            margin-bottom: 10px;
        }

        .score-huge {
            font-size: 3.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary), #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
        }

        .table-container { border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: white; }
        .table thead th { background: #f8fafc; color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; padding: 18px 20px; border: none; }
        .table tbody td { padding: 18px 20px; border-top: 1px solid #f1f5f9; font-size: 0.9rem; transition: background 0.2s ease; }
        .table tbody tr:hover td { background-color: #f8fafc; }

        .score-box { font-weight: 700; padding: 4px 10px; border-radius: 4px; font-size: 0.85rem; }

        .about-grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 50px; align-items: start; }
        .feature-card {
            background: #f8fafc;
            padding: 25px;
            border-radius: 8px;
            border-left: 4px solid var(--primary);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateX(5px);
            background: #ffffff;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .feature-card h5 { font-weight: 800; font-size: 1.1rem; margin-bottom: 8px; }
        .feature-card p { color: var(--text-muted); font-size: 0.95rem; margin: 0; }

        .footer-clean {
            position: sticky;
            bottom: 0;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(6px);
            border-top: 1px solid #e5e7eb;
            font-size: 0.75rem;
        }

        .footer-inner {
            max-width: 1280px; 
            margin: auto;
            padding: 8px 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            gap: 4px;
        }

        @media (min-width: 768px) {
            .footer-inner { flex-direction: row; }
        }

        .footer-left { font-weight: 600; color: #4f46e5; }
        .footer-left span { font-weight: 400; color: #9ca3af; margin-left: 4px; }
        .footer-right { color: #6b7280; }
        .footer-right span { font-weight: 600; color: #374151; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo SMK" width="40" height="40" class="me-2">
                <span>SMKN 1 MAJA</span>
            </a>
            
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto" id="nav-list">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#peringkat">Top 3 Kelas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#laporan">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Sekolah</a></li>
                </ul>
                <a href="{{ route('login') }}" class="btn-login-outline">Login</a>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <span class="hero-label">Sistem Kebersihan</span>
            <h1>SMKN 1 MAJA</h1>
            <p>
                Pantau kualitas lingkungan dan perkembangan kelas secara real-time <br class="d-none d-md-block"> 
                untuk mewujudkan sekolah yang maju dan berkualitas.
            </p>
            <a href="#peringkat" class="btn-selengkapnya">Lihat Selengkapnya</a>
        </div>
    </header>

    <main class="container">
        <section id="peringkat">
            <div class="text-center mb-5">
                <h2 class="fw-extrabold" style="font-size: 2.5rem; letter-spacing: -1px;">3 Unit Kelas Terbaik</h2>
                <div class="mx-auto mt-2" style="width: 50px; height: 4px; background: var(--primary); border-radius: 10px;"></div>
            </div>
            
            <div class="row g-4 justify-content-center">
                @php $top3 = $penilaian->sortByDesc('skor_total')->take(3); @endphp
                @foreach($top3 as $index => $top)
                <div class="col-md-4">
                    <div class="card-top-kelas text-center">
                        <span class="rank-label">PERINGKAT {{ $index + 1 }}</span>
                        <h3 class="class-title text-uppercase">{{ $top->kelas->nama_kelas }}</h3>
                        <div class="score-huge">{{ $top->skor_total }}</div>
                        <p class="text-muted small mt-3 mb-0 fw-bold">SKOR PENILAIAN</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <section id="laporan">
            <h2 class="fw-extrabold mb-4">Laporan Hasil Penilaian</h2>

            <div class="table-container">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Unit / Kelas</th>
                            <th>Skor</th>
                            <th>Keterangan</th>
                            <th class="text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody id="laporanBody">
                        @foreach($penilaian->sortByDesc('skor_total')->values() as $index => $p)
                        <tr class="laporan-item" data-page="{{ floor($index / 5) }}">
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_penilaian)->format('d/m/Y') }}</td>
                            <td class="fw-bold">{{ $p->kelas->nama_kelas }}</td>
                            <td>
                                <span class="score-box bg-light text-primary">
                                    {{ $p->skor_total }}
                                </span>
                            </td>
                            <td class="text-muted small">
                                {{ $p->catatan ?? '-' }}
                            </td>
                            <td class="text-end fw-bold {{ $p->skor_total >= 75 ? 'text-success' : 'text-danger' }}">
                                {{ $p->skor_total >= 75 ? 'Baik' : 'Evaluasi' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button id="prevBtn" class="btn btn-outline-secondary">Sebelumnya</button>
                <button id="nextBtn" class="btn btn-outline-primary">Selanjutnya</button>
            </div>
        </section>

        <section id="tentang">
            <div class="about-grid">
                <div>
                    <span class="text-primary fw-bold text-uppercase small d-block mb-2">Tentang Program</span>
                    <h2 class="fw-extrabold fs-1 mb-4">Membangun Karakter Lewat Lingkungan Sehat</h2>
                    <p class="text-muted fs-5">Di SMKN 1 Maja, kebersihan bukan sekadar rutinitas, melainkan budaya.</p>
                </div>
                <div>
                    <div class="feature-card">
                        <h5>Disiplin</h5>
                        <p>Membentuk kebiasaan positif menjaga lingkungan belajar setiap hari.</p>
                    </div>
                    <div class="feature-card">
                        <h5>Kenyamanan</h5>
                        <p>Suasana belajar yang bersih menjamin fokus belajar yang lebih maksimal.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer-clean">
        <div class="container footer-inner">
            <div class="footer-left">
                SMKN 1 Maja
                <span>| Sistem Penilaian Kelas</span>
            </div>
            <div class="footer-right">
                © {{ date('Y') }}
                <span>Reza Subagja</span>
            </div>
        </div>
    </footer>

    <script>
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });

        document.addEventListener("DOMContentLoaded", function(){
            const items = document.querySelectorAll(".laporan-item");
            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");

            const totalPages = Math.ceil(items.length / 5);
            let currentPage = 0;

            function renderPage(){
                items.forEach(item => {
                    if(parseInt(item.dataset.page) === currentPage){
                        item.style.display = "";
                    } else {
                        item.style.display = "none";
                    }
                });

                prevBtn.disabled = currentPage === 0;
                nextBtn.disabled = (currentPage === totalPages - 1) || totalPages === 0;
            }

            nextBtn.addEventListener("click", function(){
                if(currentPage < totalPages - 1){
                    currentPage++;
                    renderPage();
                }
            });

            prevBtn.addEventListener("click", function(){
                if(currentPage > 0){
                    currentPage--;
                    renderPage();
                }
            });

            renderPage();
        });
    </script>
</body>
</html>