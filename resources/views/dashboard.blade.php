<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between py-2">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight">
                    {{ __('Dashboard Utama') }}
                </h2>
                <p class="text-sm text-slate-500">Pantau statistik kebersihan secara real-time.</p>
            </div>
            
            {{-- Bagian Jam yang Diperbarui --}}
            <div class="flex items-center gap-4 bg-white/80 backdrop-blur-md p-1 pr-4 rounded-2xl border border-slate-200 shadow-sm group transition-all duration-300 hover:shadow-md hover:border-indigo-200 mt-4 md:mt-0">
                <div class="bg-indigo-50 p-3 rounded-xl group-hover:bg-indigo-600 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <div class="flex flex-col">
                    <div class="flex items-baseline gap-1">
                        <span id="realtime-clock" class="text-2xl font-black text-slate-800 tabular-nums tracking-tight">
                            00:00:00
                        </span>
                        <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-wider">WIB</span>
                    </div>
                    <div id="realtime-date" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">
                        Memuat tanggal...
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ 1. STATISTIK CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @php
                    $cards = [
                        ['label' => 'Total Kelas', 'value' => $total_kelas, 'color' => 'from-indigo-600 to-indigo-700'],
                        ['label' => 'Penilaian Masuk', 'value' => $total_penilaian, 'color' => 'from-blue-600 to-blue-700'],
                        ['label' => 'Kriteria', 'value' => $total_kriteria, 'color' => 'from-sky-600 to-sky-700'],
                        ['label' => 'Tim Penilai', 'value' => $total_user, 'color' => 'from-slate-700 to-slate-800'],
                    ];
                @endphp

                @foreach($cards as $card)
                <div class="bg-gradient-to-br {{ $card['color'] }} rounded-2xl text-white shadow-sm p-6 relative overflow-hidden group hover:scale-[1.02] transition-transform duration-300">
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-colors"></div>
                    <p class="text-xs opacity-80 uppercase font-bold tracking-[0.1em]">{{ $card['label'] }}</p>
                    <p class="text-4xl font-extrabold mt-2 tracking-tighter">{{ $card['value'] }}</p>
                </div>
                @endforeach
            </div>

            {{-- ✅ 2. FITUR PENGUMUMAN --}}
            <div class="mb-8 bg-white border border-indigo-100 rounded-2xl overflow-hidden shadow-sm flex items-center hover:border-indigo-300 transition-colors">
                <div class="bg-indigo-600 px-6 py-4 flex items-center justify-center self-stretch">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                
                <div class="px-6 py-2 flex-1">
                    <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.2em]">Pemenang Pekan Ini ({{ now()->startOfWeek()->format('d M') }} - {{ now()->endOfWeek()->format('d M') }})</p>
                    <h4 class="text-slate-800 font-bold text-lg leading-tight">
                        @if($kelasTerbersih)
                            Selamat untuk Kelas <span class="text-indigo-600 italic font-black">{{ $kelasTerbersih->kelas->nama_kelas }}</span>
                        @else
                            <span class="text-slate-400 italic font-medium">Belum ada data penilaian pekan ini</span>
                        @endif
                    </h4>
                </div>

                <div class="px-6 py-2 border-l border-slate-100 hidden md:block bg-slate-50/50">
                    <div class="flex items-center gap-2">
                        <span class="text-3xl font-black text-slate-800 tracking-tighter">{{ $kelasTerbersih->skor_total ?? '0' }}</span>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-400 uppercase leading-none">Skor</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase leading-none">Tertinggi</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row Grafik --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/30">
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Tren Nilai (7 Terakhir)</h3>
                    </div>
                    <div class="p-6" style="height: 320px;">
                        <canvas id="weeklyChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/30 flex justify-between items-center">
                        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Top 3 Pekan Ini</h3>
                        <span class="text-[10px] bg-indigo-100 text-indigo-600 px-2 py-0.5 rounded-full font-bold uppercase">Reset Mingguan</span>
                    </div>
                    <div class="p-6" style="height: 320px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Tabel Log --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Log Penilaian Terbaru</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] tracking-widest border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Nama Kelas</th>
                                <th class="px-6 py-4 text-center">Tanggal</th>
                                <th class="px-6 py-4 text-right">Skor Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recent_penilaian as $rp)
                            <tr class="hover:bg-slate-50/80 transition group">
                                <td class="px-6 py-4 font-bold text-slate-700 group-hover:text-indigo-600 transition-colors uppercase">{{ $rp->kelas->nama_kelas }}</td>
                                <td class="px-6 py-4 text-center text-slate-400 font-medium">{{ \Carbon\Carbon::parse($rp->tanggal_penilaian)->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-lg font-black border border-emerald-100">
                                        {{ $rp->skor_total }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-slate-400 italic font-medium">Belum ada data penilaian masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const trenLabels = {!! json_encode($tren_labels) !!};
const trenValues = {!! json_encode($tren_data) !!};
const barLabels = {!! json_encode($chart_labels) !!};
const barValues = {!! json_encode($chart_data) !!};

const commonOptions = {
    maintainAspectRatio: false,
    plugins: {
        legend: { display: false },
        tooltip: {
            backgroundColor: '#1e293b',
            padding: 12,
            cornerRadius: 10,
            displayColors: false
        }
    },
    scales: {
        y: {
            min: 0, max: 100,
            grid: { color: '#f1f5f9', borderDash: [5, 5] },
            ticks: { stepSize: 20, font: { size: 11 }, color: '#94a3b8' }
        },
        x: { grid: { display: false }, ticks: { font: { size: 10, weight: '700' }, color: '#64748b' } }
    }
};

new Chart(document.getElementById('weeklyChart'), {
    type: 'line',
    data: {
        labels: trenLabels,
        datasets: [{
            data: trenValues,
            fill: true,
            backgroundColor: 'rgba(79,70,229,0.08)',
            borderColor: '#4f46e5',
            borderWidth: 3,
            tension: 0.4,
            pointBackgroundColor: '#fff',
            pointBorderColor: '#4f46e5',
            pointRadius: 4
        }]
    },
    options: commonOptions
});

new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: barLabels,
        datasets: [{
            data: barValues,
            backgroundColor: '#4f46e5',
            borderRadius: 8,
            barThickness: 40
        }]
    },
    options: commonOptions
});

function updateTime() {
    const now = new Date();
    const h = String(now.getHours()).padStart(2, '0');
    const m = String(now.getMinutes()).padStart(2, '0');
    const s = String(now.getSeconds()).padStart(2, '0');
    document.getElementById('realtime-clock').innerText = `${h}:${m}:${s}`;
    
    const options = { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' };
    document.getElementById('realtime-date').innerText = now.toLocaleDateString('id-ID', options).toUpperCase();
}
setInterval(updateTime, 1000);
updateTime();
</script>
</x-app-layout>