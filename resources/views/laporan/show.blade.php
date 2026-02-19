<x-app-layout>
    <div class="py-12 bg-[#f8fafc] min-h-screen font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header --}}
            <div class="mb-8 px-2 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Rincian Penilaian</h2>
                    <p class="text-slate-500 text-sm mt-1">Laporan detail evaluasi unit kelas secara menyeluruh.</p>
                </div>
                <a href="{{ route('penilaian.index') }}" class="group flex items-center gap-2 text-[11px] font-bold text-slate-400 hover:text-indigo-600 transition-colors uppercase tracking-widest">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali
                </a>
            </div>

            <div class="bg-white border border-slate-200 rounded-[24px] overflow-hidden shadow-sm">
                <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-slate-100">
                    
                    {{-- SISI KIRI: Info Utama & Dokumentasi --}}
                    <div class="lg:col-span-4 p-8 bg-slate-50/30">
                        <div class="space-y-8">
                            {{-- Info Dasar --}}
                            <div>
                                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-widest mb-5 flex items-center gap-2">
                                    <span class="w-1 h-4 bg-indigo-600 rounded-full"></span>
                                    Informasi Unit
                                </h3>
                                <div class="space-y-4">
                                    <div class="p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mb-1">Unit Kelas</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $penilaian->kelas->nama_kelas }}</p>
                                    </div>
                                    <div class="p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mb-1">Tanggal Input</p>
                                        <p class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->format('d F Y') }}</p>
                                    </div>
                                    <div class="p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mb-1">Petugas Penilai</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $penilaian->user->name }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Dokumentasi --}}
                            <div>
                                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-widest mb-5 flex items-center gap-2">
                                    <span class="w-1 h-4 bg-indigo-600 rounded-full"></span>
                                    Dokumentasi
                                </h3>
                                @if($penilaian->foto)
                                    <div class="relative group rounded-2xl overflow-hidden border-2 border-white shadow-md aspect-square lg:aspect-video">
                                        <img src="{{ asset('storage/' . $penilaian->foto) }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-indigo-600/10 group-hover:bg-transparent transition-colors"></div>
                                    </div>
                                @else
                                    <div class="aspect-video rounded-2xl border-2 border-dashed border-slate-200 bg-white flex flex-col items-center justify-center p-6 text-center">
                                        <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">Tidak ada foto bukti</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- SISI KANAN: Hasil & Detail Skor --}}
                    <div class="lg:col-span-8 p-8 flex flex-col">
                        {{-- Skor Terkalkulasi --}}
                        <div class="flex items-center justify-between mb-8 p-6 rounded-3xl {{ $penilaian->skor_total >= 75 ? 'bg-emerald-50 border border-emerald-100' : 'bg-rose-50 border border-rose-100' }}">
                            <div>
                                <p class="text-[10px] font-black {{ $penilaian->skor_total >= 75 ? 'text-emerald-600' : 'text-rose-600' }} uppercase tracking-[0.2em] mb-1">Skor Akhir</p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-4xl font-black {{ $penilaian->skor_total >= 75 ? 'text-emerald-700' : 'text-rose-700' }} tracking-tighter">{{ $penilaian->skor_total }}</span>
                                    <span class="text-sm font-bold {{ $penilaian->skor_total >= 75 ? 'text-emerald-500' : 'text-rose-500' }}">/100</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status Kelayakan</p>
                                <span class="px-4 py-1.5 rounded-xl text-[11px] font-black uppercase tracking-widest {{ $penilaian->skor_total >= 75 ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-200' : 'bg-rose-500 text-white shadow-lg shadow-rose-200' }}">
                                    {{ $penilaian->skor_total >= 75 ? 'Layak' : 'Tidak Layak' }}
                                </span>
                            </div>
                        </div>

                        {{-- Rincian Kriteria --}}
                        <div class="flex items-center gap-2 mb-6">
                            <span class="w-1 h-4 bg-indigo-600 rounded-full"></span>
                            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-widest">Rincian Per Kriteria</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            @foreach($penilaian->details as $detail)
                            <div class="flex items-center justify-between p-4 bg-white border border-slate-100 rounded-2xl hover:border-indigo-100 transition-colors">
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-slate-700 tracking-tight">{{ $detail->kriteria->nama_kriteria }}</p>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Bobot {{ $detail->kriteria->bobot }}%</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-lg font-black text-indigo-600 leading-none">{{ $detail->skor }}</span>
                                    <p class="text-[8px] font-bold text-slate-300 uppercase">Skor</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Catatan --}}
                        <div class="mt-auto">
                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1 block mb-3">Catatan Evaluasi</label>
                            <div class="p-5 bg-slate-50 rounded-2xl border border-slate-100 italic text-sm text-slate-600 leading-relaxed shadow-inner">
                                @if($penilaian->catatan)
                                    "{{ $penilaian->catatan }}"
                                @else
                                    <span class="text-slate-400 opacity-60">Tidak ada catatan tambahan untuk laporan ini.</span>
                                @endif
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="mt-8 pt-6 border-t border-slate-50 flex items-center justify-end gap-4">
                            <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] font-bold rounded-xl shadow-sm hover:shadow-indigo-200 transition-all active:scale-95 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-8 px-4 opacity-40">
                <p class="text-[10px] text-slate-400 font-medium tracking-wide italic">Dokumen ini dihasilkan secara otomatis oleh sistem.</p>
                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">ID: #PEN-{{ str_pad($penilaian->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
    </div>
</x-app-layout>