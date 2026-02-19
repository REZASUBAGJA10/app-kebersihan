<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-indigo-900 leading-tight flex items-center gap-2">
            <span></span> {{ __('Laporan Hasil Penilaian') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div id="notif" class="mb-4 p-3 bg-emerald-500 text-white rounded-xl shadow-lg flex justify-between items-center transition-all duration-500">
                    <div class="flex items-center text-xs">
                        <span class="bg-white/20 p-1 rounded-lg mr-2">✨</span>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('notif').remove()" class="hover:bg-white/20 p-1 rounded-full transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl shadow-gray-200/50 sm:rounded-3xl p-5 border border-gray-100">
                
                {{-- HEADER TABEL & TOMBOL EXPORT --}}
                <div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-4 border-b border-gray-100 pb-5">
                    <div class="space-y-0.5">
                        <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">Rekapitulasi Nilai</h3>
                        <p class="text-indigo-600 font-bold text-xs flex items-center gap-2">
                            <span class="w-6 h-1 bg-indigo-600 rounded-full"></span>
                            SMKN 1 Maja
                        </p>
                    </div>

                    <div class="flex gap-2">
                        {{-- DOWNLOAD PDF --}}
                        <a href="{{ route('laporan.pdf') }}" 
                           class="inline-flex items-center px-4 py-2 bg-rose-600 border border-transparent rounded-xl font-bold text-xs text-white hover:bg-rose-700 active:scale-95 transition-all shadow-md shadow-rose-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Export PDF
                        </a>

                        {{-- DOWNLOAD EXCEL --}}
                        <a href="{{ route('laporan.excel') }}" 
                           class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-xl font-bold text-xs text-white hover:bg-emerald-700 active:scale-95 transition-all shadow-md shadow-emerald-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v12m0 0l-4-4m4 4l4-4m4 4v4H4v-4"></path>
                            </svg>
                            Export Excel
                        </a>
                    </div>
                </div>

                {{-- FITUR PENCARIAN --}}
                <div class="mb-4">
                    <div class="relative w-full md:w-80">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Cari kelas, petugas, atau catatan..."
                            class="text-xs pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-300 focus:outline-none w-full bg-gray-50/50"
                        >
                    </div>
                </div>

                {{-- TABEL --}}
                <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm">
                    <table class="w-full text-xs text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 uppercase text-[10px] font-black tracking-widest">
                                <th class="p-4 text-center w-12">No</th>
                                <th class="p-4">Tanggal</th>
                                <th class="p-4">Unit Kelas</th>
                                <th class="p-4">Petugas</th>
                                <th class="p-4 text-center">Skor</th>
                                <th class="p-4">Catatan</th>
                                {{-- Kolom Visual Dihapus Dari Sini --}}
                                <th class="p-4 text-center w-28">Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="rekapTable" class="divide-y divide-gray-50">
                            @forelse($penilaian as $p)
                            <tr class="hover:bg-indigo-50/50 transition duration-300 group rekap-row">
                                <td class="p-4 text-center font-semibold text-gray-400 group-hover:text-indigo-600 transition">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="p-4 font-medium">
                                    {{ \Carbon\Carbon::parse($p->tanggal_penilaian)->format('d/m/Y') }}
                                </td>

                                <td class="p-4 search-unit">
                                    <span class="font-black text-gray-800 uppercase tracking-tight text-sm">
                                        {{ $p->kelas->nama_kelas ?? '-' }}
                                    </span>
                                </td>

                                <td class="p-4 search-petugas">
                                    {{ $p->user->name ?? '-' }}
                                </td>

                                <td class="p-4 text-center">
                                    <span class="px-2 py-1 rounded-lg font-bold text-[10px]
                                        {{ $p->skor_total >= 75 ? 'bg-indigo-100 text-indigo-700' : 'bg-rose-100 text-rose-700' }}">
                                        {{ $p->skor_total }}
                                    </span>
                                </td>

                                <td class="p-4 text-gray-500 italic search-catatan">
                                    {{ \Illuminate\Support\Str::limit($p->catatan ?? '-', 60) }}
                                </td>

                                {{-- Kolom Visual (td) Dihapus Dari Sini --}}

                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center gap-1.5">
                                        <a href="{{ route('penilaian.show', $p->id) }}" class="p-2 bg-white border border-gray-200 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition shadow-sm" title="Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ route('penilaian.edit', $p->id) }}" class="p-2 bg-white border border-gray-200 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition shadow-sm" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('penilaian.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-white border border-gray-200 text-rose-500 rounded-lg hover:bg-rose-600 hover:text-white transition shadow-sm" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr id="emptyRow">
                                <td colspan="7" class="p-10 text-center text-gray-400 italic">
                                    Belum ada data penilaian.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER JUMLAH DATA --}}
                <div class="mt-6 flex justify-end">
                    <div class="bg-indigo-900 text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider shadow-md">
                        Total: <span id="dataCount">{{ $penilaian->count() }}</span> Data
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- SCRIPT PENCARIAN REAL-TIME --}}
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let keyword = this.value.toLowerCase();
            let rows = document.querySelectorAll('.rekap-row');
            let visibleCount = 0;

            rows.forEach(row => {
                let unit = row.querySelector('.search-unit').innerText.toLowerCase();
                let petugas = row.querySelector('.search-petugas').innerText.toLowerCase();
                let catatan = row.querySelector('.search-catatan').innerText.toLowerCase();
                
                if (unit.includes(keyword) || petugas.includes(keyword) || catatan.includes(keyword)) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });

            document.getElementById('dataCount').innerText = visibleCount;
        });
    </script>
</x-app-layout>